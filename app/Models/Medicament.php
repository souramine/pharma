<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    protected $table = 'medicaments';

    public function lots(){
        return $this->hasMany('App\Models\Lot');
    }
}
