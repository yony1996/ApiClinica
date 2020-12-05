<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
class PatientController extends Controller
{
    public function index()
    {
        $patients = User::patients()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    
    public function create(){
        return view('patients.create');
    }

    public function store(Request $request){

        $rules=[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'cedula'=>'nullable|digits:8',
            'addres'=>'nullable|min:5',
            'phone'=>'nullable|min:6'

        ];
        $this->validate($request,$rules);

        User::create(
         $request->only('name','email','cedula','addres','phone')
         +[
             'role'=>'patient',
             'password'=>bcrypt($request->input('password')),
         ]

        );
        $notification = 'El paciente se ha registrado correctamente';   
        return redirect('patients')->with(compact('notification'));
    }
    public function edit($id)
    {
        $patients=User::patients()->findOrFail($id);
        return view('patients.edit',compact('patients'));
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

        $user=User::patients()->findOrFail($id);
        $data=$request->only('name','email','cedula','addres','phone');
        $password=$request->input('password');

       if ($password) 
            $data['password'] = bcrypt($password);
       

        $user->fill($data);
        $user->save();
        $notification = 'El paciente se ha actualizado correctamente';   
        return redirect('patients')->with(compact('notification'));
    }

    public function destroy(User $patient)
    {
        $patientDeleted = $patient->name;
        $patient->delete();
        $notification = 'La paciente ' . $patientDeleted . ' se ha eliminado correctamente';
        return redirect('patients')->with(compact('notification'));
    }
}
