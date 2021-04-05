<?php

namespace App;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Cadger extends Model
{
    protected $table    = "cadger"; 
    protected $fillable = [
        'codger', 'nomeger','codfilial'
    ];
    public $timestamps = false;

    public static function ListaGerentes($paginate,$ordem, $asc, $filter, $scond)
    {

        if($filter != 'null' && $filter != ''){
            if($scond === "TODOS")
            {
                $data = Cadger::where('codger','like','%'.$filter.'%')
                            ->orWhere('nomeger', 'like', '%'.$filter.'%')
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = Cadger::where('codger','like','%'.$filter.'%')
                            ->orWhere('nomeger', 'like', '%'.$filter.'%')
                            ->Where('status', '=', $scond)
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }
            return $data;            
        }else{
            if($scond != "TODOS"){                
                $data = Cadger::Where('status', '=', $scond)->orderBy($ordem, $asc)->paginate($paginate); 
            }else{
                $data = Cadger::orderBy($ordem, $asc)->paginate($paginate);
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
            'codger' => ['required', 'min:3'],
            'nomeger' => ['required', 'min:6']
        ];

        return $regras;
    }
    public static function MensagensValicacao(){
        $mensagens = [
            'codger.required'=>'Código é obrigatório',
            'codger.min'=>'Tamanho mínimo de 3',
            'nomeger.required'=>'Nome é obrigatório',
            'nomeger.min'=>'Tamanho mínimo de 6'
        ];
        return $mensagens;
    }
    public static function CarregaSelectGer()
    {
        $data = Cadger::orderBy('nomeger','asc')->get();
        return $data;
    }
}
