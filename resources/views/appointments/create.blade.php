<?php
use Illuminate\Support\Str;
?>

@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Registrar nueva cita </h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/pacientes') }}" class="btn btn-sm btn-success">Regresar</a>
                    <i class="fas fa-chevron-left "></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Por favor!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="{{ url('/reservarcitas') }}" method="POST">
                @csrf
                <div class="form-row">
                    @if(auth()->user()->role == 'admin')
                    <div class="form-group col-md-4">
                        <label for="paciente">Paciente</label>
                        <select name="patient_id" id="patient" class="form-control">
                            <option value="">Seleccionar paciente</option>
                            @foreach ($paciente as $pc)
                                <option value="{{ $pc->id }}" @if (old('paciente_id') == $pc->id) selected @endif>
                                    {{ $pc->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="specialty">Especialidad</label>
                        <select name="specialty_id" id="specialty" class="form-control">
                            <option value="">Seleccionar especialidad</option>
                            @foreach ($specialties as $especialidad)
                                <option value="{{ $especialidad->id }}" @if (old('specialty_id') == $especialidad->id) selected @endif>
                                    {{ $especialidad->specialtyName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="doctor">Medico</label>
                        <select name="doctor_id" id="doctor" class="form-control" required>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @if (old('doctor') == $doctor->id) selected @endif>
                                    {{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    @if(auth()->user()->role == 'paciente')
                    <div class="form-group col-md-6">
                        <label for="specialty">Especialidad</label>
                        <select name="specialty_id" id="specialty" class="form-control">
                            <option value="">Seleccionar especialidad</option>
                            @foreach ($specialties as $especialidad)
                                <option value="{{ $especialidad->id }}" @if (old('specialty_id') == $especialidad->id) selected @endif>
                                    {{ $especialidad->specialtyName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="doctor">Medico</label>
                        <select name="doctor_id" id="doctor" class="form-control" required>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" @if (old('doctor') == $doctor->id) selected @endif>
                                    {{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                </div>

                <div class="form-group">
                    <label for="date">Fecha</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" id="date" name="scheduled_date"
                            placeholder="Seleccionar fecha" type="date"
                            value="{{ old('scheduled_date'), date('Y-m-d') }}" data-date-format="yyyy-mm-dd"
                            data-date-start-date="{{ date('Y-m-d') }}" date-date-end-date="+30d">
                    </div>
                </div>
                <div class="form-group">
                    <label for="hours">Hora de atención</label>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h4 class="m-3" id="titleMorning"></h4>
                                <div id="hoursMorning">

                                    @if ($intervals)
                                    <h4 class="m-3" >En la mañana</h4>
                                        @foreach ($intervals['morning'] as $key => $interval)

                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="intervalMorning{{ $key }}"
                                                    name="scheduled_time" value="{{ $interval['start'] }}"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="intervalMorning{{ $key }}">{{ $interval['start'] }} -
                                                    {{ $interval['end'] }}</label>
                                            </div>
                                        @endforeach
                                    @else
                                        <mark>
                                            <small class="text-warning display-5">
                                                Selecciona un medico y una fecha, para ver las horas.
                                            </small>
                                        </mark>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="m-3" id="titleAfternoon"></h4>
                                <div id="hoursAfternoon">
                                    @if ($intervals)
                                    <h4 class="m-3" >En la tarde</h4>
                                        @foreach ($intervals['afternoon'] as $key => $interval)
                                            <div class="custom-control custom-radio mb-3">
                                                <input type="radio" id="intervalAfternoon{{ $key }}"
                                                    name="scheduled_time" value="{{ $interval['start'] }}"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="intervalAfternoon{{ $key }}">{{ $interval['start'] }} -
                                                    {{ $interval['end'] }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tipo de consulta</label>
                    <div class="custom-control custom-radio mt-3 mb-3">
                        <input type="radio" id="type1" name="type" class="custom-control-input"
                            @if (old('type') == 'Valoracion') checked @endif value="Valoración">
                        <label class="custom-control-label" for="type1">Valoración</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" id="type2" name="type" class="custom-control-input"
                            @if (old('type') == 'Consulta') checked @endif value="Consulta">
                        <label class="custom-control-label" for="type2">Consulta</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="type3" name="type" class="custom-control-input"
                            @if (old('type') == 'Intervención') checked @endif value="Intervención">
                        <label class="custom-control-label" for="type3">Intervención</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Sintomas</label>
                    <textarea name="description" id="description" type="text" class="form-control"
                        placeholder="Descripcion breve de sus sintomas" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/js/appointments/create.js') }}"></script>
@endsection
