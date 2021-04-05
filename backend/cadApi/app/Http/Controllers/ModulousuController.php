<?php

namespace App\Http\Controllers;

use App\Modulousu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulousuController extends Controller
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
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $result = Modulousu::create($data);
            DB::commit();
            return response()->json(['success' => $result], 200);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error'=>'error'], 200);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Modulousu  $modulousu
     * @return \Illuminate\Http\Response
     */
    public function show($id_usu)
    {
        $result =  Modulousu::ListaModulosusu($id_usu);
        return response()->json(['success' => $result], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modulousu  $modulousu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modulousu $modulousu)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modulousu  $modulousu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulousu $modulousu)
    {
        //
    }
    public function listmodusupermitidos($id_usu)
    {
        
        $result =  Modulousu::ListaModulosusuPermitidos($id_usu);
        return response()->json(['success' => $result], 200);
    }
}
