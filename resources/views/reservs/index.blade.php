<!-- resources/views/reservations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Gestión de Reservaciones</h1>

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

        <!-- Formulario para crear una nueva reservación -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Crear Nueva Reservación</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('Reservation.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div class="mb-3">
                        <label for="room_id" class="form-label">Habitación</label>
                        <select name="room_id" id="room_id" class="form-select" required>
                            <option value="">Seleccione una habitación</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Fecha y Hora de Reservación</label>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control"
                            value="{{ old('reservation_date') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Reservación</button>
                </form>
            </div>
        </div>

        <!-- Tabla de reservaciones existentes -->
        <div class="card">
            <div class="card-header">
                <h5>Lista de Reservaciones</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Habitación</th>
                            <th scope="col">Fecha y Hora de Reservación</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->room->name }}</td>
                                <td>{{ $reservation->start_date }} hasta {{ $reservation->end_date }} </td>
                                <td>{{ $reservation->state }}</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay reservaciones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
