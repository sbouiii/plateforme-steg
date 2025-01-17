<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fornisseurController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\SupplierAuthController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\DevisController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::post('/fornisseur/create', [FornisseurController::class, 'store'])->name('fornisseur.register');
Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.register');

// Routes pour l'authentification des Admins
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/createprojet', [ProjetController::class, 'create'])->name('admin.createprojet');
        Route::post('/createprojet', [ProjetController::class, 'store'])->name('admin.createprojet.store');
        Route::get('/listprojets', [ProjetController::class, 'allprojets'])->name('admin.listprojets');
        Route::get('/listfornisseur', [FornisseurController::class, 'index'])->name('admin.listfornisseur');
        Route::get('/admin/projet/{id}/devis', [DevisController::class, 'projetDevis'])->name('admin.devis.projet');
        Route::patch('/devis/{devis}/status', [DevisController::class, 'updateStatus'])->name('devis.updateStatus');
    });
});

// Routes Supplier
Route::prefix('supplier')->group(function () {
    Route::get('/login', [SupplierAuthController::class, 'loginForm'])->name('supplier.login');
    Route::post('/login', [SupplierAuthController::class, 'login'])->name('supplier.login.submit');

    Route::middleware(['supplier'])->group(function () {
        Route::get('/dashboard', [SupplierAuthController::class, 'dashboard'])->name('supplier.dashboard');
        Route::post('/logout', [SupplierAuthController::class, 'logout'])->name('supplier.logout');
        Route::get('/listprojets', [ProjetController::class, 'index'])->name('supplier.listprojets');
        Route::post('/devis', [DevisController::class, 'store'])->name('devis.store');
        Route::get('/listDevis', [DevisController::class, 'index'])->name('supplier.listdevis');
    });
});

