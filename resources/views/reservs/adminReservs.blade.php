<!-- resources/views/reservations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Gestión de Reservaciones</h1>

        <!-- Filtro por sala -->
        <form action="{{ route('Reservation.admin') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="filter_room_id" class="form-label">Filtrar por Sala</label>
                    <select name="filter_room_id" id="filter_room_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Todas las salas</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}"
                                {{ request('filter_room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>






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
                            <th scope="col">Sala</th>
                            <th scope="col">Fecha y Hora de Reservación</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <form>
                                <tr>
                                    <td>{{ $reservation->user->name }}</td>
                                    <td>{{ $reservation->room->name }}</td>
                                    <td>{{ $reservation->start_date }} hasta {{ $reservation->end_date }} </td>
                                    <td>
                                        {{ $reservation->state }}
                                    </td>
                                    <td><a href="{{ route('Reservation.edit', $reservation->id) }}"
                                            class="btn btn-sm btn-warning">Editar</a> </td>



                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay reservaciones registradas.</td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
{{-- <td>{{ $reservation->room->name }}</td>
                                <td>{{ $reservation->start_date }} hasta {{ $reservation->end_date }} </td>
                                <td>
                                    <select name="state" id="state" required class="form-select" >
                                        <option value="Pendiente"
                                            {{ $reservation->state == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="Aceptada" {{ $reservation->state == 'Aceptada' ? 'selected' : '' }}>
                                            Aceptada</option>
                                        <option value="Rechazada"
                                            {{ $reservation->state == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                                    </select>
                                </td>
                                <td>
                                    <form action="{{ route('Reservation.update', $reservation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="state" value="{{ $reservation->state }}">
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                    </form>
                                </td> --}}
