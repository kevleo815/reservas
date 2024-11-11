<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);

        $room = new Room();
        $room->name = $request->name;
        $room->description = $request->description;
        $room->save();

        return redirect()->route('rooms.index');
    }

    public function show($id)
    {
        $room = Room::find($id);
        return view('show', compact('room'));
    }

    public function edit($id)
    {
        $room = Room::find($id);
        $rooms = Room::all(); // Para mostrar la lista de habitaciones en la tabla
        return view('rooms.index', compact('room', 'rooms'));

    }

    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        $room->name = $request->name;
        $room->description = $request->description;
        $room->save();

        return redirect()->route('rooms.index');
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect()->route('rooms.index');
    }
}
