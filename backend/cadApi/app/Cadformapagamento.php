<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadformapagamento extends Model
{
    protected $table    = "cadformapagamento"; 
    protected $guarded  = [];
    public $timestamps = false;

    public static function ListaFormapagamento($paginate,$ordem, $asc, $filter, $scond)
    {

        if($filter != 'null' && $filter != ''){
            if($scond === "TODOS")
            {
                $data = Cadformapagamento::where('codformapag','like','%'.$filter.'%')
                            ->orWhere('descformapag', 'like', '%'.$filter.'%')
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = Cadformapagamento::where('codformapag','like','%'.$filter.'%')
                            ->orWhere('descformapag', 'like', '%'.$filter.'%')                            
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }
            return $data;            
        }else{
            if($scond != "TODOS"){                
                // $data = Cadformapagamento::Where('status', '=', $scond)->orderBy($ordem, $asc)->paginate($paginate); 
            }else{
                $data = Cadformapagamento::orderBy($ordem, $asc)->paginate($paginate);
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
            'descformapag' => ['required']     
        ];

        return $regras;
    }
    public static function MensagensValicacao(){
        $mensagens = [
            'descformapag.required'=>'Descrição da forma de pagamento é obrigatório'          
        ];
        return $mensagens;
    }
    public static function CarregaSelectformapag()
    {
        $data = Cadformapagamento::orderBy('descformapag','asc')->get();
        return $data;
    }
}
