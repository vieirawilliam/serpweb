<?php

namespace App\Http\Controllers;

use App\Cadmod;
use Illuminate\Http\Request;

class CadmodController extends Controller
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
    public function index()
    {
        $result =  Cadmod::ListaModulos();
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
     * @param  \App\Cadmod  $cadmod
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cadmod = Cadmod::find($id);
        return response()->json(['success' => $cadmod], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cadmod  $cadmod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cadmod $cadmod)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cadmod  $cadmod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cadmod $cadmod)
    {
        //
    }
}
