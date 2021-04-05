<?php

namespace App\Http\Middleware;

use Config;
use DB;
use Schema;

class setBancoDb
{

    public function setConnect($plano)
    {

        DB::purge('plano');
        DB::purge('financeiro');

        \Config::set('database.connections.plano.host', $plano['plano']['host']);
        \Config::set('database.connections.plano.database', $plano['plano']['database']);
        \Config::set('database.connections.plano.username', $plano['plano']['user']);
        \Config::set('database.connections.plano.password', $plano['plano']['password']);
        \Config::set('database.connections.plano.port', $plano['plano']['port']);
        \Config::set('database.connections.plano.schema', $plano['plano']['schema']);

        \Config::set('database.connections.financeiro.host', $plano['financeiro']['host']);
        \Config::set('database.connections.financeiro.database', $plano['financeiro']['database']);
        \Config::set('database.connections.financeiro.username', $plano['financeiro']['user']);
        \Config::set('database.connections.financeiro.password', $plano['financeiro']['password']);
        \Config::set('database.connections.financeiro.port', $plano['financeiro']['port']);
        \Config::set('database.connections.financeiro.schema', $plano['financeiro']['schema']);
        

        DB::reconnect('plano');
        DB::reconnect('financeiro');


        Schema::connection('plano')->getConnection()->reconnect();
        Schema::connection('financeiro')->getConnection()->reconnect();
    }
}
