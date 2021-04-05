<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;

use App\Http\Middleware\setBancoDb;
use DB;
use App\cliente;

class setBanco
{

    public function handle($request, Closure $next)
    {
        $GerenciadorTentant = app(setBancoDb::class);
        
        $subdomain  = $this->getSub($request->getHost());
        $plano      = $this->getPlano($subdomain);

        $GerenciadorTentant->setConnect($plano);
    
        return $next($request);
    }
    
    public function getSub($host)
    {
        $subdomain = explode(".", $host);
        $subdomain = $subdomain[0];
        return $subdomain;
    }
    
    public function getPlano($subdomain)
    {
        $cliente = cliente::where('cliente_name',$subdomain)->first();
        
        if($cliente == null){
            abort(404);
        }else{

            $dadosconexao = array(
                "plano" => array(
                    "host"      => $cliente['cliente_ip'],
                    "database"  => $cliente['cliente_tabela'] ,
                    "user"      => "WARELINE" ,
                    "password"  => "BENEF" ,
                    "port"      => $cliente['cliente_porta'],
                    "schema"    => "public"
                ),
                "financeiro" => array(
                    "host"      => $cliente['cliente_ip'],
                    "database"  => $cliente['cliente_tabela'] ,
                    "user"      => "WARELINE" ,
                    "password"  => "BENEF" ,
                    "port"      => $cliente['cliente_porta'],
                    "schema"    => "financeiro"
                )
            );

            //dd($dadosconexao);

            return $dadosconexao;
        }
    }
}
    
