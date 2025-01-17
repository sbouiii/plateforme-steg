@extends('layouts.admin')

@section('styles')
    <style>
        .project-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            color: #2c3e50;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            border-bottom: 2px solid #3498db;
            padding-bottom: 0.5rem;
        }

        .card-text {
            color: #34495e;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .card-text strong {
            color: #2c3e50;
        }

        .btn-view {
            background-color: #3498db;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
            width: 45%;
        }

        .btn-view:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-edit {
            background-color: #f39c12;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
            width: 45%;
        }

        .btn-edit:hover {
            background-color: #d35400;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
        }

        .projects-header {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid #3498db;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-en-cours {
            background-color: #007bff;
        }

        .status-termine {
            background-color: #28a745;
        }

        .status-en-attente {
            background-color: #ffc107;
            color: #000;
        }

        .status-annule {
            background-color: #dc3545;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h2 class="projects-header">Liste des Projets</h2>

        <div class="row">
            @foreach ($projets as $projet)
                <div class="col-lg-4">
                    <div class="card project-card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $projet->titre }}</h5>
                            <p class="card-text">
                                <strong>Description:</strong> {{ Str::limit($projet->description, 100) }}<br>
                                <strong>Lieu:</strong> {{ $projet->lieu }}<br>
                                <strong>Budget estimé:</strong> {{ number_format($projet->budget_estime, 2) }} DT<br>
                                <strong>Date début:</strong>
                                {{ \Carbon\Carbon::parse($projet->date_debut)->format('d/m/Y') }}<br>
                                <strong>Date fin:</strong>
                                {{ \Carbon\Carbon::parse($projet->date_fin)->format('d/m/Y') }}<br>
                                <strong>Créé le:</strong> {{ $projet->created_at->format('d/m/Y') }}</br>
                                <strong>Statut:</strong>
                                @if ($projet->status == 'en_cours')
                                    <span class="status-badge status-en-cours">En cours</span>
                                @elseif($projet->status == 'termine')
                                    <span class="status-badge status-termine">Terminé</span>
                                @elseif($projet->status == 'en_attente')
                                    <span class="status-badge status-en-attente">En attente</span>
                                @elseif($projet->status == 'annule')
                                    <span class="status-badge status-annule">Annulé</span>
                                @endif
                                <br>
                            </p>
                            <div class="btn-container">
                                <a href="{{ route('admin.devis.projet', $projet->id) }}" class="btn btn-view text-white">
                                    <i class="fas fa-eye me-1"></i> Voir le devis
                                </a>
                               
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
