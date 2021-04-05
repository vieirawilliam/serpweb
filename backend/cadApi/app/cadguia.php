<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cadguia extends Model
{
    
    protected $guarded  = [];
    protected $table    = "cadguia"; 

    
    public function codguia()
    {
        return 'codguia';
    }
    
}
