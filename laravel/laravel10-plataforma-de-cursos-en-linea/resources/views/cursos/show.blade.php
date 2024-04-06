@extends('layouts.plantilla')

@section('title', $curso->nombre)

@section('content')

<div class="container">
    <br>
    <!-- Gracias a blade podemos poner doble llave en lugar de la etiqueta PHP -->
    <h1>Bienvenido al curso {{$curso->nombre}}</h1>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <!-- Contenido de la columna izquierda -->
            <p><strong>Categoría: </strong></p>
            {{-- <p>{{$curso->categoria}}</p> --}}
            <p>{{$data['categoria']->nombre}}</p>
            <br>
            <p><strong>Descripcion: </strong></p>
            <p>{{$curso->descripcion}}</p>
        </div>
        <div class="col-md-6">
            <!-- Contenido de la columna derecha (imagen) -->
            <img src="{{ asset('storage/cursos_images/' . $curso->imagen) }}" alt="{{$curso->nombre}}" class="img-fluid" width="180" height="180">
        </div>
    </div>

    <br>
    <a href="{{route('cursos.index')}}" class="btn btn-info">Regresar</a>
    
</div>

@endsection
