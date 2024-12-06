<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        if (Auth::user())
        {
            return redirect('/dashboard');
        }
        else
        {
            return view('auth.login');
        }
    }

    public function loginPost(Request $request)
    {
        // Validation des champs
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        // Tentative d'authentification
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']]))
        {
            // Régénérer la session pour éviter la fixation de session
            $request->session()->regenerate();

            // Redirection après succès
            return redirect()->intended('/dashboard')->with('success', 'Connexion réussie !');
        }

        // Retour en cas d'échec de l'authentification
        return back()->withErrors([
            'email' => 'Les informations d\'identification ne correspondent pas.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function passwordRequest() {
        return view('auth.password-request');
    }

    public function passwordReset() {
        return view('auth.password-reset');
    }


}
