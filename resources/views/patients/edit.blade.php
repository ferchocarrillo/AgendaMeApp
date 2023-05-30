<?php
    use Illuminate\Support\Str;
?>
@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Paciente</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('/pacientes/') }}" class="btn btn-sm btn-success">Regresar</a>
                    <i class="fas fa-chevron-left "></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any)
            @foreach ( $errors->all() as $error )
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Por favor!</strong> {{$error}}
            </div>
            @endforeach
            @endif

            <form action="{{ url('/pacientes/'.$patient->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre del paciente</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $patient->name)}}">
                </div>
                <div class="form-group">
                    <label for="description">Correo electronico</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $patient->email)}}">
                </div>
                <div class="form-group">
                    <label for="description">Cedula</label>
                    <input type="text" name="cedula" id="cedula" class="form-control" value="{{ old('cedula', $patient->cedula)}}">
                </div>
                <div class="form-group">
                    <label for="description">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $patient->address)}}">
                </div>
                <div class="form-group">
                    <label for="description">Telefono</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $patient->phone)}}">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" id="password" class="form-control" >
                    <small class="text-warning">Solo llene el campo si desea cambiar la contraseña</small>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Guardar cambios</button>

            </form>
        </div>
    </div>
@endsection
