@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Gestión de Habitaciones</h1>

    <!-- Formulario para crear o editar una habitación -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>{{ isset($room) ? 'Editar Habitación' : 'Crear Nueva Habitación' }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($room) ? route('rooms.update', $room->id) : route('rooms.store') }}" method="POST">
                @csrf
                @if (isset($room))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la Habitación</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ isset($room) ? $room->name : '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="3" >{{ isset($room) ? $room->description : '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($room) ? 'Actualizar Habitación' : 'Crear Habitación' }}</button>
                @if (isset($room))
                    <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancelar</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Tabla de habitaciones -->
    <div class="card">
        <div class="card-header">
            <h5>Lista de Habitaciones</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $room)
                        <tr>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->description }}</td>
                            <td>
                                <!-- Botón de edición y eliminación -->
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta habitación?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay habitaciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
