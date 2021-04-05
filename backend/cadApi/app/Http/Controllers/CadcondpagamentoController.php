<?php

namespace App\Http\Controllers;

use App\Cadcondpagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CadcondpagamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $result =  Cadcondpagamento::ListaCondpagamento($request->perpage, $request->sortBy, $request->sortDesc, strtoupper($request->filter), $request->scond1);
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

            $regras = Cadcondpagamento::RegraValidacao();
            $mensagens = Cadcondpagamento::MensagensValicacao();
            
            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }           
            
            $result = Cadcondpagamento::create($data);
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
        $cadger = Cadcondpagamento::find($id);
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
            
            $regras = Cadcondpagamento::RegraValidacao();
            $mensagens = Cadcondpagamento::MensagensValicacao();

            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }                
            $result = Cadcondpagamento::find($id)->update($data);
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
        $result = Cadcondpagamento::find($id)->delete();
        return response()->json(['success' => $result], 200);
    }
    public function carregaselect()
    {

        $result = Cadcondpagamento::CarregaSelectcondpag();

        try {
            return response()->json(['success' => $result], 200);
        } catch (\Throwable $th) {    
            return response()->json(['error'=>'error'], 200);
        }
    }
}
