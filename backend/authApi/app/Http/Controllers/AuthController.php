<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\tblusu;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function codif($string) {

        //dd($string);
        $var = "";
        for ($n = 0; $n < strlen($string); $n++) {
            $var .= chr(ord(substr($string, $n, 1)) - 20);
        }
        return strrev($var);
    }
    public function login()
    {
        $usunome    = request(['usunome']);
        $ususenha   = request(['ususenha']);

       // dd($usunome);

        $dados = tblusu::where('usunome',$usunome['usunome'])->where('ususenha',$this->codif($ususenha['ususenha']))->first();

        if(!$dados){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$token = auth()->login($dados)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'user'          => $this->me(),
            'expires_in'    => auth()->factory()->getTTL() * 60
        ]);
    }
}