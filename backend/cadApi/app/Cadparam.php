<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadparam extends Model
{
    protected $table    = "cadparam"; 
    protected $guarded  = [];

    public $timestamps = false;

    public static function ListaCadparam($paginate,$ordem, $asc, $filter, $scond)
    {
        $data = Cadparam::orderBy($ordem, $asc)->paginate($paginate);              
        return $data; 
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
            'pxcliente' => ['required'],
            'pxvenda' => ['required'],
            'pxcompra' => ['required'],
            'pxorcamento' => ['required'],
            'tpaberturaconta' => ['required'],
            'pesqprodvenda' => ['required'],
            'pesqvenda' => ['required'],
            'codcondpag' => ['required'],
            'codformapag' => ['required'],
            'tabela' => ['required'],
            'modeloimp' => ['required']            
        ];

        return $regras;
    }
    public static function MensagensValicacao(){
        $mensagens = [
            'pxcliente.required'=>'Proximo número do cliente obrigatório',
            'pxvenda.required'=>'Proximo número da venda obrigatório',
            'pxcompra.required'=>'Proximo número da compra é obrigatório',
            'pxorcamento.required'=>'Proximo número da orçamento é obrigatório',
            'tpaberturaconta.required'=>'Abertura de conta é obrigatório',
            'pesqprodvenda.required'=>'Pesquisa produtos - Venda é obrigatório',
            'pesqvenda.required'=>'Pesquisa - Venda é obrigatório',
            'codcondpag.required'=>'Condição de pagamento é obrigatório',
            'codformapag.required'=>'Forma de pagamento é obrigatório',
            'tabela.required'=>'Tabela de preço é obrigatório',
            'modeloimp.required'=>'Modelo de impressão é obrigatório',            
        ];
        return $mensagens;
    }
    public static function getParametros($request){
        $parametros = Cadparam::all();
        $parametros = $parametros[0];
        return $parametros;
    }
}
