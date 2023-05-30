<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Models\User;

use Symfony\Contracts\Service\Attribute\Required;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = User::doctors()->paginate(10);;
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|integer|between:100000,9999999999',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];

        $message =  [

            'name.required' => 'El nombre del médico es obligatorio',
            'name.min' => 'El nombre del médico debe tener al menos 3 caracteres',
            'email.required' => 'El correo electronico es obligatorio',
            'email.email' => 'Ingresa una direccion de correo electronico valido',
            'cedula.required' => 'La cedula es obligatoria',
            'cedula.digits' => 'Ingrese un numero de cedula valido',
            'address.min' => 'La direccion debe tener al menos 6 caracteres',
            'phone.required' => 'El numero de telefono es obligatorio',
        ];
        $this->validate($request, $rules, $message);

        $user =  User::create(
            $request->only('name', 'email', 'cedula', 'address', 'phone')
                +
                [
                    'role' => 'doctor',
                    'password' => bcrypt($request->input('password'))

                ]
        );
        $user->specialties()->attach($request->input('specialties'));
        $notification = 'El médico se ha registrado correctamente.';
        return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        $specialties = Specialty::all();
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view(
            'doctors.edit',
            compact('doctor', 'specialties', 'specialty_ids')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|integer|between:100000,9999999999',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];

        $message =  [

            'name.required' => 'El nombre del médico es obligatorio',
            'name.min' => 'El nombre del médico debe tener al menos 3 caracteres',
            'email.required' => 'El correo electronico es obligatorio',
            'email.email' => 'Ingresa una direccion de correo electronico valido',
            'cedula.required' => 'La cedula es obligatoria',
            'cedula.digits' => 'Ingrese un numero de cedula valido',
            'address.min' => 'La direccion debe tener al menos 6 caracteres',
            'phone.required' => 'El numero de telefono es obligatorio',
        ];
        $this->validate($request, $rules, $message);

        $user = User::doctors()->findOrFail($id);

        $data = $request->only('name', 'email', 'cedula', 'address', 'phone');
        $password = $request->input('password');

        if ($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();
        $user->specialties()->sync($request->input('specialties'));

        $notification = 'la información del médico se ha actualizado correctamente.';
        return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::doctors()->findOrFail($id);
        $doctorName =  $user->name;
        $user->delete();

        $notification = "El médico $doctorName se elimino correctamente";

        return redirect('/medicos')->with(compact('notification'));
    }
}
