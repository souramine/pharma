<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    protected $table = 'lot';

    public function fournisseurs(){
        return $this->belongsTo('App\Models\Fournisseur');
    }

    public function medicaments(){
        return $this->belongsTo('App\Models\Medicament');
    }

    public function pharmaciens(){
        return $this->belongsTo('App\Models\Pharmacien');
    }
}
