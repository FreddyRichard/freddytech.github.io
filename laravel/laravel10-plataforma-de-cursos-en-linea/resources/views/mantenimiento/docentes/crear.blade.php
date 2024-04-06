@extends('dashboard.plantilla')

@section('title', 'Agregar docente')

@section('content')

<div class="container">

    <h1>Agregar Nuevo Docente</h1>
    <br/>

    <form action="{{ route('docentes.store') }}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="dni" id="dni" autofocus>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5">
                <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                <label for="apellidopaterno" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                <label for="apellidomaterno" class="form-label">Apellido Materno:</label>
                <input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="number" class="form-control" id="telefono" name="telefono">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="genero" class="form-label">Género:</label>
                    <select class="form-control" id="genero" name="genero">
                        <option value="" selected disabled>Seleccionar género</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                </div>
            </div>
        </div>

        <hr>
        <a href="{{route('listarDocentes')}}" class="btn btn-info">Regresar</a>
        <button type="submit" class="btn btn-primary">Agregar</button>
        
    </form>

</div>

@endsection
