<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacien extends Model
{
    protected $table = 'pharmacies';
    
    public function lots(){
        return $this->hasMany('App\Models\Lot');
    }
}
