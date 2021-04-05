<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Cadmod extends Model
{
    protected $table    = "cadmod"; 
    protected $fillable = [
        'id', 'nm_modulo'
    ];
    public $timestamps = false;
    
    public static function ListaModulos()
    {

        $data = DB::select(DB::raw("select cadmod.id::varchar, cadmod.nome_mod, 'N' as permite from cadmod where cadmod.id <> 0 order by cadmod.id asc"));
        return $data; 
        
    }
     
}
