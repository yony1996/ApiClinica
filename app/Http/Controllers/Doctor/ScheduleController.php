<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;
class ScheduleController extends Controller
{
    public function edit(){
        $days=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
        $workDays=WorkDay::where('user_id',auth()->id())->get();
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
        dd($workDays->toArray());
        return view('schedule',compact('workDays','days'));
    }

    public function store(Request $request){
        
        $active=$request->input('active') ?: [];
        $morning_start=$request->input('morning_start');
        $morning_end=$request->input('morning_end');
        $afternoon_start=$request->input('afternoon_start');
        $afternoon_end=$request->input('afternoon_end');
 
        for ($i=0; $i <7 ; ++$i) { 
            
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
        return back();
    }
}
