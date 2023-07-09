<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Signature;
use Carbon\Carbon;

class SignaturePadController extends Controller
{
    public function index()
    {

        return view('signature-pad');
    }

    public function save(Request $request, Appointment $appointment )
    {

        $folderPath = storage_path("app/public/");
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $image_ref = "Pac";
        $file = $folderPath. $image_ref. str_pad($request->id, 7, "0", STR_PAD_LEFT). '.' . $image_type;

        file_put_contents($file, $image_base64);
        $image_parts2 = explode(";base64,", $request->signedtestigo);
        $image_type_aux2 = explode("image/", $image_parts2[0]);
        $image_type2 = $image_type_aux2[1];
        $image_base65 = base64_decode($image_parts2[1]);
        $image_ref2 = "Tes";
        $file2 = $folderPath. $image_ref2. str_pad($request->id, 7, "0", STR_PAD_LEFT). '.' . $image_type2;
        file_put_contents($file2, $image_base65);

        Signature::create(
            [
                'appointment_id' => $request->id,
                'paciente' => $request->paciente,
                'doctor' => $request->doctor,
                'tratamiento' => json_encode($request->tratamiento),
                'procedureType' => $request->procedureType,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'indicaciones' => $request->indicaciones,
                'signature' => $image_ref. str_pad($request->id, 7, "0", STR_PAD_LEFT). '.' . $image_type,
                'cedula1' => $request->cedula1,
                'signature2' => $image_ref2. str_pad($request->id, 7, "0", STR_PAD_LEFT). '.' . $image_type2,
                'cedula2' => $request->cedula2
            ]
        );
        $firmados = Appointment::where('id', $request->id)->first();
        $firmados->consentimiento = "Firmado";
        $firmados->save();



        return back()->with('success', 'Los datos han sido registrado con exito');
    }
}
