<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('welcome');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard'); // Cambia 'dashboard' por la ruta deseada
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }

    // Mostrar el formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Procesar el registro
    public function register(Request $request)
    {

        //consultamos el id del rol cliente

        $role = Role::where('name', 'Cliente')->first();


        // validar name, email y password y password confirmation



        $credentials = $request->validate([
            'name' => 'required',
            'email' => ' required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        //si estan correctos registramos el usuario

        User::create([
            'role_id' => $role->id,
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);

        //le redirigimos a la ruta de inicio de sesión
        return redirect()->intended('login');


    }

    // Mostrar el formulario de restablecimiento de contraseña
    public function showPasswordRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Enviar el enlace de restablecimiento de contraseña
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
