<?php

namespace App\Http\Controllers;

use App\Tabmenu;
use Illuminate\Http\Request;
use Auth;

class TabmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result =  Tabmenu::ListaTabmenu();
        return response()->json(['success' => $result], 200);
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
     * @param  \App\Tabmenu  $tabmenu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$tabmenu = Tabmenu::ListaTabmenuMod($id,0);
        $tabmenu = Tabmenu::ListaTabmenuAll();
        return response()->json(['success' => $tabmenu], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tabmenu  $tabmenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tabmenu $tabmenu)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tabmenu  $tabmenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tabmenu $tabmenu)
    {
        //
    }
}
