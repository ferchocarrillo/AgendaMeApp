<li class="nav-item  active ">
    <a class="nav-link  active " href="./home">
        <i class="ni ni-tv-2 text-danger"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link " href="{{ url('/especialidades') }}">
        <i class="ni ni-briefcase-24 text-blue"></i> Especialidades
    </a>
</li>
<li class="nav-item">
    <a class="nav-link " href="{{ url('/medicos') }}">
        <i class="fas fa-stethoscope text-info"></i> Medicos
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/pacientes') }}">
        <i class="fas fa-bed text-warning"></i> Pacientes
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-clock text-info"></i>Citas Medicas</a>
    <div class="dropdown-menu">
    <a class="nav-link " href="/miscitas">
        Estatus de Citas Medicas
    </a>
    <a class="nav-link " href="/reservarcitas/create">
        Reservar Nuevas Citas Medicas
    </a>
    <a class="nav-link " href="/disponibilidad">
        Ver Disponibilidad
    </a>
</div>
</li>
