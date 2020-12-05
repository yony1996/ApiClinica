<!-- Navigation -->
<h6 class="navbar-heading text-muted">
    @if (auth()->user()->role=='Admin')
    Gestionar Datos
    @else
    Menu
    @endif

</h6>
<ul class="navbar-nav">
    @if (auth()->user()->role=='Admin')
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('Speciality.index')}}">
            <i class="ni ni-planet text-blue"></i>Especialidades
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('Doctor.index')}}">
            <i class="ni ni-single-02 text-orange"></i> Medicos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('Patient.index')}}">
            <i class="ni ni-satisfied text-info"></i>Pacientes
        </a>
    </li>
    @elseif(auth()->user()->role=='doctor')
    <li class="nav-item">
        <a class="nav-link" href="{{route('schedule')}}">
            <i class="ni ni-calendar-grid-58 text-orange"></i> Gestionar Horario
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('Patient.index')}}">
            <i class="ni ni-satisfied text-info"></i>Mis Pacientes
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('Patient.index')}}">
            <i class="ni ni-time-alarm text-red"></i>Mis Citas
        </a>
    </li>
    @else{{--Pacient--}}
    <li class="nav-item">
        <a class="nav-link" href="{{route('Patient.index')}}">
            <i class="ni ni-book-bookmark text-blue"></i>Mis Citas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('Patient.index')}}">
            <i class="ni ni-send text-red"></i>Reservar Cita
        </a>
    </li>


    @endif



    <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}"
            onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
            <i class="ni ni-key-25 "></i> Logout
        </a>
        <form method="POST" action="{{route('logout')}}" style="display: none" id="formLogout">
            @csrf

        </form>
    </li>
</ul>
@if (auth()->user()->role=='Admin')
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-collection text-yellow"></i> Frecuencia de citas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="ni ni-spaceship text-red"></i> Medicos mas activos
        </a>
    </li>

</ul>
@endif