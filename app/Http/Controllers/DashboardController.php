<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //consultamos el usuario logeado
        $user=Auth::user();
        return view('layouts.app', compact('user'));
    }
}
