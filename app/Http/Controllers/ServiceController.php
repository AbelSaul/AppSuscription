<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suscription;

class ServiceController extends Controller
{
    //
   public function listUsersCoursesOnline(){
        $suscriptions = Suscription::join('users','suscriptions.user_id','=','users.id')
        				->select('suscriptions.enddate','users.email')
        				->where('suscriptions.system_id','=','1')
        				->get();
        return response()->json($suscriptions);
  		
   }

}
