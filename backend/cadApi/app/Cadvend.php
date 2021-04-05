<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadvend extends Model
{
    protected $table    = "cadvend"; 
    protected $fillable = [
        'codvend', 'nomevend','codfilial'
    ];
    public $timestamps = false;
    
    public static function ListaVendedores($paginate,$ordem, $asc, $filter, $scond)
    {

        if($filter != 'null' && $filter != ''){
            if($scond === "TODOS")
            {
                $data = Cadvend::where('codvend','like','%'.$filter.'%')
                            ->orWhere('nomevend', 'like', '%'.$filter.'%')
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = Cadvend::where('codvend','like','%'.$filter.'%')
                            ->orWhere('nomevend', 'like', '%'.$filter.'%')
                            ->Where('status', '=', $scond)
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }
            return $data;            
        }else{
            if($scond != "TODOS"){                
                $data = Cadvend::Where('status', '=', $scond)->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = Cadvend::orderBy($ordem, $asc)->paginate($paginate);
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
