<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\Specialty;
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
        $procedures = ['Quirurgico' => 'Quirurgico', 'No Quirurgico' => 'No Quirurgico' ];
        return view('specialties.create', compact('procedures'));
    }
    public function sendData(Request $request)
    {

        $rules = [
            'specialtyName' => 'required|min:3',
            'procedureType' => 'required'
        ];
        $messages = [
            'specialtyName.required'
            =>
            'El nombre de la especialidad es requerido',
            'specialtyName.min'
            =>
            'El nombre de la especialidad debe tener mas de 3 caracteres.',
            'procedureType,required'
            =>
            'El tipo de espcialidad es requerido'

        ];

        $this->validate($request, $rules, $messages);


        $specialty = new Specialty();
        $specialty->specialtyName = $request->input('specialtyName');
        $specialty->description = $request->input('description');
        $specialty->procedureType = $request->input('procedureType');

        $specialty->save();
        $notification = 'La especialidad se ha creado correctamente.';
        return redirect('/especialidades')->with(compact('notification'));
    }


    public function edit($id)
    {
        $specialty = Specialty::findOrFail($id);

        return view('specialties.edit', compact('specialty'));
    }


    public function update(Request $request, Specialty $specialty)
    {
        $rules = [
            'specialtyName' => 'required|min:3',
            'procedureType' => 'required'
        ];
        $messages = [
            'specialtyName.required'
            =>
            'El nombre de la especialidad es requerido',
            'specialtyName.min'
            =>
            'El nombre de la especialidad debe tener mas de 3 caracteres.',
            'procedureType,required'
            =>
            'El tipo de espcialidad es requerido'
        ];

        $this->validate($request, $rules, $messages);

        $specialty->specialtyName = $request->input('specialtyName');
        $specialty->description = $request->input('description');
        $specialty->procedureType = $request->input('procedureType');
        $specialty->save();
        $notification = 'La especialidad se ha actualizado correctamente.';
        return redirect('/especialidades')->with(compact('notification'));
    }

    public function destroy(Specialty $specialty)
    {
        $deleteName = $specialty->specialtyName;
        $specialty->delete();
        $notification = 'La especialidad ' .$deleteName. ' se ha eliminado correctamente.';
        return redirect('/especialidades')->with(compact('notification'));
    }
}
