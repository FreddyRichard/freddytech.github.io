@extends('dashboard.plantilla')

@section('title', 'Editar curso')

@section('content')

<div class="container">
    <form action="{{ route('cursos.actualizarCurso', $curso) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <br>
        <h1>Editar curso</h1>
        <hr>
        <br>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Ingresar nombre" value="{{ old('nombre', $curso->nombre) }}">
        </div>

        <input type="hidden" name="slug" value="slug">

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" name="descripcion" rows="3">{{ old('descripcion', $curso->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" class="form-control" name="categoria" placeholder="Ingresar categoría" value="{{ old('categoria', $curso->categoria) }}">
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" name="imagen">
            @if ($curso->imagen)
            <img src="{{ asset('storage/cursos_images/' . $curso->imagen) }}" alt="{{ $curso->nombre }}" class="mt-2 img-thumbnail" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>

        <a href="{{ route('cursos.listarCursos') }}" class="btn btn-primary">Regresar</a>
    </form>
</div>

@endsection
