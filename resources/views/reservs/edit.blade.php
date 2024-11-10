<!-- resources/views/reservations/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Editar Estado de la Reservación</h1>

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5>Editar Estado de la Reservación</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('Reservation.update', $reservation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="state" class="form-label">Estado</label>
                        <select name="state" id="state" class="form-select" required>
                            <option value="Pendiente" {{ $reservation->state == 'Pendiente' ? 'selected' : '' }}>Pendiente
                            </option>
                            <option value="Aceptada" {{ $reservation->state == 'Aceptada' ? 'selected' : '' }}>Aceptada
                            </option>
                            <option value="Rechazada" {{ $reservation->state == 'Rechazada' ? 'selected' : '' }}>Rechazada
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="{{ route('Reservation.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
