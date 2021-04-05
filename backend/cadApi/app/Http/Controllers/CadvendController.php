<?php

namespace App\Http\Controllers;

use App\Cadvend;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CadvendController extends Controller
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
    public function index(Request $request)
    {
        $result =  Cadvend::ListaVendedores($request->perpage, $request->sortBy, $request->sortDesc, strtoupper($request->filter), $request->scond1);
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

            $regras = Cadvend::RegraValidacao();
            $mensagens = Cadvend::MensagensValicacao();

            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }
            $codvend = str_pad($data['codvend'], 3, '0', STR_PAD_LEFT);
            $data['codvend']=$codvend;
            $result = Cadvend::create( $data);
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
     * @param  \App\Cadvend  $cadvend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $codvend = str_pad( $id, 3, '0', STR_PAD_LEFT);
        $cadvend = Cadvend::where('id',$id)
                           ->orWhere('codvend', '=', $codvend)->first();
    
        return response()->json(['success' => $cadvend], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cadvend  $cadvend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $data = $request->all();
            
            $regras = Cadvend::RegraValidacao();
            $mensagens = Cadvend::MensagensValicacao();
    
            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }   
            $codvend = str_pad($data['codvend'], 3, '0', STR_PAD_LEFT);
            $data['codvend']=$codvend;
            $result = Cadvend::find($id)->update($data);
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
     * @param  \App\Cadvend  $cadvend
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Cadvend::find($id)->delete();
        return response()->json(['success' => $result], 200);
    }
    public function showvendedor(Request $request)
    {
        
        $id = $request->id;
        $codvend = str_pad( $id, 3, '0', STR_PAD_LEFT);
        $cadvend = Cadvend::where('id',$id)
                           ->orWhere('codvend', '=', $codvend)->first();
    
        return response()->json(['success' => $cadvend], 200);
    }
}
