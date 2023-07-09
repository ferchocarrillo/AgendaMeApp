<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<div class="table-responsive">
@php
use App\Models\Appointment;
$agenda = Appointment::
join('users', 'appointments.patient_id', '=', 'users.id')
->join('specialties', 'appointments.specialty_id', 'specialties.id')
->where('status', 'Confirmada')
->get();
@endphp

   <table class="table align-items-center table-flush" id="confirmed_table">
        <thead class="thead-light">
            <tr>
                <th>Hora</th>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Especialidad</th>
                <th>Tipo</th>
                {{--  <th>Opciones</th>  --}}
            </tr>
        </thead>
        <tbody>

            @foreach ($agenda as $cita)
                <tr>
                    <th scope="row">
                        {{ $cita->Scheduled_Time_12 }}
                    </th>
                    <th>
                        {{ $cita->scheduled_date }}
                    </th>

                    <td>
                        {{ $cita->name }}
                    </td>
                    <td>
                        {{ $cita->specialtyName }}
                        </td>


                    <td>
                        {{ $cita->type }}
                    </td>
{{--
                    <td>
                        @if ($role == 'admin')
                            <a href="{{ url('/miscitas/' . $cita->id) }}" class="btn btn-sm btn-info" title="Ver cita"><i
                                    class="fas fa-eye"></i></a>
                        @elseif($role == 'doctor')
                            <a href="{{ url('/miscitas/' . $cita->id) }}" class="btn btn-sm btn-info"
                                title="Ver cita"><i class="fas fa-eye"></i></a>
                        @endif
                        <a href="{{ url('/miscitas/' . $cita->id . '/cancel') }}" class="btn btn-sm btn-danger"
                            title="Cancelar cita"><i class="fas fa-window-close"></i>
                        </a>
                    </td>  --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#confirmed_table').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
@endsection
