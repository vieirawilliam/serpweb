<?php

namespace App\Http\Controllers;

use App\cadger;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;


class CadgerController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $result =  Cadger::ListaGerentes($request->perpage, $request->sortBy, $request->sortDesc, strtoupper($request->filter), $request->scond1);
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

            $regras = Cadger::RegraValidacao();
            $mensagens = Cadger::MensagensValicacao();
            
            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }           
            $codger = str_pad($data['codger'], 3, '0', STR_PAD_LEFT);
            $data['codger']=$codger;
            $result = Cadger::create($data);
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
        $cadger = cadger::find($id);
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
            
            $regras = Cadger::RegraValidacao();
            $mensagens = Cadger::MensagensValicacao();

            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }    
            $codger = str_pad($data['codger'], 3, '0', STR_PAD_LEFT);
            $data['codger']=$codger;
            $result = Cadger::find($id)->update($data);
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
        $result = Cadger::find($id)->delete();
        return response()->json(['success' => $result], 200);
    }
    public function carregaselect()
    {

        $result = Cadger::CarregaSelectGer();

        try {
            return response()->json(['success' => $result], 200);
        } catch (\Throwable $th) {    
            return response()->json(['error'=>'error'], 200);
        }
    }
}
