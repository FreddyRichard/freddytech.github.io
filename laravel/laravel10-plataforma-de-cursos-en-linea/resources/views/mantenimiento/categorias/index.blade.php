@extends('dashboard.plantilla')

@section('title', 'Cursos')



@section('content')

<div class="container">
    <br>
    <h1>Lista de Categorias</h1>
    <hr>

    {{-- <a href="{{route('docentes.crear')}}" class="btn btn-primary">Agregar Nuevo Docente</a> --}}
    <br><br>

    <table class="table table-light">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        {{-- <tbody>
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{ $docente->id }}</td>
                    <td>{{ $docente->nombres }}</td>
                    <td>{{ $docente->apellidopaterno }} {{ $docente->apellidomaterno }}</td>
                    <td>{{ $docente->telefono }}</td>
                    <td>{{ $docente->genero }}</td>
                    <td>
                        <a href="{{ route('docentes.editar', $docente) }}" class="btn btn-warning">Editar</a>
                        
                        <a href="{{ route('docentes.eliminar', $docente) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('eliminar-form').submit();">Eliminar</a>
                        <form id="eliminar-form" action="{{ route('docentes.eliminar', $docente) }}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody> --}}
    </table>
</div>
    
@endsection
 