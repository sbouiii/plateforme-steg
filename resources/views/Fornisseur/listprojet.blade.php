@extends('layouts.fornisseur')

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

        .search-container {
            margin-bottom: 2rem;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #3498db;
            border-radius: 25px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.3);
        }

        /* Styles pour le modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
        }

        .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #f39c12;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid px-4">
        <h2 class="projects-header">Liste des Projets</h2>

        <div class="search-container">
            <input type="text" id="searchLieu" class="search-input" placeholder="Rechercher par lieu...">
        </div>

        <div class="row" id="projetsContainer">
            @foreach ($projets as $projet)
                <div class="col-lg-4 projet-item" data-lieu="{{ strtolower($projet->lieu) }}">
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
                                @if ($projet->status == 'en_attente')
                                    @php
                                        $devisExistant = App\Models\Devis::where('projet_id', $projet->id)
                                            ->where('supplier_id', Auth::guard('supplier')->user()->id)
                                            ->exists();
                                    @endphp

                                    @if (!$devisExistant)
                                        <button onclick="openDevisModal({{ $projet->id }})"
                                            class="btn btn-edit text-white">
                                            <i class="fas fa-edit me-1"></i> Créer le devis
                                        </button>
                                    @else
                                        <span class="status-badge status-termine">
                                            <i class="fas fa-check me-1"></i> Devis déjà soumis
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal pour créer un devis -->
    <div id="devisModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDevisModal()">&times;</span>
            <h2>Créer un devis</h2>
            <form id="devisForm" action="{{ route('devis.store') }}" method="post">
                @csrf
                <input type="hidden" id="projetId" name="projet_id">
                <div class="form-group">
                    <label for="montant">Montant total (DT)</label>
                    <input type="number" class="form-control" id="montant" name="montant" required>
                </div>
                <div class="form-group">
                    <label for="delai">Délai d'exécution (jours)</label>
                    <input type="number" class="form-control" id="delai" name="delai" required>
                </div>
                <div class="form-group">
                    <label for="description">Description détaillée</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-edit text-white">Soumettre le devis</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('searchLieu').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let projets = document.getElementsByClassName('projet-item');

            Array.from(projets).forEach(function(projet) {
                let lieu = projet.getAttribute('data-lieu');
                if (lieu.includes(searchValue)) {
                    projet.style.display = '';
                } else {
                    projet.style.display = 'none';
                }
            });
        });

        // Fonctions pour le modal
        function openDevisModal(projetId) {
            console.log('ID du projet:', projetId); // Pour déboguer
            document.getElementById('devisModal').style.display = 'block';
            document.getElementById('projetId').value = projetId;
        }

        function closeDevisModal() {
            document.getElementById('devisModal').style.display = 'none';
        }

        // Fermer le modal si on clique en dehors
        window.onclick = function(event) {
            let modal = document.getElementById('devisModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Gestion du formulaire
        document.getElementById('devisForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Récupération des valeurs
            const projetId = document.getElementById('projetId').value;
            const montant = document.getElementById('montant').value;
            const delai = document.getElementById('delai').value;
            const description = document.getElementById('description').value;

            // Validation côté client
            if (!montant || montant <= 0) {
                alert('Veuillez entrer un montant valide');
                return;
            }

            if (!delai || delai <= 0) {
                alert('Veuillez entrer un délai valide');
                return;
            }

            if (!description) {
                alert('Veuillez entrer une description');
                return;
            }

            // Création du FormData
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('projet_id', projetId);
            formData.append('supplier_id', {{ Auth::guard('supplier')->user()->id }});
            formData.append('montant', montant);
            formData.append('delai', delai);
            formData.append('description', description);

            // Désactiver le bouton submit pendant l'envoi
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = 'Envoi en cours...';

            fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Devis créé avec succès!');
                        closeDevisModal();
                        // Recharger la page après succès
                        window.location.reload();
                    } else {
                        throw new Error(data.message || 'Erreur lors de la création du devis');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert(error.message || 'Une erreur est survenue lors de la création du devis');
                })
                .finally(() => {
                    // Réactiver le bouton submit
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Soumettre le devis';
                });
        });
    </script>
@endsection
