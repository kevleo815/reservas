<!-- resources/views/auth/passwords/email.blade.php -->
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Restablecer Contraseña</h2>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar Enlace de Restablecimiento</button>
        </form>
    </div>
</div>
@endsection
