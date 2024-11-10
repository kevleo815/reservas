<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Resumen</h5>
                        <p class="card-text">Algunos datos importantes sobre el estado actual del sistema.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Usuarios</h5>
                            <p class="card-text">Gestión y detalles de los usuarios registrados en el sistema.</p>
                            <a href="#" class="btn btn-primary">Gestionar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Reportes</h5>
                            <p class="card-text">Genera y visualiza reportes detallados de actividades y datos.</p>
                            <a href="#" class="btn btn-primary">Ver reportes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
