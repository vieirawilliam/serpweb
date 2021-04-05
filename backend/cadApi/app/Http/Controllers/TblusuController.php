<?php

namespace App\Http\Controllers;

use App\tblusu;
use App\Modulousu;
use App\Menuusu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Traits\FuncoesTrait;

class TblusuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    Use FuncoesTrait;
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $result =  tblusu::ListaUsuarios($request->perpage, $request->sortBy, $request->sortDesc, strtoupper($request->filter), $request->scond1);
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
            
            $regras = tblusu::RegraValidacao($data['id']);
            $mensagens = tblusu::MensagensValicacao();

            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }
            
            $maxcodusu = tblusu::select('usucod')->orderBy('usucod','desc')->limit(1)->get();  
            $usucod = $maxcodusu[0]->usucod ;
            $usucod = str_pad( $usucod + 1, 4, '0', STR_PAD_LEFT);
            
            $password = $this->codIF(strtoupper($data['ususenha']));                 
            
            $data['usucod']=$usucod;
            $data['ususenha']=$password;

            $result = tblusu::create($data);                      // GRAVAR USUARIO TBLUSU
            $idusu = $result->id;

            $Modulousu = new Modulousu;
            $Modulousu->store($data['modulos'], $idusu);         // GRAVA MODULO DO USUARIO
            
            $Menuusu = new Menuusu;
            $Menuusu->store($data['menus'], $idusu);              // GRAVA MENUUSU DO USUARIO

            DB::commit();
            return response()->json(['success' => $result], 200);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error'=>'Erro ao gravar o usuário'], 200);
        }
    }
    public function show($id)
    {
        $tblusu = tblusu::where('id',$id)->first();
        $tblusu->ususenha = $this->decodIF($tblusu->ususenha);  
        return response()->json(['success' => $tblusu], 200);
    }
    public function update(Request $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $data = $request->all();
            
            $regras = tblusu::RegraValidacao($id);
            $mensagens = tblusu::MensagensValicacao();
    
            $validatedData = Validator::make($data, $regras, $mensagens);

            if ($validatedData->fails()) {
                return response()->json(['errors'=>$validatedData->errors()], 200);
            }   
            
            $password = $this->codIF(strtoupper($data['ususenha']));
            $data['ususenha']=$password;

            $result = tblusu::find($id)->update($data);          //ALTERA TBLUSU
            
            $Modulousu = new Modulousu;
            $Modulousu->atualiza($data['modulos'], $id);         //ALTERA MODULOUSU
            
            $Menuusu = new Menuusu;
            $Menuusu->atualiza($data['menus'], $id);             //ALTERA MENU_USU

            DB::commit();
            return response()->json(['success' => $result], 200);
            
        } catch (\Throwable $th) {            
            DB::rollback();
            return response()->json(['error'=>'Erro ao alterar o usuário'], 200);
        }
    }
    public function destroy($id)
    {
        $result = tblusu::find($id)->delete();
        return response()->json(['success' => $result], 200);
    }
    public function retornafotogravatar($email){
        $foto = FuncoesTrait::getAvatar($email);
        return $foto;
    }    
}
