@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar Paciente</h3>
            </div>
            <div class="col text-right">
                <a href="{{route('Patient.index')}}" class="btn btn-sm btn-default">Cancelar y volver</a>
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

        <form action="{{route('Patient.update',$patients->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="cedula">cedula</label>
                <input type="text" name="cedula" class="form-control" value="{{old('cedula',$patients->cedula)}}"
                    required>
            </div>
            <div class="form-group">
                <label for="name">nombre del doctor</label>
                <input type="text" name="name" class="form-control" value="{{old('name',$patients->name)}}" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{old('email',$patients->email)}}">
            </div>
            <div class="form-group">
                <label for="addres">direccion</label>
                <input type="addres" name="addres" class="form-control" value="{{old('addres',$patients->addres)}}">
            </div>
            <div class="form-group">
                <label for="phone">telefono</label>
                <input type="phone" name="phone" class="form-control" value="{{old('phone',$patients->phone)}}">
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