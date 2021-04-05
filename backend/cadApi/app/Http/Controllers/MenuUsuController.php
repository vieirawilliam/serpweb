<?php

namespace App\Http\Controllers;

use App\Menuusu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MenuUsuController extends Controller
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
    public function index(Request $request)
    {
        $idusu = $request->usuario;
        $result = Menuusu::ListaMenuUsu($idusu);
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
        DB::beginTransaction();
        try {
            $data = $request->all();
            $result = Menuusu::create( $data);
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
     * @param  \App\Menu_usu  $menu_usu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu_usu  $menu_usu
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu_usu  $menu_usu
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
    public function listmenuusumodpermitido(Request $request){
        $idusu = $request->idtblusu;
        $result = Menuusu::ListaMenuUsuMod($idusu);
        return response()->json(['success' => $result], 200);
    }
}
