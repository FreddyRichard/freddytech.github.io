@extends('layouts.app')

@section('title', 'Login')



@section('content')
  <h2>Iniciar Sesion</h2>
  <form method="post" action="{{route('authenticate')}}">
    @csrf
    <div class="mb-3">
      <label for="username" class="form-label">username</label>
      <input type="text" class="form-control" name="username">
      @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
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



    