<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\Supplier;
use App\Models\Devis;

class AdminAuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }
    public function dashboard()
    {
        // Récupérer les statistiques
        $stats = [
            'total_projets' => Projet::count(),
            'projets_termines' => Projet::where('status', 'termine')
                ->orWhere('date_fin', '<', now())
                ->count(),
            'total_fournisseurs' => Supplier::count(),
            'total_devis' => Devis::count(),
            'devis_acceptes' => Devis::where('status', 'accepte')->count(),
            'devis_rejetes' => Devis::where('status', 'rejete')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
    public function login(Request $request)
    {
        $mouhib = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->guard('admin')->attempt($mouhib)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ]);
    }
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
