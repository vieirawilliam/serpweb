<?php

namespace App\Http\Controllers;

use App\Cadformapagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CadformapagamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $result =  Cadformapagamento::ListaFormapagamento($request->perpage, $request->sortBy, $request->sortDesc, strtoupper($request->filter), $request->scond1);
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

            $regras = Cadformapagamento::RegraValidacao();
            $mensagens = Cadformapagamento::MensagensValicacao();
            
            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }           
            
            $result = Cadformapagamento::create($data);
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
     * @param  \App\cadger  $cadger
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cadger = Cadformapagamento::find($id);
        return response()->json(['success' => $cadger], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cadger  $cadger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        DB::beginTransaction();
        try {
            $data = $request->all();
            
            $regras = Cadformapagamento::RegraValidacao();
            $mensagens = Cadformapagamento::MensagensValicacao();

            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }    
            $result = Cadformapagamento::find($id)->update($data);
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
     * @param  \App\cadger  $cadger
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Cadformapagamento::find($id)->delete();
        return response()->json(['success' => $result], 200);
    }
    public function carregaselect()
    {
        $result = Cadformapagamento::CarregaSelectformapag();

        try {
            return response()->json(['success' => $result], 200);
        } catch (\Throwable $th) {    
            return response()->json(['error'=>'error'], 200);
        }
    }
}
