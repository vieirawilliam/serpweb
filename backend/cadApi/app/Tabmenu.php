<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Tabmenu extends Model
{
    protected $table    = "tabmenu"; 
    protected $fillable = [
        'codmenu', 'nmtela', 'nminterno', 'obs', 'nos', 'id_mod', 'id'
    ];
    public $timestamps = false;
    
    public static function ListaTabmenu()
    {
        $data = Tabmenu::orderBy('nmtela', 'asc')->get();        
        return $data; 
    }
    public static function ListaTabmenuMod($id_mod, $id_usu)
    {
        $data = DB::select(DB::raw("select tabmenu.id, tabmenu.nmtela,'N' AS incluir ,'N' AS alterar, 'N' AS excluir, 'N' AS consultar from 
        tabmenu  where tabmenu.id_mod = :id_mod order by tabmenu.nmtela asc"), 
        array('id_mod' => $id_mod));

        return $data; 
    }
    public static function ListaTabmenuAll()
    {
        $data = DB::select(DB::raw("select tabmenu.id_mod::varchar,tabmenu.id, tabmenu.nmtela,'N' AS incluir ,'N' AS alterar, 'N' AS excluir, 'N' AS consultar from 
        tabmenu order by tabmenu.nmtela asc"));

        return $data; 
    }
    public static function ListaMenuUsu($codusu)
    {
        $data = DB::raw("select t.codmenu, t.nmtela, u.* from tabmenu as t 
        left  join  menu_usu as u on t.codmenu = u.codmenu 
        and u.id_tblusu = :codusu",array('codusu',$codusu));          
        return $data; 
    }
}