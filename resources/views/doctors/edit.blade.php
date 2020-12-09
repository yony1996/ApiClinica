@extends('layouts.panel')

@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar Medico</h3>
            </div>
            <div class="col text-right">
                <a href="{{route('Doctor.index')}}" class="btn btn-sm btn-default">Cancelar y volver</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>

                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach

            </ul>
        </div>
        @endif

        <form action="{{route('Doctor.update',$doctors->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="cedula">cedula</label>
                <input type="text" name="cedula" class="form-control" value="{{old('cedula',$doctors->cedula)}}"
                    required>
            </div>
            <div class="form-group">
                <label for="name">nombre del doctor</label>
                <input type="text" name="name" class="form-control" value="{{old('name',$doctors->name)}}" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{old('email',$doctors->email)}}">
            </div>
            <div class="form-group">
                <label for="specialties">Especialidades</label>
                <select name="specialties[]" id="specialties" class="form-control selectpicker"
                    data-style="btn-outline-primary" multiple title="Seleccione una o varias especialidades">
                    @foreach ($specialties as $specialty)
                    <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="addres">direccion</label>
                <input type="addres" name="addres" class="form-control" value="{{old('addres',$doctors->addres)}}">
            </div>
            <div class="form-group">
                <label for="phone">telefono</label>
                <input type="phone" name="phone" class="form-control" value="{{old('phone',$doctors->phone)}}">
            </div>
            <div class="form-group">
                <label for="password">Contraseña </label>
                <input type="text" name="password" class="form-control" value="">
                <p>ingrese un valor solo si desea cambiar la contraseña</p>
            </div>
            <button type=" submit" class="btn btn-primary">Guardar</button>

        </form>
    </div>

</div>
@endsection

@section('scripts')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(()=>{
        $('#specialties').selectpicker('val', @json($specialty_ids));
    });
    
</script>
@endsection