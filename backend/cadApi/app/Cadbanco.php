<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadbanco extends Model
{
    protected $table    = "cadbanco";
    protected $guarded  = [];
    public $timestamps = false;
    public static function ListaCadbanco($paginate,$ordem, $asc, $filter, $scond)
    {

        if($filter != 'null' && $filter != ''){
            if($scond === "TODOS")
            {
                $data = Cadbanco::where('codbanco','like','%'.$filter.'%')
                            ->orWhere('descbanco', 'like', '%'.$filter.'%')
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = Cadbanco::where('codbanco','like','%'.$filter.'%')
                            ->orWhere('descbanco', 'like', '%'.$filter.'%')                            
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }
            return $data;            
        }else{
            if($scond != "TODOS"){                
                $data = Cadbanco::Where('status', '=', $scond)->orderBy($ordem, $asc)->paginate($paginate); 
            }else{
                $data = Cadbanco::orderBy($ordem, $asc)->paginate($paginate);
            }               
            return $data; 
        }
    }
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);
        if (is_string($key)) {
            if($value != ''){
                $this->attributes[$key] = trim(mb_strtoupper($value));
            }    
        }
    }
    public static function RegraValidacao(){
        $regras = [ // <---
            'descbanco' => ['required'],
            'status' => ['required'],
            'numbanco' => ['required'],
            'agencia' => ['required'],
            'conta' => ['required'],
            'seqboleto' => ['required'],
            'remessa' => ['required']     
        ];

        return $regras;
    }
    public static function MensagensValicacao(){
        $mensagens = [
            'descbanco.required'=>'Descrição do banco é obrigatório',
            'status.required'=>'Status do banco é obrigatório',
            'numbanco.required'=>'Número do banco é obrigatório',
            'agencia.required'=>'Agência do banco é obrigatório',
            'conta.required'=>'Conta do banco é obrigatório',
            'seqboleto.required'=>'Número do boleto é obrigatório',
            'remessa.required'=>'Sequencia da remessa é obrigatório'         
        ];
        return $mensagens;
    }
    public static function CarregaSelectformapag()
    {
        $data = Cadbanco::orderBy('descbanco','asc')->get();
        return $data;
    }
}