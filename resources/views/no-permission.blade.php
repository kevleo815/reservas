<!-- resources/views/no-permission.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="alert alert-danger">
            <h4 class="alert-heading">Acceso denegado</h4>
            <p>No tienes permiso para acceder a esta página. Por favor, contacta al administrador si crees que esto es un error.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Volver al Dashboard</a>
        </div>
    </div>
@endsection
