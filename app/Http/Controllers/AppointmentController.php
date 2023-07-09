<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\HorarioServiceInterface;
use App\Models\Appointment;
use App\Models\CancelledAppointment;
use App\Models\Signature;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;
        if ($role == 'admin') {
            $confirmedAppointments = Appointment::all()
                ->where('status', 'Confirmada');
            $pendingAppointments = Appointment::all()
                ->where('status', 'Reservada');
            $oldAppointments = Appointment::all()
                ->whereIn('status', ['Atendida', 'Cancelada']);
            $agenda = Appointment::join('users', 'appointments.patient_id', '=', 'users.id')
                ->join('specialties', 'appointments.specialty_id', 'specialties.id')
                ->where('status', 'Confirmada')
                ->get();
        } elseif ($role == 'doctor') {
            $confirmedAppointments = Appointment::all()
                ->where('status', 'Confirmada')
                ->where('doctor_id', auth()->id());
            $pendingAppointments = Appointment::all()
                ->where('status', 'Reservada')
                ->where('doctor_id', auth()->id());
            $oldAppointments = Appointment::all()
                ->whereIn('status', ['Atendida', 'Cancelada'])
                ->where('doctor_id', auth()->id());
        } elseif ($role == 'paciente') {
            $confirmedAppointments = Appointment::all()
                ->where('status', 'Confirmada')
                ->where('patient_id', auth()->id());
            $pendingAppointments = Appointment::all()
                ->where('status', 'Reservada')
                ->where('patient_id', auth()->id());
            $oldAppointments = Appointment::all()
                ->whereIn('status', ['Atendida', 'Cancelada'])
                ->where('patient_id', auth()->id());
        }
        return view('appointments.index', compact(
            'confirmedAppointments',
            'pendingAppointments',
            'oldAppointments',
            'role',

        ));
    }



    public function pdf($id)
    {
        $now = Carbon::now();
        $now = $now->format('d-m-Y');
        $firmas = Signature::leftjoin(
            'appointments',
            'appointments.id',
            '=',
            'signatures.appointment_id'
        )
            ->where('signatures.appointment_id', $id)
            ->first();
        return view('appointments.pdf', compact('firmas', 'now'));
    }

    public function generatePDF($id)
    {
        $now = Carbon::now();
        $now = $now->format('d-m-Y');
        $firmas = Signature::leftjoin(
            'appointments',
            'appointments.id',
            '=',
            'signatures.appointment_id'
        )
            ->where('signatures.appointment_id', $id)
            ->first();
        view()->share('firmas', $firmas);
        $pdf = PDF::loadView('appointments.pdf', $firmas);
        return $pdf->download('generatePDF.pdf');
    }

    public function pdf2($id)
    {
        $now = Carbon::now();
        $now = $now->format('d-m-Y');
        $firmas = Signature::leftjoin(
            'appointments',
            'appointments.id',
            '=',
            'signatures.appointment_id'
        )
            ->where('signatures.appointment_id', $id)
            ->first();
        return view('appointments.pdf2', compact('firmas', 'now'));
    }

    public function create(HorarioServiceInterface $horarioServiceInterface)
    {

        $specialties = Specialty::all();
        $paciente = User::where('role', 'paciente')->get();

        $specialtyId = old('specialty_id');
        if ($specialtyId) {
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        } else {
            $doctors = collect();
        }
        $date = old('scheduled_date');
        $doctorId = old('doctor_id');
        if ($date && $doctorId) {
            $intervals = $horarioServiceInterface->getAvailableIntervals(
                $date,
                $doctorId
            );
        } else {
            $intervals = null;
        }

        return view('appointments.create', compact(
            'specialties',
            'doctors',
            'intervals',
            'paciente'
        ));
    }

    public function store(
        Request $request,
        HorarioServiceInterface $horarioServiceInterface
    ) {

        //dd($request->all());
        $rules = [
            'scheduled_time'
            => 'required',
            'type'
            => 'required',
            'description'
            => 'required',
            'doctor_id'
            => 'exists:users,id',
            'specialty_id'
            => 'exists:specialties,id',
        ];
        $messages = [
            'scheduled_time.required'
            => 'Debe seleccionar una hora valida para su cita',
            'type.required'
            => 'debe seleccionar el tipo de consulta',
            'description.required'
            => 'Debe poner sus sintomas'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->after(
            function ($validator) use ($request, $horarioServiceInterface) {
                $date = $request->input('scheduled_date');
                $doctorId = $request->input('doctor_id');
                $scheduled_time = $request->input('scheduled_time');
                if ($date && $doctorId && $scheduled_time) {
                    $start = new Carbon($scheduled_time);
                } else {
                    return;
                }

                if (!$horarioServiceInterface->isAvailableInterval(
                    $date,
                    $doctorId,
                    $start
                )) {
                    $validator->errors()->add(
                        'available_time',
                        'La hora selecionada ya se encuentra seleccionada por
                    otro paciente'
                    );
                }
            }
        );
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(
            [
                'scheduled_date',
                'scheduled_time',
                'type',
                'description',
                'doctor_id',
                'specialty_id',
            ]
        );
        if (auth()->user()->role == 'admin') {

            $data['patient_id'] = $request->patient_id;
        } else {

            $data['patient_id'] = auth()->id();
        }



        $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time'] =  $carbonTime->format('H:i:s');

        Appointment::create($data);

        $notification = 'la cita se ha creado correctamente.';
        return redirect('/miscitas')->with(compact('notification'));
    }

    public function cancel(Appointment $appointment, Request $request)
    {
        if ($request->has('justification')) {
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();
            $appointment->cancellation()->save($cancellation);
        }

        $appointment->status =  'Cancelada';
        $appointment->save();
        $notification = 'La cita se ha cancelado correctamente';
        return redirect('/miscitas')->with(compact('notification'));
    }
    public function confirm(Appointment $appointment)
    {

        $appointment->status =  'Confirmada';
        $appointment->save();
        $notification = 'La cita se ha confirmado correctamente';
        return redirect('/miscitas')->with(compact('notification'));
    }
    public function formCancel(Appointment $appointment)
    {
        if ($appointment->status == 'Confirmada') {
            return view('appointments.cancel', compact('appointment'));
        }
        return redirect('/miscitas');
    }

    public function agenda(Appointment $appointment, Request $request)
    {

        $appointment = Appointment::all();
        return redirect('appointment.agenda')->with(compact('appointment'));
    }

    public function show(Appointment $appointment)
    {
        $role = auth()->user()->role;
        $tipo = Signature::where('appointment_id', $appointment->id)->get();

        return view('appointments.show', compact('appointment', 'role', 'tipo'));
    }

    public function createPDF(Request $request)
    {

        $consentimiento = Signature::all();
        view()->share('signature', $consentimiento);
        $pdf = PDF::loadView('appointments.pdf', compact('consentimiento', 'now'));
        return $pdf->stream('appointments.pdf');
    }
}
