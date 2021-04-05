<?php

namespace App\Http\Controllers;

use App\Cadparam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CadparamController extends Controller
{
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
        $result =  Cadparam::ListaCadparam($request->perpage, $request->sortBy, $request->sortDesc, strtoupper($request->filter), $request->scond1);
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

            //$regras = Cadparam::RegraValidacao();
            //$mensagens = Cadparam::MensagensValicacao();
            //$validatedData = Validator::make($data, $regras, $mensagens);

            //if ($validatedData->fails()) {
            //    return response()->json(['errors'=>$validatedData->errors()], 200);
            //}

            $result = Cadparam::create($data);
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
     * @param  \App\Parametros  $parametros
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parametros = Cadparam::find($id);
        return response()->json(['success' => $parametros], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parametros  $parametros
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            $regras = Cadparam::RegraValidacao();
            $mensagens = Cadparam::MensagensValicacao();

            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            } 
                       
            $result = Cadparam::find($id)->update($data);
            DB::commit();
            return response()->json(['success' => $result], 200);
            
        } catch (\Throwable $th) {            
            DB::rollback();
            return response()->json(['error'=>'error'], 200);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parametros  $parametros
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Cadparam::find($id)->delete();
        return response()->json(['success' => $result], 200);
    }
    public function retornaparametros(Request $request)
    {
        
        $parametros = Cadparam::getParametros($request);
    
        return response()->json(['success' => $parametros], 200);
    }
}
