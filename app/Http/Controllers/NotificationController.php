<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\NotificationRequest;
use Validator;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    public function index()
    {
        return view('articles.notification');
    }
    public function datatable(Request $request)
    {
        //$isUser = auth()->user()->can(['catalogs.edit', 'catalogs.destroy']);
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
        return datatables()->of(Notification::where('state','!=','ELIMINADO'))
        ->addColumn('Imagen', function ($item) use ($visibility) {
            $item->v=$visibility;
        return '<img src="'.$item->photo.'" alt="image" width="125px" onclick="window.open(\''.$item->photo.'\');"></img>';
        })
        ->addColumn('Enlace1', function ($item) {
        return '<a class="btn btn-info btn-circle btn-sm text-white '.$item->v.'" onclick="window.open(\''.$item->link.'\');"><i class="fas fa-link"></i></a>';
        })        
        ->addColumn('Enlace2', function ($item) {
            return '<a class="btn btn-info btn-circle btn-sm text-white '.$item->v.'" onclick="window.open(\''.$item->link2.'\');"><i class="fas fa-link"></i></a>';
        })
        ->addColumn('Eliminar', function ($item) {
        return '<a class="btn btn-danger btn-circle btn-sm text-white '.$item->v.'" onclick="Delete(\''.$item->id.'\')"><i class="fas fa-trash"></i></a>';
        })
        ->rawColumns(['Imagen','Enlace1','Enlace2','Eliminar'])  
        ->toJson();
    }
    public function store(Request $request)
    {
        $rule = new NotificationRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Notification = Notification::create($request->all());        
            //IMAGE 
            if($request->image){
                $image = $request->image;
                $this->SaveFile($Notification,$request->image, $request->extension_image, '/images/Notifications/');
            }
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function update(Request $request)
    {
        $rule = new NotificationRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Notification = Notification::find($request->id);
            $Notification->update($request->all());

            if($request->image&&$request->extension_image){
                //Delete File
                Storage::disk('public')->delete($Notification->photo);
                $this->SaveFile($Notification,$request->image, $request->extension_image, '/images/Notifications/');
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
        $Notification = Notification::find($request->id);
        $Notification->state = "ELIMINADO";
        $Notification->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function show($id)
    {
        $Notification = Notification::find($id);
        return $Notification->toJson();
    }
    public function edit(Request $request)
    {
        $Notification = Notification::find($request->id);
        return $Notification->toJson();
    }  
}
