@extends('dashboard.plantilla')

@section('title', 'Agregar curso')

@section('content')
<div class="container">
    <br>
    <h6>Dashboard / Cursos / Nuevo Curso</h6>
    <br>

    <form action="{{ route('cursos.store') }}" method="POST" enctype="multipart/form-data">
        
        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}" autofocus>
                    @error('nombre')
                        <br>
                        <small>*{{$message}}</small> 
                        <br>
                    @enderror
                    <input type="hidden" name="slug" value="slug">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <textarea type="text" class="form-control" name="descripcion" rows="5" value="{{old('descripcion')}}"></textarea>
                    @error('descripcion')
                        <br>
                        <small>*{{$message}}</small> 
                        <br>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input type="text" class="form-control" name="categoria" value="{{old('categoria')}}">
                    @error('categoria')
                        <br>
                        <small>*{{$message}}</small> 
                        <br>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="imagen" id="imagen">
                        <label class="custom-file-label" for="customFileLangHTML" data-browse="Buscar">--- Seleccionar imagen ---</label>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <a href="{{ route('cursos.listarCursos') }}" class="btn btn-info">Regresar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>

    <br>
    

</div>
@endsection



