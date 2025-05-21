@extends('layouts.plantillaHome')

@section('title', 'Register')
@section('content')
    <x-access.register :is-cliente="$isCliente" :is-usuario="$isUsuario"/>
@endsection