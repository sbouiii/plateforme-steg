@extends('layouts.admin')

@section('title', 'Créer un Projet')

@section('styles')
<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    input[type="text"],
    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }
    textarea {
        height: 100px;
        resize: vertical;
    }
    .btn-submit {
        background-color: #2c3e50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-submit:hover {
        background-color: #34495e;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1>Créer un nouveau projet</h1>

    <form action="{{ route('admin.createprojet.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="titre">Titre du projet</label>
            <input type="text" id="titre" name="titre" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="lieu">Lieu</label>
            <select id="lieu" name="lieu" required>
                <option value="">Sélectionnez une ville</option>
                <option value="Tunis">Tunis</option>
                <option value="Sfax">Sfax</option>
                <option value="Sousse">Sousse</option>
                <option value="Kairouan">Kairouan</option>
                <option value="Bizerte">Bizerte</option>
                <option value="Gabès">Gabès</option>
                <option value="Ariana">Ariana</option>
                <option value="Gafsa">Gafsa</option>
                <option value="Monastir">Monastir</option>
                <option value="Ben Arous">Ben Arous</option>
                <option value="Kasserine">Kasserine</option>
                <option value="Médenine">Médenine</option>
                <option value="Nabeul">Nabeul</option>
                <option value="Tataouine">Tataouine</option>
                <option value="Béja">Béja</option>
                <option value="Le Kef">Le Kef</option>
                <option value="Mahdia">Mahdia</option>
                <option value="Sidi Bouzid">Sidi Bouzid</option>
                <option value="Jendouba">Jendouba</option>
                <option value="Tozeur">Tozeur</option>
                <option value="La Manouba">La Manouba</option>
                <option value="Siliana">Siliana</option>
                <option value="Zaghouan">Zaghouan</option>
                <option value="Kébili">Kébili</option>
            </select>
        </div>

        <div class="form-group">
            <label for="budget_estime">Budget estimé (DT)</label>
            <input type="number" id="budget_estime" name="budget_estime" min="0" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" id="date_debut" name="date_debut" required>
        </div>

        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" id="date_fin" name="date_fin" required>
        </div>

        <button type="submit" class="btn-submit">Créer le projet</button>
    </form>
</div>
@endsection
