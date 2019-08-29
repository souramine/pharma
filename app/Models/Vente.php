<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $table = 'vente';

    public function medicaments(){
        return $this->belongsTo('App\Models\Medicament');
    }

    public function pharmaciens(){
        return $this->belongsTo('App\Models\Pharmacien');
    }
}
