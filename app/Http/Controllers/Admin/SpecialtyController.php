<?php

namespace App\Http\Controllers\Admin;

use App\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SpecialtyController extends Controller
{
  
    public function index()
    {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }
    public function create()
    {
        return view('specialties.create');
    }
    private function performValidation(Request $request)
    {
        /**
         * validacion
         */
        $rules = [
            'name' => 'required|min:4',

        ];
        $message = [
            'name.required' => 'es necesario que ingrese un nombre',

        ];
        $this->validate($request, $rules, $message);
    }
    public function store(Request $request)
    {

        $this->performValidation($request);
        /**
         * guarda las especialidades en la base de datos
         */
        $specialty = new Specialty();
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); //insert a la bdd
        $notification = 'La especialidad se ha registrado correctamente';
        return redirect('specialties')->with(compact('notification'));
    }
    public function edit(Specialty $specialty)
    {

        return view('specialties.edit', compact('specialty'));
    }
    public function update(Request $request, Specialty $specialty)
    {
        /**
         * validacion
         */
        $this->performValidation($request);

        /**
         * edita las especialidades en la base de datos
         */

        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); //update a la bdd

        $notification = 'La especialidad se ha editado correctamente';
        return redirect('specialties')->with(compact('notification'));
    }
    public function destroy(Specialty $specialty)
    {
        $specialtyDeleted = $specialty->name;
        $specialty->delete();
        $notification = 'La especialidad ' . $specialtyDeleted . ' se ha eliminado correctamente';
        return redirect('specialties')->with(compact('notification'));

        
    }
}
