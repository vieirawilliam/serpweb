<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menuusu extends Model
{
    protected $table    = "menu_usu";
    protected $fillable = [
        'codmenu', 'codusu', 'incluir', 'alterar', 'excluir', 'consultar', 'id_tblusu', 'id', 'id_tabmenu'
    ];
    public $timestamps = false;

    public static function ListaMenuUsu($id_usu)
    {

        $data = DB::select(DB::raw("select menu_usu.id, tabmenu.id_mod::varchar, tabmenu.nmtela, menu_usu.incluir, menu_usu.alterar, menu_usu.excluir, menu_usu.consultar 
        from menu_usu inner join tabmenu on menu_usu.id_tabmenu = tabmenu.id
        where menu_usu.id_tblusu = :id_usu order by tabmenu.nmtela asc"), 
        array('id_usu' => $id_usu));
        
        
        //$data = DB::table('menu_usu')
        //    ->join('tabmenu', 'menu_usu.id_tabmenu', '=', 'tabmenu.id')
        //    ->select('menu_usu.id', 'tabmenu.id_mod', 'tabmenu.nmtela', 'menu_usu.incluir', 'menu_usu.alterar', 'menu_usu.excluir', 'menu_usu.consultar')
        //    ->Where('id_tblusu', '=', $id_usu)
        //    ->orderBy('tabmenu.nmtela', 'asc')
        //    ->get();

        return $data;
    }
    public static function ListaMenuUsuMod($id_usu)
    {

        $data = DB::select(DB::raw("select menu_usu.id, tabmenu.id_mod::varchar, tabmenu.nmtela, tabmenu.caminho, menu_usu.incluir, menu_usu.alterar, menu_usu.excluir, menu_usu.consultar 
        from menu_usu inner join tabmenu on menu_usu.id_tabmenu = tabmenu.id
        where menu_usu.id_tblusu = :id_usu and menu_usu.consultar ='S' order by tabmenu.nmtela asc"), 
        array('id_usu' => $id_usu));                

        return $data;
    }
    public function store($dados, $idusu)
    {
        DB::beginTransaction();
        try {
            foreach ($dados as $key => $value) {
                if(count($value) > 0){
                    foreach ($value['menus'] as $key) {
                        $Menuusu = new Menuusu;
                        $Menuusu->id_tblusu = $idusu;
                        $Menuusu->codusu = $idusu;
                        $Menuusu->codmenu = $key['id'];
                        $Menuusu->id_tabmenu = $key['id'];
                        $Menuusu->incluir = $key['incluir'];
                        $Menuusu->alterar = $key['alterar'];
                        $Menuusu->excluir = $key['excluir'];
                        $Menuusu->consultar = $key['consultar'];
                        $Menuusu->save();
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'error'], 200);
        }
    }
    public function atualiza($dados, $idusu)
    {
        DB::beginTransaction();
        try {
            foreach ($dados as $key => $value) {
                if(count($value) > 0){
                    foreach ($value['menus'] as $key) {
                        $Menuusu = Menuusu::where('id', '=', $key['id'])->first();
                        $Menuusu->incluir = $key['incluir'];
                        $Menuusu->alterar = $key['alterar'];
                        $Menuusu->excluir = $key['excluir'];
                        $Menuusu->consultar = $key['consultar'];
                        $Menuusu->save();
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'error'], 200);
        }
    }
}
