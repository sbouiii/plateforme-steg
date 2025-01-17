<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            background-color: #f5f6fa;
        }

        .sidebar {
            width: 280px;
            background-color: #1e272e;
            color: white;
            height: 100vh;
            padding: 25px;
            box-sizing: border-box;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            font-size: 1.6rem;
            margin-bottom: 1.5rem;
            padding-bottom: 15px;
            border-bottom: 1px solid #34495e;
            color: #3498db;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
            transform: translateX(10px);
        }

        .content {
            flex: 1;
            padding: 30px;
            background-color: #fff;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            background-color: #c0392b;
            color: white;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 30px;
            width: 100%;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #e74c3c;
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2><a href="{{ route('admin.dashboard') }}">Administration</a></h2>
        <ul>
            <li><a href="{{ route('admin.createprojet') }}"><i class="fas fa-plus"></i> Créer Projet</a></li>
            <li><a href="{{ route('admin.listprojets') }}"><i class="fas fa-list"></i> Liste des Projets</a></li>
            <li><a href="{{ route('admin.listfornisseur') }}"><i class="fas fa-users"></i> Gestion Utilisateurs</a></li>
        </ul>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Déconnexion</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
