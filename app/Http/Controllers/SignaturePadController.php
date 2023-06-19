<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signature;

class SignaturePadController extends Controller
{
    public function index()
    {
        return view('signature-pad');
    }

    public function save(Request $request)
    {

        //dd($request->all());
        $folderPath = storage_path('app\public\signatures'); // create signatures folder in public directory
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.' . $image_type;
        file_put_contents($file, $image_base64);

        // Save in your data in database here.
        Signature::create(
            [
                'appointment_id' => $request->id,
                'paciente' => $request->paciente,
                'doctor' => $request->doctor,
                'tratamiento' => json_encode($request->tratamiento),
                'fecha' => $request->fecha,
                'indicaciones' => $request->indicaciones,
                'signature' => uniqid() . '.' . $image_type,
                'signature2' => uniqid() . '.' . $image_type

            ]
        );

        return back()->with('success', 'Los datos han sido registrado con exito');
    }
}
