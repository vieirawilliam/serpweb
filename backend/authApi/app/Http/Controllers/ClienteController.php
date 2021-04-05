<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
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
        $result =  Cliente::ListaClientes($request->perpage, $request->sortBy, $request->sortDesc, strtoupper($request->filter), $request->scond1);
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
            $regras = Cliente::RegraValidacao();
            $mensagens = Cliente::MensagensValicacao();

            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }

            $result = Cliente::create($data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientes = Cliente::find($id);
        return response()->json(['success' => $clientes], 200);
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
        DB::beginTransaction();
        try {
            $data = $request->all();
                   
            $regras = Cliente::RegraValidacao();
            $mensagens = Cliente::MensagensValicacao();
    
            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }   

            $result = Cliente::find($id)->update($data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $result = Cliente::find($id)->delete();
            return response()->json(['success' => $result], 200);
        } catch (\Throwable $th) {            
            DB::rollback();
            return response()->json(['error'=>'error'], 200);
        }
    }
}
