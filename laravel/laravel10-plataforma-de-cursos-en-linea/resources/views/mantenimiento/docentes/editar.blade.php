@extends('dashboard.plantilla')

@section('title', 'Editar curso')

@section('content')
    
<div class="container">

    <h1>Actualizar Informacion</h1>
    
    <form action="{{route('actualizarDocente', $docente)}}" method="POST">
        
        @csrf
        @method('put')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="dni" value="{{old('dni', $docente->dni)}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control" name="nombres" value="{{old('nombres', $docente->nombres)}}" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                <label for="apellidopaterno" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" name="apellidopaterno" value="{{old('apellidopaterno', $docente->apellidopaterno)}}" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                <label for="apellidomaterno" class="form-label">Apellido Materno:</label>
                <input type="text" class="form-control" name="apellidomaterno" value="{{old('apellidomaterno', $docente->apellidomaterno)}}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="number" class="form-control" name="telefono" value="{{old('telefono', $docente->telefono)}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="genero">Genero:</label>
                    <select class="form-control" name="genero">
                        <option value="" disabled>Seleccionar género</option>
                        <option value="Femenino" {{ old('genero', $docente->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Masculino" {{ old('genero', $docente->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    </select>
                </div>
            </div>
        </div>


        <hr>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{route('listarDocentes')}}" class="btn btn-info">Regresar</a>
    </form>
</div>

@endsection