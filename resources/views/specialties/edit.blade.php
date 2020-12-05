@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Edita Especialidad</h3>
            </div>
            <div class="col text-right">
                <a href="{{route('Speciality.index')}}" class="btn btn-sm btn-default">Cancelar y volver</a>
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
    <form action="{{route('Speciality.update',$specialty->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">nombre de la especialidad</label>
            <input type="text" name="name" class="form-control" value="{{old('name',$specialty->name)}}" required>
        </div>
        <div class="form-group">
            <label for="description">descripcion</label>
            <input type="text" name="description" class="form-control"
                value="{{old('description',$specialty->description)}}">
        </div>
        <button type=" submit" class="btn btn-primary">Guardar</button>

    </form>
</div>

</div>
@endsection