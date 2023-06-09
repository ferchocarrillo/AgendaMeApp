<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignaturePadController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get(
    '/home',
    [
        App\Http\Controllers\HomeController::class, 'index'
    ]
)->name('home');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get(
        'appointments/pdf/{id}',
        [AppointmentController::class, 'pdf']
    )->name('appointments.pdf');

    Route::get('generate-pdf', [AppointmentController::class, 'generatePDF']);

    Route::get(
        'appointments/pdf2/{id}',
        [AppointmentController::class, 'pdf2']
    )->name('appointments.pdf2');

    Route::post('/order', [App\Http\Controllers\OrderController::class, 'store'])
    ->name('order');


    //Rutas spacielties

    Route::get(
        '/especialidades',
        [
            App\Http\Controllers\admin\SpecialtyController::class, 'index'
        ]
    );

    // Route::resource('especialidades', SpecialtyController::class);

    Route::get(
        '/especialidades/create',
        [
            App\Http\Controllers\admin\SpecialtyController::class, 'create'
        ]
    );
    Route::get(
        '/especialidades/{speciality}/edit',
        [
            App\Http\Controllers\admin\SpecialtyController::class, 'edit'
        ]
    );
    Route::post(
        '/especialidades',
        [
            App\Http\Controllers\admin\SpecialtyController::class, 'sendData'
        ]
    );
    Route::put(
        '/especialidades/{specialty}',
        [
            App\Http\Controllers\admin\SpecialtyController::class, 'update'
        ]
    );
    Route::delete(
        '/especialidades/{specialty}',
        [
            App\Http\Controllers\admin\SpecialtyController::class, 'destroy'
        ]
    );
    //Rutas medicos
    Route::resource('medicos', 'App\Http\Controllers\admin\DoctorController');
    //Rutas pacientes
    Route::resource('pacientes', 'App\Http\Controllers\admin\PatientController');

    //Rutas Reportes
    Route::get(
        '/reportes/citas/line',
        [
            App\Http\Controllers\admin\ChartController::class, 'appointments'
        ]
    );
    Route::get(
        '/reportes/doctors/column',
        [
            App\Http\Controllers\admin\ChartController::class, 'doctors'
        ]
    );
    Route::get(
        '/reportes/doctors/column/data',
        [
            App\Http\Controllers\admin\ChartController::class, 'doctorsJson'
        ]
    );
    Route::get(
        '/disponibilidad',
        [
            App\Http\Controllers\DisponibilidadController::class,
            'disponibilidad'
        ]
    );
    //rutas pdf

    Route::get('signature-pad', [SignaturePadController::class, 'index']);
    Route::post('signature-pad', [SignaturePadController::class, 'save'])
        ->name('signpad.save');

    //Route::get('/tcpdf', [\App\Http\Controllers\TCPDFController::class, 'downloadPdf']);


});
//seccion medicos
Route::middleware([
    'auth', 'doctor'
])->group(function () {

    Route::get(
        '/horario',
        [
            App\Http\Controllers\doctor\HorarioController::class, 'edit'
        ]
    );

    Route::post(
        '/horario',
        [
            App\Http\Controllers\doctor\HorarioController::class, 'store'
        ]
    );
});

Route::middleware(
    'auth'
)->group(function () {


    // Route::get(
    //     '/miscitas/pdf',
    //     [
    //         App\Http\Controllers\AppointmentController::class, 'pdf'
    //     ]
    // )->name('miscitas.pdf');
    Route::get(
        '/reservarcitas/create',
        [
            App\Http\Controllers\AppointmentController::class, 'create'
        ]
    );
    Route::post(
        '/reservarcitas',
        [
            App\Http\Controllers\AppointmentController::class, 'store'
        ]
    );
    Route::get(
        '/miscitas',
        [
            App\Http\Controllers\AppointmentController::class, 'index'
        ]
    );
    Route::get(
        '/miscitas/{appointment}',
        [
            App\Http\Controllers\AppointmentController::class, 'show'
        ]
    );




    Route::post(
        '/miscitas/{appointment}/cancel',
        [
            App\Http\Controllers\AppointmentController::class, 'cancel'
        ]
    );
    Route::post(
        '/miscitas/{appointment}/confirm',
        [
            App\Http\Controllers\AppointmentController::class, 'confirm'
        ]
    );
    Route::get(
        '/miscitas/{appointment}/cancel',
        [
            App\Http\Controllers\AppointmentController::class, 'formCancel'
        ]
    );
    Route::get(
        '/miscitas/agenda',
        [
            App\Http\Controllers\AppointmentController::class, 'agenda'
        ]
    );



    //json
    Route::get(
        '/especialidades/{specialty}/medicos',
        [
            App\Http\Controllers\Api\SpecialtyController::class, 'doctors'
        ]
    );
    Route::get(
        '/horario/horas',
        [
            App\Http\Controllers\Api\HorarioController::class, 'hours'
        ]
    );
});
