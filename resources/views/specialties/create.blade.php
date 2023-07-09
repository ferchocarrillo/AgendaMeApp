@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nueva Especialidad</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('especialidades') }}" class="btn btn-sm btn-success">Regresar</a>
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

            <form action="{{ url('/especialidades') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre de la especialidad</label>
                    <input type="text" name="specialtyName" id="specialtyName" class="form-control" value="{{ old('specialtyName')}}" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ old('description')}}">
                </div>
                <div class="form-group">
                    <label for="procedureType">Tipo de procedimiento</label>
                    <select name="procedureType" id="procedureType" class="form-control" selected required>
                        <option value="{{ old('procedureType')}}">Seleccione una opcion</option>
                        @foreach ($procedures as $pro)

                        <option value="{{$pro}}">{{$pro}}</option>

                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Crear especialidad</button>

            </form>
        </div>
    </div>
@endsection
