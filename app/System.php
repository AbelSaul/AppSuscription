<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class System extends Model
{
    //
     public function suscriptions()
    {
    	return $this->hasMany(Suscriptions::class);
    }

}
