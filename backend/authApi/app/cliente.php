<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $connection = "mplanclientes";
    public $timestamps = false;
    protected $fillable = [
        'cliente_name', 'cliente_unidade_nome', 'cliente_email','cliente_ip','cliente_porta','cliente_tabela', 'cliente_unidade', 'status'
    ];

    public function modulos()
    {
        return $this->hasMany('App\modulos','cliente_id','id');
    }
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);
        if (is_string($key)) {
            if($value != ''){
                if ( $key === 'cliente_unidade_nome' || $key === 'cliente_email'){
                    $this->attributes[$key] = trim(mb_strtoupper($value));
                }                            
            }    
        }
    }
    public static function ListaClientes($paginate,$ordem, $asc, $filter, $scond)
    {
        if($filter != 'null' && $filter != ''){
            if($scond === "TODOS")
            {
                $data = cliente::where('cliente_unidade_nome','like','%'.$filter.'%')
                            ->orWhere('cliente_tabela', 'like', '%'.$filter.'%')
                            ->orWhere('cliente_name', 'like', '%'.$filter.'%')
                            ->orWhere('cliente_ip', 'like', '%'.$filter.'%')
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = cliente::where('cliente_unidade_nome','like','%'.$filter.'%')
                            ->orWhere('cliente_tabela', 'like', '%'.$filter.'%')
                            ->orWhere('cliente_name', 'like', '%'.$filter.'%')
                            ->orWhere('cliente_ip', 'like', '%'.$filter.'%')
                            ->Where('status', '=', $scond)
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }
            return $data;            
        }else{
            if($scond != "TODOS"){                
                $data = cliente::Where('status', '=', $scond)->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = cliente::orderBy($ordem, $asc)->paginate($paginate);
            }               
            return $data; 
        }
    }
    public static function RegraValidacao(){
        $regras = [ // <---
            'cliente_name' => ['required'],
            'cliente_ip' => ['required'],
            'cliente_porta' => ['required'],
            'cliente_tabela' => ['required'],
            'cliente_unidade_nome' => ['required']
        ];

        return $regras;
    }
    public static function MensagensValicacao(){
        $mensagens = [
            'cliente_name.required'=>'Domínio é obrigatório',
            'cliente_ip.required'=>'IP é um campo obrigatório',
            'cliente_porta.required'=>'Porta é um campo obrigatório',
            'cliente_tabela.required'=>'Banco é um campo obrigatório',
            'cliente_unidade_nome.required'=>'Nome é um campo obrigatório'
        ];
        return $mensagens;
    }
}
