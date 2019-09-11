<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pharmacien extends Authenticatable
{
	use Notifiable;
    protected $table = 'pharmacies';


    
    public function lots(){
        return $this->hasMany('App\Models\Lot');
    }

    public function ventes(){
        return $this->hasMany('App\Models\Vente');
    }

    public function getAuthPassword(){
      return $this->password;
    }

}
