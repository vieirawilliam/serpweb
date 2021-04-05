<?php
namespace App\Traits;

trait FuncoesTrait  {

    #FUNÇÃO DE CODIFICAR SENHA
    public static function codIF($texto): string
    {
        $n = 0;
        $senha = "";

        for ($n = strlen($texto) - 1; $n >= 0; $n--) {
            $senha .= chr(ord(substr($texto, $n, 1)) - 20);
        }
        return $senha;
    }
    #FUNÇÃO DE DESCODIFICAR SENHA
    public static function decodIF($texto): string
    {
        # code...
        $n = 0;
        $senha = "";

        for ($n = strlen($texto) - 1; $n >= 0; $n--) {
            $senha .= chr(ord(substr($texto, $n, 1)) + 20);
        }
        return $senha;
    }
    #RETORNA IMAGEM DO GRAVATAR
    public static function getAvatar($emailusuario) {
        
        $email   = $emailusuario; // e-mail de cadastro para pegar as imagens
        $default = 'mm'; // imagem alternativa para se não existir
        $size    = 80; // tamanho da imagem
        $grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) .
        "?d=" .  $default  . "&s=" . $size;
        return $grav_url;
    }

}
