@extends('layouts.plantilla')

@section('title', 'Cursos')



@section('content')

<div class="container">
    <br>
    <h2>Cursos Disponibles</h2>
    
    <br>
    <br>

    <div class="card-group">
        @foreach($cursos as $curso)
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4"> <!-- Añadimos la clase "mb-4" para el margen inferior -->
            <div class="card mx-3">
                <img src="{{ asset('storage/cursos_images/' . $curso->imagen) }}" class="card-img-top p-3" alt="..."> <!-- Añadimos la clase "p-3" para el espacio interior -->
                <div class="card-body">
                    <h5 class="card-title">{{$curso->nombre}}</h5>
                    <p class="card-text">{{$curso->descripcion}}</p>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$curso->categoria->nombre}}</li>
                  </ul>
                <div class="p-3"><a href="{{route('cursos.show', $curso)}}" class="btn btn-primary">Ver mas</a></div>
            </div>
        </div>
        @endforeach
    </div>
</div>
     
@endsection
 