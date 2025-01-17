<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fornisseur Dashboard')</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1a237e, #283593);
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
        }

        .sidebar h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: #fff;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .user-info h3 {
            color: #90caf9;
            font-size: 1.1rem;
            margin: 10px 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 8px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar ul li a i {
            width: 25px;
            margin-right: 10px;
        }

        .content {
            flex: 1;
            padding: 30px;
            margin-left: 280px;
        }

        .logout-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            border-radius: 8px;
            width: 100%;
            margin-top: 30px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <div class="sidebar">
        <h2><a href="{{ route('supplier.dashboard') }}">Fornisseur</a></h2>
        <div class="user-info">
            <h3>{{ Auth::guard('supplier')->user()->full_name }}</h3>
        </div>
        <ul>
            <li><a href="{{ route('supplier.listprojets') }}">
                    <i class="fas fa-project-diagram"></i> Liste Projets
                </a></li>
            <li><a href="{{ route('supplier.listdevis') }}">
                    <i class="fas fa-file-invoice-dollar"></i> Mes Devis
                </a></li>

        </ul>
        <form method="POST" action="{{ route('supplier.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @yield('scripts')
</body>

</html>
