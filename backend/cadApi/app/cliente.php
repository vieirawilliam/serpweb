<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $connection = "mplanclientes";

    protected $fillable = [
        'cliente_name', 'cliente_unidade_nome', 'cliente_email','cliente_ip','cliente_porta','cliente_tabela', 'cliente_unidade'
    ];

    public function modulos(){
        return $this->hasMany('App\modulos','cliente_id','id');
    }
    public static function ListaClientes($paginate,$ordem, $asc, $filter, $scond)
    {
        $data = Cliente::orderBy($ordem, $asc)->paginate($paginate);              
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
            'codvend' => ['required', 'min:3'],
            'nomevend' => ['required', 'min:6']
        ];

        return $regras;
    }
    public static function MensagensValicacao(){
        $mensagens = [
            'codvend.required'=>'Código é obrigatório',
            'codvend.min'=>'Tamanho mínimo de 3',
            'nomevend.required'=>'Nome é obrigatório',
            'nomevend.min'=>'Tamanho mínimo de 6'
        ];
        return $mensagens;
    }
}
