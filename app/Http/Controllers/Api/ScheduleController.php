<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function hours(Request $request)
    {
     
      $rules=[
        'date'=>'required|date_format:"Y-m-d"',
        'doctor_id'=>'required|exists:users,id'
        ];

      $this->validate($request,$rules);
        
        //dd($request->all());
        $date=$request->input('date');
        $dateCarbon=new Carbon($date);
        $i=$dateCarbon->dayOfWeek;
        $day=($i==0 ? 6 : $i-1);
        
        $doctorId=$request->input('doctor_id');
        
       $workDay= WorkDay::where('active',true)->where('day',$day)->where('user_id',$doctorId)
       ->first([
            'morning_start','morning_end',
            'afternoon_start','afternoon_end'
        ]);

            $morningStart= new Carbon($workDay->morning_start);
            $morningEnd= new Carbon($workDay->morning_end);
            
            $morningStart->addMinutes(30);
            //while ($morningStart < $morningEnd) {
                # code...
            //}
        dd($morningStart);
    }
}
