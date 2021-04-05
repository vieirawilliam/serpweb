<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class tblusu extends Authenticatable implements JWTSubject
{
    use Notifiable;
    
    protected $guarded  = [];
    protected $table    = "tblusu"; 

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
}
