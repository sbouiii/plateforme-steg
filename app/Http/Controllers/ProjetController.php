<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;
class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projets = Projet::all();
        return view('Fornisseur.listprojet', compact('projets'));
    }
    public function allprojets()
    {
        $projets = Projet::all();
        return view('admin.listprojets', compact('projets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createprojet');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $projet = new Projet();
        $projet->titre = $request->input('titre');
        $projet->description = $request->input('description');
        $projet->lieu = $request->input('lieu');
        $projet->budget_estime = $request->input('budget_estime');
        $projet->date_debut = $request->input('date_debut');
        $projet->date_fin = $request->input('date_fin');
        $projet->save();
        return redirect()->route('admin.listprojets');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
