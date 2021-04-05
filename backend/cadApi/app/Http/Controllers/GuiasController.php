<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\cadguia;

class GuiasController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function listGuias(){

        $dados = cadguia::all();

        dd($dados);

        return $dados;
    }

}