@extends('layouts.admin')

@section('title', 'Tableau de Bord')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tableau de Bord</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Statistiques des Projets -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Projets</h3>
            <div class="space-y-2">
                <p>Total des projets: <span class="font-bold">{{ $stats['total_projets'] }}</span></p>
                <p>Projets terminés: <span class="font-bold">{{ $stats['projets_termines'] }}</span></p>
            </div>
        </div>

        <!-- Statistiques des Fournisseurs -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Fournisseurs</h3>
            <div class="space-y-2">
                <p>Total des fournisseurs: <span class="font-bold">{{ $stats['total_fournisseurs'] }}</span></p>
            </div>
        </div>

        <!-- Statistiques des Devis -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Devis</h3>
            <div class="space-y-2">
                <p>Total des devis: <span class="font-bold">{{ $stats['total_devis'] }}</span></p>
                <p>Devis acceptés: <span class="font-bold">{{ $stats['devis_acceptes'] }}</span></p>
                <p>Devis rejetés: <span class="font-bold">{{ $stats['devis_rejetes'] }}</span></p>
            </div>
        </div>
    </div>
@endsection
