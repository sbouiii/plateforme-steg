@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Liste des Fournisseurs</h2>

        <!-- Search Form -->
        <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <form action="" method="GET">
                    <div class="input-group shadow-sm">
                        <input type="text" name="search" class="form-control border-primary"
                            placeholder="Rechercher par nom ou email" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Suppliers Table -->
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Nom Complet</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fornisseurs as $fornisseur)
                                <tr>
                                    <td>{{ $fornisseur->full_name }}</td>
                                    <td>{{ $fornisseur->email }}</td>
                                    <td>{{ $fornisseur->phone_number }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $fornisseurs->links() }}
        </div>
    </div>
@endsection
