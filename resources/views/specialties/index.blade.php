@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Especialidades</h3>
            </div>

            <div class="col text-right">
                <a href="{{route('Speciality.create')}}" class="btn btn-sm btn-primary">nueva especilidad</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (session('notification'))
        <div class="alert alert-success" role="alert">
            {{session('notification')}}
        </div>
        @endif

    </div>

    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">nombre</th>
                    <th scope="col">descripcion</th>
                    <th scope="col">opciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($specialties as $specialty)
                <tr>
                    <th scope="row">
                        {{$specialty->name}}
                    </th>
                    <td>
                        {{$specialty->description}}
                    </td>
                    <td>

                        <form action="{{route('Speciality.destroy',$specialty->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('Speciality.edit',$specialty->id)}}"
                                class="btn btn-sm  btn-primary">Editar</a>
                            <button class="btn btn-sm  btn-danger" type="submit">Eliminar</button>
                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection