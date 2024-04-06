@extends('layouts.app')

@section('title', 'Registrarse')



@section('content')
  <h1>Registrarse</h1>

  <form method="post" action="{{route('store')}}">
      @csrf
      <div class="mb-3">
        <label for="nombres" class="form-label">nombres</label>
        <input type="text" class="form-control" name="nombres">
        @if ($errors->has('nombres'))
            <span class="text-danger">{{ $errors->first('nombres') }}</span>
        @endif
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">username</label>
        <input type="text" class="form-control" name="username">
        @if ($errors->has('username'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
        @endif
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
    
