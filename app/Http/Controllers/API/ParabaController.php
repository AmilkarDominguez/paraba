<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Transport;
use App\Location;
use App\Post;

class ParabaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function app()
    {
        return view('app.main');
    }
    public function screen_transports()
    {
        return view('app.transports');
    }
    public function screen_locations()
    {
        return view('app.locations');
    }
    public function screen_posts()
    {
        return view('app.posts');
    }
    public function list_transports()
    {
        return Transport::where('state','ACTIVO')->with('transport_type','language')->get();
    }
    public function list_locations()
    {
        return Location::where('state','ACTIVO')->with('location_type','language')->get();
    }
    public function list_posts()
    {
        return Post::where('state','ACTIVO')->with('tag','language')->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
