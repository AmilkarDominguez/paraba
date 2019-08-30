<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// importados
use App\TypeCatalogue;
use App\Catalogue;
use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CatalogueRequest;
use Validator;

use Caffeinated\Shinobi\Middleware\UserHasRole;

class CatalogueController extends Controller
{
    public function __construct()
    {
        /*
        $this->middleware('permission:industry')->only('industry');
        $this->middleware('permission:line')->only('line');
        $this->middleware('permission:deposit')->only('deposit');
        $this->middleware('permission:zone')->only('zone');   
        */
    }
    public function datatable(Request $request)
    {
        //$isUser = auth()->user()->can(['catalogs.edit', 'catalogs.destroy']);
        $visibility = "";
        //if (!$isUser) {$visibility="disabled";}
        return datatables()->of(Catalogue::all()->where('type_catalogue_id', $request->type_catalogue_id)->where('state','!=','ELIMINADO'))
        ->addColumn('Editar', function ($item) use ($visibility) {
            $item->v=$visibility;
        return '<a class="btn btn-primary btn-circle btn-sm text-white '.$item->v.'" onclick="Edit('.$item->id.')" ><i class="fas fa-pen"></i></a>';
        })
        ->addColumn('Eliminar', function ($item) {
        return '<a class="btn btn-danger btn-circle btn-sm text-white '.$item->v.'" onclick="Delete(\''.$item->id.'\')"><i class="fas fa-trash"></i></a>';
        })
        ->rawColumns(['Editar','Eliminar'])  
        ->toJson();
    }
    public function index(Request $request)
    {

    }
    public function store(Request $request)
    {
        $rule = new CatalogueRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Catalogue::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function show($id)
    {
        $Catalogue = Catalogue::find($id);
        return $Catalogue->toJson();
    }
    public function edit(Request $request)
    {
       $Catalogue = Catalogue::find($request->id);
        return $Catalogue->toJson();
    }
    public function update(Request $request)
    {
        $rule = new CatalogueRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Catalogue = Catalogue::find($request->id);
            $Catalogue->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro actualizado existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Catalogue = Catalogue::find($request->id);
        $Catalogue->state = "ELIMINADO";
        $Catalogue->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }

    // Return Views
    public function country()
    {
        return view('catalogues.country');
    }
    public function document_type()
    {
        return view('catalogues.document_type');
    }
    public function occupation()
    {
        return view('catalogues.occupation');
    }
    public function language()
    {
        return view('catalogues.language');
    }
    public function tag()
    {
        return view('catalogues.tag');
    }
    public function transport_type()
    {
        return view('catalogues.transport_type');
    }
    public function location_type()
    {
        return view('catalogues.location_type');
    }
    // lista los catalogos depende del id que pase
    public function list(Request $request)
    {
        switch ($request->by)
        {
            case 'type_catalogue_id':
                $list=Catalogue::All()
                ->where('type_catalogue_id',$request->type_catalogue_id)
                ->where('state','ACTIVO');
                return $list;
            break;
            case 'all':
                $list=Catalogue::All()->where('state','ACTIVO');
                return $list;
            break;         
            default:
            break;
        }
    }

}
