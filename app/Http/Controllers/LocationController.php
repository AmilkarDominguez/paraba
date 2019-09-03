<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use App\Catalogue;
use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\LocationRequest;
use Validator;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    
    public function index()
    {
        return view('articles.location');
    }
    public function datatable(Request $request)
    {
        //$isUser = auth()->user()->can(['catalogs.edit', 'catalogs.destroy']);
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
        return datatables()->of(Location::where('state','!=','ELIMINADO')->with('location_type','language')->get())
        ->addColumn('Imagen', function ($item) use ($visibility) {
            $item->v=$visibility;
        return '<img src="'.$item->photo.'" alt="image" width="125px" onclick="window.open(\''.$item->photo.'\');"></img>';
        })
        ->addColumn('coordinates', function ($item) {
        return 'Latitud: '.$item->lat.' | Longitud: '.$item->lng;
        })
        ->addColumn('QR', function ($item) {
            return '<a class="btn btn-secondary btn-circle btn-sm text-white '.$item->v.'" onclick="Gen_QR(\''.$item->link.'\')"><i class="fas fa-qrcode"></i></a>';
        })
        ->addColumn('Enlace', function ($item) {
        return '<a class="btn btn-info btn-circle btn-sm text-white '.$item->v.'" onclick="window.open(\''.$item->link.'\');"><i class="fas fa-link"></i></a>';
        })
        ->addColumn('Editar', function ($item) {
            return '<a class="btn btn-primary btn-circle btn-sm text-white '.$item->v.'" onclick="Edit(\''.$item->id.'\')"><i class="fas fa-pen"></i></a>';
        })
        ->addColumn('Eliminar', function ($item) {
        return '<a class="btn btn-danger btn-circle btn-sm text-white '.$item->v.'" onclick="Delete(\''.$item->id.'\')"><i class="fas fa-trash"></i></a>';
        })
        ->rawColumns(['Imagen','QR','Enlace','Detalles','Editar','Eliminar'])  
        ->toJson();
    }
    public function store(Request $request)
    {
        $rule = new LocationRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Location = Location::create($request->all());        
            //IMAGE 
            if($request->image){
                $image = $request->image;
                $this->SaveFile($Location,$request->image, $request->extension_image, '/images/Locations/');
            }
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function update(Request $request)
    {
        $rule = new LocationRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Location = Location::find($request->id);
            $Location->update($request->all());

            if($request->image&&$request->extension_image){
                //Delete File
                Storage::disk('public')->delete($Location->photo);
                $this->SaveFile($Location,$request->image, $request->extension_image, '/images/Locations/');
            }
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function SaveFile($obj,$code, $extension_file, $path)
    {
        $image = $code;
        switch ($extension_file) {
            case 'png':            
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path.str_random(10).$obj->id.'.png';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->photo = $imageURL;
                $obj->save();
                return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                break;
            case 'jpg':            
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path.str_random(10).$obj->id.'.jpg';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->photo = $imageURL;
                $obj->save();
                return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                break;
            case 'gif':
                $image = str_replace('data:image/gif;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path.str_random(10).$obj->id.'.gif';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->photo = $imageURL;
                $obj->save();
                return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                break;                                                
            default:
                return response()->json(['success'=>false,'msg'=>'Registro existoso, tipo de archivo incompatible.']);
                break;
        }
    }
    public function destroy(Request $request)
    {
        $Location = Location::find($request->id);
        $Location->state = "ELIMINADO";
        $Location->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function show($id)
    {
        $Location = Location::find($id);
        return $Location->toJson();
    }
    public function edit(Request $request)
    {
        $Location = Location::find($request->id);
        return $Location->toJson();
    }  
}
