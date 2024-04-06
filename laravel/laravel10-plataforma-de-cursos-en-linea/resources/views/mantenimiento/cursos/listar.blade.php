@extends('dashboard.plantilla')

@section('title', 'Cursos')



@section('content')

<div class="container">
    <br>
    <h2>Dashboard / Cursos</h2>
    <br>
    <a href="{{route('crearCurso')}}" class="btn btn-primary">Crear Nuevo Curso</a>
    <br>
    <br>
    <div class="table-responsive">
    <table class="table table-light">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
                <tr>
                    <td>{{ $curso->id }}</td>
                    <td>{{ $curso->nombre }}</td>
                    <td>{{ $curso->descripcion }}</td>
                    <td>{{ $curso->categoria->nombre }}</td>
                    <td>
                        @if ($curso->imagen)
                            <img src="{{ asset('storage/cursos_images/' . $curso->imagen) }}" alt="{{ $curso->nombre }}" width="60">
                        @else
                            No se ha cargado ninguna imagen
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('editarCurso', $curso) }}" class="btn btn-warning mr-3">Editar</a>
                            
                            <a href="{{ route('eliminarCurso', $curso) }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('eliminar-form').submit();">Eliminar</a>
                            <form id="eliminar-form" action="{{ route('eliminarCurso', $curso) }}" method="POST" style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table></div>
</div>
     
@endsection
 