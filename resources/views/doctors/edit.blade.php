<?php
    use Illuminate\Support\Str;
?>
@extends('layouts.panel')
@section('styles')
    <!-- Latest compiled and minified CSS -->
   /// <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">

    <style>
   //    .selector .opcion {
   //        background: rgb(92, 88, 88);
   //        color: black !important;
   //    }
    //    select.selectpicker{
    //        display:block !important;
    //        background: rgb(92, 88, 88);
    //        color: red;
    //    }
//
       // select.selectpicker{ }
//        .bootstrap-select{width:220px;vertical-align:middle}.bootstrap-select>.dropdown-toggle{position:relative;width:100%;text-align:right;white-space:nowrap;display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between}

    </style>
    @endsection
@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Médico</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('medicos') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left "></i>Regresar</a>
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

            <form action="{{ url('/medicos/'.$doctor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre del médico</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $doctor->name)}}">
                </div>
                <div class="form-group">
                    <label for="specialties">Especialidades</label>
                    <select  name="specialties[]" id="specialties" class="form-control selectpicker selector "
                    data-style="btn-primary" title="Seleccionar especialidades" multiple required>
                        @foreach ( $specialties as $especialidad )
                        <option  value="{{ $especialidad->id }}">{{ $especialidad->specialtyName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Correo electronico</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $doctor->email)}}">
                </div>
                <div class="form-group">
                    <label for="cedula">Cedula</label>
                    <input type="text" name="cedula" id="cedula" class="form-control" value="{{ old('cedula', $doctor->cedula)}}">
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $doctor->address)}}">
                </div>
                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $doctor->phone)}}">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" id="password" class="form-control">
                    <small class="text-warning">Solo llene el campo si desea cambiar la contraseña</small>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Guardar cambios</button>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
   // <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(()=>{});
    $('#specialties').selectpicker('val', @json($specialty_ids) );


</script>
    @endsection
