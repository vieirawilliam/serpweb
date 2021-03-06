<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Rule;

class tblusu extends Authenticatable implements JWTSubject
{
    use Notifiable;
    
    protected $guarded  = [];
    protected $table    = "tblusu"; 
    protected $fillable = [
        'usucod','usunome', 'ususenha','nome','situacao','status','id_codger','email','id_codvend','codvend','datacad','datafim','codfilial'
    ];
    public $timestamps = false;
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function username()
    {
        return 'usunome';
    }
    public function getAuthPassword()
    {
        return $this->ususenha;
    }
    public static function ListaUsuarios($paginate,$ordem, $asc, $filter, $scond)
    {
        if($filter != 'null' && $filter != ''){
            if($scond === "TODOS")
            {
                $data = tblusu::where('usucod','like','%'.$filter.'%')
                            ->orWhere('usunome', 'like', '%'.$filter.'%')
                            ->orWhere('nome', 'like', '%'.$filter.'%')
                            ->orWhere('status', 'like', '%'.$filter.'%')
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = tblusu::where('usucod','like','%'.$filter.'%')
                            ->orWhere('usunome', 'like', '%'.$filter.'%')
                            ->orWhere('nome', 'like', '%'.$filter.'%')
                            ->orWhere('status', 'like', '%'.$filter.'%')
                            ->Where('situacao', '=', $scond)
                            ->orderBy($ordem, $asc)->paginate($paginate);
            }
            return $data;            
        }else{
            if($scond != "TODOS"){                
                $data = tblusu::Where('situacao', '=', $scond)->orderBy($ordem, $asc)->paginate($paginate);
            }else{
                $data = tblusu::orderBy($ordem, $asc)->paginate($paginate);
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
    public static function RegraValidacao($id){
        
        $regras = [ // <---
            'usunome' => ['required', 'min:3', Rule::unique('tblusu')->ignore($id)],
            'ususenha' => ['required', 'min:6'],
            'nome' => ['required', 'min:5'],
            'codfilial' => ['required'],
            'datacad' => ['required']
        ];

        return $regras;
    }
    public static function MensagensValicacao(){
        $mensagens = [
            'usunome.required'=>'Login ?? obrigat??rio',
            'usunome.min'=>'Tamanho m??nimo de 3',
            'usunome.unique'=>'J?? existe um usu??rio com este login',
            'ususenha.required'=>'Senha ?? obrigat??rio',
            'ususenha.min'=>'Tamanho m??nimo de 6',
            'nome.required'=>'Nome ?? obrigat??rio',
            'nome.min'=>'Tamanho m??nimo de 5',
            'codfilial.required'=>'Filial ?? obrigat??rio',            
            'datacad.required'=>'Data de in??cio ?? obrigat??rio',
        ];
        return $mensagens;
    }
}
