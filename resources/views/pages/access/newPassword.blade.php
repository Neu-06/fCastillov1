@extends('layouts.plantillaHome')

@section('title', 'new password')

@section('content')
   <x-access.newPassword :token="$token" :email="$email"/>
@endsection