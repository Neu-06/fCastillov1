@extends('layouts.plantillaHome')

@section('title', 'Login')

@section('content')
   <x-access.login :is-cliente="$isCliente" :is-usuario="$isUsuario" />
@endsection