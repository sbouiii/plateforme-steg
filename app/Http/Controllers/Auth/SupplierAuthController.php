<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierAuthController extends Controller
{
    public function loginForm()
    {
        return view('Fornisseur.loginfornisseur');
    }
    public function dashboard()
    {
        return view('Fornisseur.dashboard');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->guard('supplier')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('supplier.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ]);
    }
    public function logout()
    {
        auth()->guard('supplier')->logout();
        return redirect()->route('supplier.login');
    }
}
