@extends('layouts.panel')
@section('title', ' | Mis citas')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@stop
@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Cita N° {{ $appointment->id }}</h3>

                </div>
                <div class="col text-right">
                    <a href="{{ url('miscitas') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left"></i>Regresar</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul>
                <dd>
                    <strong>Fecha:</strong> {{ date('d-m-Y', strtotime($appointment->scheduled_date)) }}
                </dd>
                <dd>
                    <strong>Hora de atencion:</strong> {{ $appointment->scheduled_time_12 }}
                </dd>

                @if ($role == 'paciente' || $role == 'admin')
                    <dd>
                        <strong>Doctor:</strong> {{ $appointment->doctor->name }}
                    </dd>
                @endif
                @if ($role == 'doctor' || $role == 'admin')
                    <dd>
                        <strong>Paciente:</strong> {{ $appointment->patient->name }}
                    </dd>
                @endif
                <dd>
                    <strong>Especialidad:</strong> {{ $appointment->specialty->specialtyName }}
                </dd>
                <dd>
                    <strong>Tipo de consulta:</strong> {{ $appointment->type }}
                </dd>
                <dd>
                    <strong>Estado:</strong>
                    @if ($appointment->status == 'Cancelada')
                        <span class="badge badge-danger">Cancelada</span>
                    @else
                        <span class="badge badge-primary">{{ $appointment->status }}</span>
                    @endif
                </dd>
                <dd>
                    <strong>Sintomas:</strong> {{ $appointment->description }}
                </dd>
            </ul>
            @if ($appointment->status == 'Cancelada')
                <div class="alert bg-light text-primary">
                    <h3>Detalles de la cancelación</h3>
                    @if ($appointment->cancellation)
                        <ul>
                            <li>
                                <strong>Fecha de la cancelación</strong>
                                {{ $appointment->cancellation->created_at }}
                            </li>
                            <li>
                                <strong>La cita fue cancelada por:</strong>
                                {{ $appointment->cancellation->cancelled_by->name }}
                            </li>
                            <li>
                                <strong>Motivo de la cancelación:</strong>
                                {{ $appointment->cancellation->justification }}
                            </li>
                        </ul>
                    @else
                        <ul>
                            <li>La cita fue cancelada antes de su confirmación</li>
                        </ul>
                    @endif
                </div>
            @endif
            @if ($appointment->status != 'Cancelada' && $appointment->consentimiento != 'Firmado')
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="@mdo">Diligenciar consentimiento informado</button>
                    &nbsp;&nbsp;
            @endif
            @if ($appointment->consentimiento == 'Firmado')
                @if ($tipo[0]['procedureType'] == 'quirurgico')
                    <input type="hidden" name="id" id="id" value="{{ $appointment->id }}">
                    <a class="btn btn-primary" href="{{ URL::to('/appointments/pdf/' . $appointment->id) }}">ver PDF</a>
                @elseif ($tipo[0]['procedureType'] == 'NoQuirurgico')
                    <a class="btn btn-primary" href="{{ URL::to('/appointments/pdf2/' . $appointment->id) }}">ver PDF</a>
                @endif
            @endif
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <form action="{{ url('signature-pad') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Datos del consentimiento informado</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('signature-pad')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
    </div>

@endsection


@section('scripts')
    <script src="{{ asset('js\canvas\jquery.min.js') }}"></script>
    <script src="{{ asset('js\canvas\signature_pad.js') }}"></script>
    <script>
        const $canvas = document.querySelector("signature-pad"),
            $btnDescargar = document.querySelector("btnDescargar");

        var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 0)'
        });
        var saveButton = document.getElementById('save');
        var limpiar = document.getElementById("clear");

        // var clearButton = document.getElementById('clear');
        var undoButton = document.getElementById('undo');


        var canvas = document.getElementById("signature-pad");
        var paciente = document.getElementById("paciente").value;


        function descargar() {
            var filename = prompt("Guardar como...", paciente);
            if (canvas.msToBlob) { //para internet explorer
                var blob = canvas.msToBlob();
                window.navigator.msSaveBlob(blob, filename + ".png"); // la extensión de preferencia pon jpg o png
            } else {
                link = document.getElementById("download");
                //Otros navegadores: Google chrome, Firefox etc...
                link.href = canvas.toDataURL("image/png"); // Extensión .png ("image/png") --- Extension .jpg ("image/jpeg")
                link.download = filename;
            }
        }

        limpiar.addEventListener("click", function() {
            canvas.width = canvas.width;
        }, false);

        undoButton.addEventListener("click", () => {
            const data = signaturePad.toData();

            if (data) {
                data.pop(); // remove the last dot or line
                signaturePad.fromData(data);
            }
        });
    </script>

@stop
