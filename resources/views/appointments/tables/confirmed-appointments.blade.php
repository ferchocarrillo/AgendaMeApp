<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush" id="confirmed_table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Descrpcion</th>
                <th scope="col">Especialidad</th>
                @if ($role == 'paciente')
                    <th scope="col">Médico</th>
                @elseif ($role == 'doctor')
                    <th scope="col">Paciente</th>
                @endif
                <th scope="col">Fecha - Hora</th>

                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($confirmedAppointments as $cita)
                <tr>
                    <th scope="row">
                        {{ $cita->description }}
                    </th>
                    <td>
                        {{ $cita->specialty->specialtyName }}
                    </td>
                    @if ($role == 'paciente')
                        <td>
                            {{ $cita->doctor->name }}
                        </td>
                    @elseif ($role == 'doctor')
                        <td>
                            {{ $cita->patient->name }}
                        </td>
                    @endif
                    <td>
                        {{ $cita->scheduled_date }} {{ $cita->Scheduled_Time_12 }}
                    </td>
                    <td>
                        {{ $cita->type }}
                    </td>
                    <td>
                        {{ $cita->status }}
                    </td>
                    <td>
                        @if ($role == 'admin')
                            <a href="{{ url('/miscitas/' . $cita->id) }}" class="btn btn-sm btn-info"
                                title="Ver cita"><i class="fas fa-eye"></i></a>
                        @elseif($role == 'doctor')
                            <a href="{{ url('/miscitas/' . $cita->id) }}" class="btn btn-sm btn-info"
                                title="Ver cita"><i class="fas fa-eye"></i></a>
                        @endif
                        <a href="{{ url('/miscitas/' . $cita->id . '/cancel') }}" class="btn btn-sm btn-danger"
                            title="Cancelar cita"><i class="fas fa-window-close"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('scripts')
<script>
    $(document).ready(function () {
        $('#confirmed_table').DataTable();
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
@endsection

