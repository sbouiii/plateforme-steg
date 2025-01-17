@extends('layouts.admin')

@section('styles')
    <style>
        .project-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid #3498db;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h2 class="page-title">Devis du Projet</h2>

        <div class="project-info">
            <h4>Informations du Projet</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Titre:</strong> {{ $projet->titre }}</p>
                    <p><strong>Description:</strong> {{ $projet->description }}</p>
                    <p><strong>Lieu:</strong> {{ $projet->lieu }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Budget estimé:</strong> {{ number_format($projet->budget_estime, 2) }} DT</p>
                    <p><strong>Date début:</strong> {{ \Carbon\Carbon::parse($projet->date_debut)->format('d/m/Y') }}</p>
                    <p><strong>Date fin:</strong> {{ \Carbon\Carbon::parse($projet->date_fin)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <div class="table-container">
            <h4 class="mb-4">Liste des Devis</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>N° Devis</th>
                        <th>Fournisseur</th>
                        <th>Date</th>
                        <th>Montant Total</th>
                        <th>Délai (jours)</th>
                        <th>Détails</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devis as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->fournisseur->full_name }}</td>
                            <td>{{ $d->created_at->format('d/m/Y') }}</td>
                            <td>{{ number_format($d->montant, 2) }} DT</td>
                            <td>{{ $d->delai }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="{{ $d->details }}">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </td>
                            <td>
                                <span
                                    class="badge bg-{{ $d->status == 'accepte' ? 'success' : ($d->status == 'en_attente' ? 'warning' : 'danger') }}">
                                    {{ ucfirst(str_replace('_', ' ', $d->status)) }}
                                </span>
                            </td>
                            <td>

                                @if ($d->status == 'en_attente')
                                    <form action="{{ route('devis.updateStatus', $d->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="status" value="accepte"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="submit" name="status" value="rejete" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
