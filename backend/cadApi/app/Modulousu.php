<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Modulousu extends Model
{
    protected $table    = "modulousu";
    protected $fillable = [
        'id_tblusu', 'id_cadmod', 'permite'
    ];
    public $timestamps = false;

    public static function ListaModulosusu($id_usu)
    {
     
        $data = DB::select(DB::raw("select cadmod.id::varchar, cadmod.nome_mod, modulousu.permite from 
        cadmod inner join modulousu on cadmod.id = modulousu.id_cadmod where modulousu.id_tblusu = :id_usu order by cadmod.nome_mod asc"), 
        array('id_usu' => $id_usu));

        //$data = DB::table('cadmod')
        //    ->join('modulousu', 'cadmod.id', '=', 'modulousu.id_cadmod')
        //    ->select('cadmod.id::varchar', 'cadmod.nome_mod', 'modulousu.permite')
        //    ->Where('id_tblusu', '=', $id_usu)
        //    ->orderBy('id_cadmod', 'asc')
        //    ->get();
        
        return $data;
    }
    public static function ListaModulosusuPermitidos($id_usu)
    {
     
        $data = DB::select(DB::raw("select cadmod.id::varchar, cadmod.nome_mod, cadmod.icone,modulousu.permite from 
        cadmod inner join modulousu on cadmod.id = modulousu.id_cadmod where permite = 'S' and modulousu.id_tblusu = :id_usu order by cadmod.nome_mod asc"), 
        array('id_usu' => $id_usu));
        
        return $data;
    }
    public function store($dados, $idusu)
    {
        DB::beginTransaction();
        try {
            foreach ($dados as $key => $value) {
                $Modulousu = new Modulousu;
                $Modulousu->id_tblusu = $idusu;
                $Modulousu->id_cadmod = $value['id'];
                $Modulousu->permite = $value['permite'];
                $Modulousu->save();
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
                $Modulousu = Modulousu::where('id_cadmod','=',$value['id'])
                                        ->where('id_tblusu','=',$idusu)->first();                
                $Modulousu->permite = $value['permite'];
                $Modulousu->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => 'error'], 200);
        }
    }

}
