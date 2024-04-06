@extends('layouts.app')

@section('title', 'Dashboard')



@section('content')
    <h1>Bienbenido {{ Auth::user()->nombres }}</h1> 
@endsection