<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }
    
    public function showRegisterForm() {
        return view('auth.registro');
    }
    
    public function showWelcome() {
        return view('inicio'); 
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Si las credenciales son correctas, redirige al home
            return redirect()->intended('/home');
        }

        // Si las credenciales son incorrectas, redirige con un mensaje de error
        return redirect()->route('login')->with('error', 'Credenciales incorrectas');
    }

    public function registro(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'telefono'=>'required|string|max:9',
            'password' => 'required|confirmed|min:6',
        ]);

        // Crear el usuario usando el modelo Usuarios
        Usuarios::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password, // El modelo hace bcrypt automáticamente
        ]);

        // Redirigir al login con un mensaje de éxito
        return redirect()->route('login')->with('status', 'Usuario registrado con éxito. Por favor, inicia sesión.');
    }
}

