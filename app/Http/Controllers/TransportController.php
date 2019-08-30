<?php

namespace App\Http\Controllers;

use App\Transport;
use Illuminate\Http\Request;
use App\Catalogue;
use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\TransportRequest;
use Validator;
use Illuminate\Support\Facades\Storage;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('articles.transport');
    }
    public function datatable(Request $request)
    {
        //$isUser = auth()->user()->can(['catalogs.edit', 'catalogs.destroy']);
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
        return datatables()->of(Transport::all()->where('state','!=','ELIMINADO'))
        ->addColumn('Detalles', function ($item) use ($visibility) {
            $item->v=$visibility;
        return '<a class="btn btn-info btn-circle btn-sm text-white '.$item->v.'" onclick="Details('.$item->id.')" ><i class="fas fa-list-alt"></i></a>';
        })
        ->addColumn('Editar', function ($item) {
            return '<a class="btn btn-primary btn-circle btn-sm text-white '.$item->v.'" onclick="Edit(\''.$item->id.'\')"><i class="fas fa-pen"></i></a>';
        })
        ->addColumn('Eliminar', function ($item) {
        return '<a class="btn btn-danger btn-circle btn-sm text-white '.$item->v.'" onclick="Delete(\''.$item->id.'\')"><i class="fas fa-trash"></i></a>';
        })
        ->rawColumns(['Detalles','Editar','Eliminar'])  
        ->toJson();
    }
    public function store(Request $request)
    {
        $rule = new TransportRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $transport = Transport::create($request->all());        
            //IMAGE 
            if($request->image){
                $image = $request->image;
                switch ($request->extension_image) {
                    case 'jpg':
                        $image = str_replace('data:image/jpeg;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageURL = '/images/transports/'.str_random(10).$transport->id.'.jpg';
                        Storage::disk('public')->put($imageURL,  base64_decode($image));
                        $transport->photo = $imageURL;
                        $transport->save();
                        return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                        break;
                    case 'png':
                        $image = str_replace('data:image/png;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageURL = '/images/transports/'.str_random(10).$transport->id.'.png';
                        Storage::disk('public')->put($imageURL,  base64_decode($image));
                        $transport->photo = $imageURL;
                        $transport->save();
                        return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                        break;
                    case 'gif':
                        $image = str_replace('data:image/gif;base64,', '', $image);
                        $image = str_replace(' ', '+', $image);
                        $imageURL = '/images/transports/'.str_random(10).$transport->id.'.gif';
                        Storage::disk('public')->put($imageURL,  base64_decode($image));
                        $transport->photo = $imageURL;
                        $transport->save();
                        return response()->json(['success'=>true,'msg'=>'Registro existoso']);
                        break;                        
                    default:
                        return response()->json(['success'=>false,'msg'=>'Registro existoso, imágen no aceptada solo esta permitido imágenes JPG, GIF ó PNG.']);
                        break;
                }
            }
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return Transport::find($request->id)->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport $transport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        //
    }
}
