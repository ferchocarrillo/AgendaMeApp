<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<div class="table-responsive">
    <!-- Projects table -->
    <table id="old_table" class="table align-items-center table-flush" >
        <thead class="thead-light">
            <tr>
                <th scope="col">Especialidad</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $oldAppointments as $cita )
            <tr>
                <td>
                    {{ $cita->specialty->name}}
                </td>
                <td>
                    {{ $cita->scheduled_date}}
                </td>
                <td>
                    {{ $cita->status}}
                </td>
                <td>
                <a href="{{ url('/miscitas/'.$cita->id)}}" class="btn btn-info btn-sm">Ver</a>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@section('scripts')
<script>
    $(document).ready(function () {
        $('#old_table').DataTable();
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
@endsection
