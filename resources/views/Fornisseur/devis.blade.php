@extends('layouts.fornisseur')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h3 mb-0"><i class="fas fa-file-invoice-dollar me-2"></i>Mes Devis</h1>
            </div>

            <div class="card-body bg-light">
                @if ($devis->count() > 0)
                    <div class="row g-4">
                        @foreach ($devis as $key => $devis_item)
                            @if ($key > 0 && $key % 3 == 0)
                                <div class="col-12">
                                    <hr class="text-muted my-4">
                                </div>
                            @endif
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow position-relative">
                                    <div class="position-absolute counter-badge">
                                        {{ $key + 1 }}
                                    </div>
                                    <div class="card-header bg-white border-bottom border-primary border-2">
                                        <h5 class="card-title text-primary mb-0">
                                            <i class="fas fa-project-diagram me-2"></i>
                                            {{ $devis_item->projet->titre }}
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div
                                            class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                                            <span class="text-muted"><i class="fas fa-euro-sign me-2"></i>Montant</span>
                                            <span
                                                class="fw-bold text-primary">{{ number_format($devis_item->montant, 2, ',', ' ') }}
                                                €</span>
                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center p-2 mb-2 bg-light rounded">
                                            <span class="text-muted"><i class="fas fa-clock me-2"></i>Délai</span>
                                            <span class="fw-bold">{{ $devis_item->delai ?? '-' }} jours</span>
                                        </div>

                                        <div
                                            class="d-flex justify-content-between align-items-center p-2 mb-3 bg-light rounded">
                                            <span class="text-muted"><i class="fas fa-info-circle me-2"></i>Statut</span>
                                            @php
                                                $statusClasses = [
                                                    'accepte' => 'success',
                                                    'en_attente' => 'warning',
                                                    'refuse' => 'danger',
                                                ];
                                                $statusClass = $statusClasses[$devis_item->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge rounded-pill bg-{{ $statusClass }} px-3 py-2">
                                                {{ ucfirst(str_replace('_', ' ', $devis_item->status)) }}
                                            </span>
                                        </div>

                                        @if ($devis_item->details)
                                            <div class="p-2 mb-3 bg-light rounded">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-align-left me-2"></i>Détails
                                                </small>
                                                <p class="card-text small mb-0" title="{{ $devis_item->details }}">
                                                    {{ Str::limit($devis_item->details, 100) }}
                                                </p>
                                            </div>
                                        @endif

                                        <div class="text-muted small mt-3 pt-2 border-top">
                                            <i class="far fa-calendar-alt me-2"></i>
                                            Créé le {{ $devis_item->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info border-0 shadow-sm">
                        <i class="fas fa-info-circle me-2"></i>
                        Aucun devis n'a été échangé pour le moment. Commencez par répondre à des projets pour créer vos
                        premiers devis.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .hover-shadow:hover {
            transform: translateY(-3px);
            transition: all 0.3s ease;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .card {
            transition: all 0.3s ease;
        }

        hr {
            opacity: 0.15;
            border-width: 2px;
        }

        .counter-badge {
            top: -10px;
            left: -10px;
            width: 30px;
            height: 30px;
            background-color: #fd7e14;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            z-index: 1;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
