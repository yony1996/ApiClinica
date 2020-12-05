@extends('layouts.panel')

@section('content')

<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Pacientes</h3>
            </div>

            <div class="col text-right">
                <a href="{{route('Patient.create')}}" class="btn btn-sm btn-primary">nuevo Paciente</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (session('notification'))
        <div class="alert alert-success" role="alert">
            {{session('notification')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

    </div>

    <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">cedula</th>
                    <th scope="col">nombre</th>
                    <th scope="col">e-mail</th>
                    <th scope="col">opciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                <tr>
                    <th scope="row">
                        {{$patient->cedula}}
                    </th>
                    <th scope="row">
                        {{$patient->name}}
                    </th>
                    <td>
                        {{$patient->email}}
                    </td>
                    <td>

                        <form action="{{route('Patient.destroy',$patient->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('Patient.edit',$patient->id)}}" class="btn btn-sm  btn-primary">Editar</a>
                            <button class="btn btn-sm  btn-danger" type="submit">Eliminar</button>
                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="card-body">
        {{$patients->links()}}
    </div>

</div>
@endsection