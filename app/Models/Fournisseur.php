<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $table = 'fournisseurs';

    public function lots(){
        return $this->hasMany('App\Models\Lot');
    }
}
