<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Specialty;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::doctors()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function create(){
        $specialties=Specialty::all();
        return view('doctors.create',compact('specialties'));
    }

    
    public function store(Request $request){
        //dd($request->all());
        $rules=[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'cedula'=>'nullable|digits:8',
            'addres'=>'nullable|min:5',
            'phone'=>'nullable|min:6'

        ];
        $this->validate($request,$rules);

       $user= User::create(
         $request->only('name','email','cedula','addres','phone')
         +[
             'role'=>'doctor',
             'password'=>bcrypt($request->input('password')),
         ]

        );
        $user->specialties()->attach($request->input('specialties'));
        $notification = 'El medico se ha registrado correctamente';   
        return redirect('doctors')->with(compact('notification'));
    }

    public function edit($id)
    {
        $doctors=User::doctors()->findOrFail($id);
        $specialties=Specialty::all();
        $specialty_ids=$doctors->specialties()->pluck('specialties.id');
        return view('doctors.edit',compact('doctors','specialties','specialty_ids'));
    }

     public function update(Request $request,$id)
    {
        $rules=[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'cedula'=>'nullable|digits:8',
            'addres'=>'nullable|min:5',
            'phone'=>'nullable|min:6'

        ];
        $this->validate($request,$rules);

        $user=User::doctors()->findOrFail($id);
        $data=$request->only('name','email','cedula','addres','phone');
        $password=$request->input('password');

       if ($password) 
            $data['password'] = bcrypt($password);
       

        $user->fill($data);
        $user->save();
        $user->specialties()->sync($request->input('specialties'));
        $notification = 'El medico se ha actualizado correctamente';   
        return redirect('doctors')->with(compact('notification'));
    }

    public function destroy(User $doctor)
    {
        $doctorDeleted = $doctor->name;
        $doctor->delete();
        $notification = 'El doctor ' . $doctorDeleted . ' se ha eliminado correctamente';
        return redirect('doctors')->with(compact('notification'));
    }
}
