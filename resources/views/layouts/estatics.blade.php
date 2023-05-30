<style>
    p {
        color: yellow;
        margin-top: 1rem;
    }
    span {
        color: white;
    }
</style>
@php
    use App\Models\Appointment;
    use Carbon\Carbon;

    $role = auth()->user()->role;
    if ($role == 'admin') {
        $confirmedAppointments = Appointment::all()
            ->where('status', 'Confirmada')
            ->where('created_at', '>=', Carbon::now()->subMonth(1));
        $pendingAppointments = Appointment::all()
            ->where('status', 'Reservada')
            ->where('created_at', '>=', Carbon::now()->subMonth(1));
        $oldAppointments = Appointment::all()
            ->whereIn('status', ['Atendida', 'Cancelada'])
            ->where('created_at', '>=', Carbon::now()->subMonth(1));
    }
@endphp
@if ($role == 'admin') {
<p><span>Citas confirmadas </span>{{ $confirmedAppointments->count() }}</p>
<p><span>Pendientes de aprobacion </span>{{ $pendingAppointments->count() }}</p>
<p><span>Canceladas </span>{{ $oldAppointments->count() }}</p>
@endif
