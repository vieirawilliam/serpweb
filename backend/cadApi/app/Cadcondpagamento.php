<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadcondpagamento extends Model
{
    protected $table    = "cadcondpagamento"; 
    protected $fillable = [
        'codcondpag', 'desccondpag','numeroparcelas','prazo','tipo','usucod'
    ];
    public $timestamps = false;

    public static function ListaCondpagamento($paginate,$ordem, $asc, $filter, $scond)
    {

        if($filter != 'null' && $filter != ''){
            if($scond === "TODOS")
            {
                $data = Cadcondpagamento::where('codger','like','%'.$filter.'%')
                            ->orWhere('nomeger', 'like', '%'.$filter.'%')
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = Cadcondpagamento::where('codger','like','%'.$filter.'%')
                            ->orWhere('nomeger', 'like', '%'.$filter.'%')
                            ->Where('status', '=', $scond)
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }
            return $data;            
        }else{
            if($scond != "TODOS"){                
                $data = Cadcondpagamento::Where('status', '=', $scond)->orderBy($ordem, $asc)->paginate($paginate); 
            }else{
                $data = Cadcondpagamento::orderBy($ordem, $asc)->paginate($paginate);
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
            'desccondpag' => ['required', 'min:4'],
            'numeroparcelas' => ['required'],
            'prazo' => ['required',],
            'tipo' => ['required',]
        ];

        return $regras;
    }
    public static function MensagensValicacao(){
        $mensagens = [
            'desccondpag.required'=>'Descri????o ?? obrigat??rio',
            'desccondpag.min'=>'Tamanho m??nimo de 4',
            'numeroparcelas.required'=>'N??mero de parcelas ?? obrigat??rio',
            'prazo.required'=>'Prazo ?? obrigat??rio',
            'tipo.required'=>'Tipo ?? obrigat??rio'
        ];
        return $mensagens;
    }
    public static function CarregaSelectcondpag()
    {
        $data = Cadcondpagamento::orderBy('desccondpag','asc')->get();
        return $data;
    }
}
