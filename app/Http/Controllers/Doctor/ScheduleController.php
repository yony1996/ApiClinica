<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;
class ScheduleController extends Controller
{
    private $days=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
    
    public function edit(){
        
        $workDays=WorkDay::where('user_id',auth()->id())->get();
        
        if(count($workDays)>0){
               /**
         * map junto a carbon cambian el formato de la hora que bien de la base de datos para poder ubicar en la vista las horas correctas
         */
            $workDays->map(
                function($workDay){
                    $workDay->morning_start= (new Carbon($workDay->morning_start))->format('g:i A');
                    $workDay->morning_end= (new Carbon($workDay->morning_end))->format('g:i A');
                    $workDay->afternoon_start= (new Carbon($workDay->afternoon_start))->format('g:i A');
                    $workDay->afternoon_end= (new Carbon($workDay->afternoon_end))->format('g:i A');
                    return $workDay;
                }
            );
        }else{
            $workDays= collect();
            for($i=0;$i<7;$i++){
                $workDays->push(new WorkDay());
            }

        }
        
     
        //dd($workDays->toArray());
        $days=$this->days;
        return view('schedule',compact('workDays','days'));
    }

    public function store(Request $request){
        
        $active=$request->input('active') ?: [];
        $morning_start=$request->input('morning_start');
        $morning_end=$request->input('morning_end');
        $afternoon_start=$request->input('afternoon_start');
        $afternoon_end=$request->input('afternoon_end');
 
        $errors=[];
        for ($i=0; $i<7 ; ++$i) { 
            if ($morning_start[$i] > $morning_end[$i]) {
                $errors[]=' Las horas del turno de la mañana son inconsistentes para el día '. $this->days[$i].'.';
            }
            if ($afternoon_start[$i] > $afternoon_end[$i]) {
                $errors[]=' Las horas del turno de la tarde son inconsistentes para el día '. $this->days[$i].'.';
            } 
            
            WorkDay::updateOrCreate(
                [
    
                'day'=>$i,
                'user_id'=> auth()->id(),            
                
                ],[
                'active'=> in_array($i, $active),
                'morning_start'=> $morning_start[$i],
                'morning_end'=> $morning_end[$i],
                'afternoon_start'=>$afternoon_start[$i],
                'afternoon_end'=>$afternoon_end[$i]
                ]
            );
        }
        if(count($errors)>0){
            return back()->with(compact('errors'));
        }else{
            $notification='Los cambios se han guardado con exito';
            return back()->with(compact('notification'));
        }
        
    }
}
