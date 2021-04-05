<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cadfilial;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CadfilialController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:api');
	}
    public function getFiliais(Request $request)
    {
        $filiais = cadfilial::orderBy($request->sortBy, $request->sortDesc)->paginate(5);

		return response()->json(['success' => $filiais], 200);
	}
	public function getFiliaisAtivas()
    {
        $filiais = cadfilial::where('status','ATIVO')->orderBy('nomefilial')->get();

		return response()->json(['success' => $filiais], 200);
    } 
    public function getFilialByID($codfilial)
    {
        $filial = cadfilial::where('codfilial',$codfilial)->first();

        return Response::json(['success'=>$filial], 200);
    }
    public function store(request $request)
    {
        $data = array(

			"nomefilial" => $request->nomefilial,
			"nomefantasia" => $request->nomefantasia,
			"status" => $request->status,
			"matriz" => $request->matriz,
			"tppessoa" => $request->tppessoa,
			"cpf_cnpj" => $request->cpf_cnpj,
			"telefone" => $request->telefone,
			"email" => $request->email,
			"cep" => $request->cep,
			"endereco" => $request->endereco,
			"numero" => $request->numero,
			"bairro" => $request->bairro,
			"cidade" => $request->cidade,
			"uf" => $request->uf,

		);

		$rules = array(

			"nomefilial" => "required",
			"nomefantasia" => "required",
			"status" => "required",
			"matriz" => "required",
			"tppessoa" => "required",
			"cpf_cnpj" => "required",
			"telefone" => "required",
			"email" => "required",
			"cep" => "required",
			"endereco" => "required",
			"numero" => "required",
			"bairro" => "required",
			"cidade" => "required",
			"uf" => "required",
		);

		$messages = array(

			"nomefilial.required" => "Informe o nome da filial",
			"nomefantasia.required" => "Informe o nome fantasia da filial",
			"status.required" => "Informe o status da filial",
			"matriz.required" => "informe se é a filial",
			"tppessoa.required" => "required",
			"cpf_cnpj.required" => "Informe o cnpj da filial",
			"telefone.required" => "Informe o telefone da filial",
			"email.required" => "Informe o email da filial",
			"cep.required" => "Informe o cep da filial",
			"endereco.required" => "Informe o endereço da filial",
			"numero.required" => "Informe o numero da filial",
			"bairro.required" => "Informe o bairro da filial",
			"cidade.required" => "Informe a cidade da filial",
			"uf.required" => "Informe o estado da da filial",
		);

		$validator = Validator::make($data, $rules,$messages);

		// process the login
		if ($validator->fails()) {

            return Response::json(['errors'=>$validator->errors()], 200);

		} else {

			DB::beginTransaction();

			try {

				$filial = new cadfilial;
				$filial->nomefilial 				= $request->nomefilial;
				$filial->nomefantasia 				= $request->nomefantasia;
				$filial->status 					= $request->status;
				$filial->matriz 					= $request->matriz;
				$filial->tppessoa 					= $request->tppessoa;
				$filial->cpf_cnpj 					= $request->cpf_cnpj;
				$filial->telefone 					= $request->telefone;
				$filial->email 						= $request->email;
				$filial->cep 						= $request->cep;
				$filial->endereco 					= $request->endereco;
				$filial->numero 					= $request->numero;
				$filial->bairro 					= $request->bairro;
				$filial->cidade 					= $request->cidade;
				$filial->uf 						= $request->uf;
                $filial->save();
                
                DB::commit();

                return Response::json(['success'=>'success'], 200);
			
			} catch (\Exception $e) {
				DB::rollback();
				//dd($e);
				return Response::json(['error'=>$e], 200);
			}
		}
    }
    public function update(request $request,$codfilial)
    {
        //dd($request);
        $data = array(

			"nomefilial" => $request->nomefilial,
			"nomefantasia" => $request->nomefantasia,
			"status" => $request->status,
			"matriz" => $request->matriz,
			"tppessoa" => $request->tppessoa,
			"cpf_cnpj" => $request->cpf_cnpj,
			"telefone" => $request->telefone,
			"email" => $request->email,
			"cep" => $request->cep,
			"endereco" => $request->endereco,
			"numero" => $request->numero,
			"bairro" => $request->bairro,
			"cidade" => $request->cidade,
			"uf" => $request->uf,

		);

		$rules = array(

			"nomefilial" => "required",
			"nomefantasia" => "required",
			"status" => "required",
			"matriz" => "required",
			"tppessoa" => "required",
			"cpf_cnpj" => "required",
			"telefone" => "required",
			"email" => "required",
			"cep" => "required",
			"endereco" => "required",
			"numero" => "required",
			"bairro" => "required",
			"cidade" => "required",
			"uf" => "required",
		);

		$messages = array(

			"nomefilial.required" => "Informe o nome da filial",
			"nomefantasia.required" => "Informe o nome fantasia da filial",
			"status.required" => "Informe o status da filial",
			"matriz.required" => "informe se é a filial",
			"tppessoa.required" => "required",
			"cpf_cnpj.required" => "Informe o cnpj da filial",
			"telefone.required" => "Informe o telefone da filial",
			"email.required" => "Informe o email da filial",
			"cep.required" => "Informe o cep da filial",
			"endereco.required" => "Informe o endereço da filial",
			"numero.required" => "Informe o numero da filial",
			"bairro.required" => "Informe o bairro da filial",
			"cidade.required" => "Informe a cidade da filial",
			"uf.required" => "Informe o estado da da filial",
		);

		$validator = Validator::make($data, $rules,$messages);

		// process the login
		if ($validator->fails()) {

            return Response::json(['errors'=>$validator->errors()], 200);

		} else {

			DB::beginTransaction();

			try {

				$filial = cadfilial::where('codfilial',$codfilial)->first();
				$filial->nomefilial 				= $request->nomefilial;
				$filial->nomefantasia 				= $request->nomefantasia;
				$filial->status 					= $request->status;
				$filial->matriz 					= $request->matriz;
				$filial->tppessoa 					= $request->tppessoa;
				$filial->cpf_cnpj 					= $request->cpf_cnpj;
				$filial->telefone 					= $request->telefone;
				$filial->email 						= $request->email;
				$filial->cep 						= $request->cep;
				$filial->endereco 					= $request->endereco;
				$filial->numero 					= $request->numero;
				$filial->bairro 					= $request->bairro;
				$filial->cidade 					= $request->cidade;
				$filial->uf 						= $request->uf;
                $filial->save();
                
                DB::commit();

                return Response::json(['success'=>'success'], 200);
			
			} catch (\Exception $e) {
				DB::rollback();
                dd($e);
				return Response::json(['error'=>'Exception'], 200);
			}
		}
    }
}
