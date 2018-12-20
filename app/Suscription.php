<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateInterval;
use DB;

class Suscription extends Model
{
    protected $fillable = ['initdate', 'enddate','user_id','system_id'];
    private $plan;

    /*
        1. Preguntar si el usuario ya tiene una suscripcion
        2. Si tiene suscripcion calcular el nuevo initdate y enddate

    */
    
    
    public function saveSuscription($data)
    {
        $system_id = $data['system_id'];
        $this->plan = $this->evaluatePlan($data['plan']);
        $data_date = $this->consultSuscription(auth()->user()->id,$system_id);      
        $this->initdate = $data_date['initdate'];
        $this->enddate = $data_date['enddate'];
        $this->user_id = auth()->user()->id;
        $this->system_id = $data['system_id'];
        $this->save();
    }

    public function evaluatePlan($plan){
        if ($plan === 'monthly') {
            return 30;
        }else{
            return 365;
        }
    }

    public function consultSuscription($user_id,$system_id){
      
        $data_date = null;
        //retorna en forma de objeto
        $user_suscriptions = DB::table('suscriptions')
                ->where('user_id',$user_id)
                ->where('system_id',$system_id)
                ->latest()
                ->first();

        if($user_suscriptions !== null ){
            $enddate = $user_suscriptions->enddate;
            $enddate = new DateTime($enddate);
            if($enddate > $this->today()){
                return $this->registerOtherSuscription($enddate);
            }else{
                return $this->registerNewSuscription();
            }
        }else{
            return $this->registerNewSuscription();
        }    

    }

    public function registerNewSuscription(){
        $initdate = $this->today();
        $enddate = $this->addDays(new DateTime($initdate->format('Y-m-d H:i:s')),$this->plan);
        $data_date = ['initdate' => $initdate,'enddate' => $enddate];
        return $data_date;
    }

    public function registerOtherSuscription($date){
        /*
        new_initdate, newenddate eran iguales
        Que pasaba?
        El problema se debe a lo que se llama asignacion de memoria 
        tanto new_initdate y new_enddate estan en la misma posicion de memoria  en consecuencia la ultima funcion chanca al elemento que estaba anteriormente.
        Porque es el mismo objeto $date que estamos usando en ningun momento creamos otro objeto DateTime (para que pueda usar otra memoria)

        $new_initdate = $this->addDays($enddate,1);
        $new_enddate = $this->addDays($new_initdate,$this->plan);
       
        */

        $new_initdate = $this->addDays(new DateTime($date->format('Y-m-d H:i:s')),1);
        $new_enddate = $this->addDays(new DateTime($new_initdate->format('Y-m-d H:i:s')),$this->plan);
        $data_date = ['initdate' => $new_initdate,'enddate' => $new_enddate];
        return $data_date;
    }

    public function addDays($date,$number_days){
        $number_days = "P{$number_days}D";
        return  $date->add(new DateInterval($number_days));  
    }



    public function today(){
        $format_date = date('Y-m-j H:i:s'); 
        $today = new DateTime($format_date);
        return $today;
    }

    
    public function updateTicket($data)
    {
        $ticket = $this->find($data['id']);
        //$ticket->user_id = auth()->user()->id;
        $ticket->initdate = $data['initdate'];
        $ticket->enddate = $data['enddate'];
        $ticket->system_id = $data['system_id'];
        $ticket->save();  
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function system()
    {
        return $this->belongsTo(System::class);
    }
}
