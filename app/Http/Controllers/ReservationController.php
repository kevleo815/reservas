<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //

    public function index(Request $request)
    {




        $rooms = Room::all();
        $reservations = reservation::all();
        return view('reservs.index', compact('reservations', 'rooms'));
    }

    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
        ]);

        // Obtener la fecha de inicio y calcular la fecha de fin
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = $startDate->copy()->addHour();

        // Verificar si la habitación ya está reservada en el rango de fechas seleccionado
        $conflictingReservation = Reservation::where('room_id', $request->input('room_id'))
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->exists();

        // Si hay una reservación en conflicto, redirigir con un mensaje de error
        if ($conflictingReservation) {
            return redirect()->back()->withErrors(['error' => 'La habitación ya está reservada en el rango de fechas seleccionado.']);
        }

        // Crear la nueva reservación si no hay conflicto
        $reservation = new Reservation([
            'room_id' => $request->input('room_id'),
            'user_id' => auth()->id(),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        $reservation->save();

        return redirect()->route('Reservation.index')->with('success', 'Reservación creada correctamente.');
    }

    public function admin(Request $request)
    {
        $rooms = Room::all(); // Obtener todas las salas para el formulario y el filtro

        // Obtener todas las reservaciones, aplicando el filtro de sala si existe
        $query = Reservation::with('room');

        if ($request->has('filter_room_id') && $request->filter_room_id) {
            $query->where('room_id', $request->filter_room_id);
        }

        $reservations = $query->get();

        return view('reservs.adminReservs', compact('rooms', 'reservations'));


    }

    public function edit($id)
    {
        $reservation = Reservation::find($id);
        return view('reservs.edit', compact('reservation'));

    }


    public function update(Request $request, $id)
    {
        // Validar los datos


        // Obtener la reservación y actualizar los campos
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());


        return redirect()->route('Reservation.admin');
    }

}
