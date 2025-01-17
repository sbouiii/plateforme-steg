<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\Projet;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devis = Devis::where('supplier_id', auth()->guard('supplier')->id())
            ->with(['projet', 'fournisseur'])
            ->get();

        return view('fornisseur.devis', compact('devis'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Vérifier si un devis existe déjà
        $devisExistant = Devis::where('projet_id', $request->projet_id)
            ->where('supplier_id', $request->supplier_id)
            ->exists();

        if ($devisExistant) {
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà créé un devis pour ce projet'
            ], 422);
        }

        try {
            // Validation des données
            $request->validate([
                'projet_id' => 'required|exists:projets,id',
                'supplier_id' => 'required|exists:suppliers,id',
                'montant' => 'required|numeric|min:0',
                'delai' => 'required|integer|min:1',
                'description' => 'required|string'
            ]);

            // Création du devis
            $devis = new Devis();
            $devis->projet_id = $request->projet_id;
            $devis->supplier_id = $request->supplier_id;
            $devis->montant = $request->montant;
            $devis->details = $request->description;
            $devis->delai = $request->delai;
            $devis->status = 'en_attente';
            $devis->save();

            // Si tout s'est bien passé
            return response()->json([
                'success' => true,
                'message' => 'Devis créé avec succès',
                'devis' => $devis
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création du devis: ' . $e->getMessage()
            ], 500);
        }
    }





    public function projetDevis($id)
    {
        $projet = Projet::findOrFail($id);
        $devis = Devis::where('projet_id', $id)->get();

        return view('admin.listdevis', compact('projet', 'devis'));
    }

    public function updateStatus(Request $request, Devis $devis)
    {
        $request->validate([
            'status' => 'required|in:accepte,rejete,en_attente'
        ]);

        $devis->update(['status' => $request->status]);

        // Mettre à jour le statut du projet si le devis est accepté
        if ($request->status === 'accepte') {
            $projet = Projet::find($devis->projet_id);
            $projet->update(['status' => 'en_cours']);
        }

        return redirect()->back()->with('success', 'Le statut du devis a été mis à jour.');
    }
}
