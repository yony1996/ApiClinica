@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Registrar nueva cita</h3>
            </div>
            <div class="col text-right">
                <a href="{{route('Patient.index')}}" class="btn btn-sm btn-default">Cancelar y volver</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <ul>
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach

        </ul>
    </div>
    @endif
    <form action="{{route('Patient.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="specialty">Especialidad</label>
            <select name="specialty_id" id="specialty" class="form-control">
                <option value="">Seleccione Especialidad</option>
                @foreach ($specialties as $specialty)
                <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="doctor">Medicos</label>
            <select name="doctor_id" id="doctor" class="form-control">

            </select>
        </div>
        <div class="form-group">
            <label for="">Fecha</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                </div>
                <input class="form-control datepicker" placeholder="Selecciona la fecha" type="text"
                    value="{{date('Y-m-d')}}" data-date-format="yyyy-mm-dd" data-date-start-date="{{date('Y-m-d')}}"
                    data-date-end-date="+30d">
            </div>
        </div>
        <div class="form-group">
            <label for="addres">Hora de atencion</label>
            <input type="addres" name="addres" class="form-control" value="{{old('addres')}}">
        </div>
        <div class="form-group">
            <label for="phone">telefono</label>
            <input type="phone" name="phone" class="form-control" value="{{old('phone')}}">
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="text" name="password" class="form-control" value="{{str_random(8)}}">
        </div>
        <button type=" submit" class="btn btn-primary">Guardar</button>

    </form>
</div>

</div>
@endsection

@section('scripts')
<script src="{{asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script>
    let $doctor;
    $(function() {
        const $specialty= $('#specialty');
        $doctor=$('#doctor');
       $specialty.change(()=>{
        const specialtyId=$specialty.val();
        const url=`/specialties/${specialtyId}/doctors`;
        $.getJSON(url,onDoctorsLoaded);
        }); 
    });
   

    function onDoctorsLoaded(doctors){
        let htmlOptions='';
            doctors.forEach(doctor=> {
                htmlOptions+=`<option value="${doctor.id}">${doctor.name}</option>`;
            });
            $doctor.html(htmlOptions);
    }
</script>
@endsection