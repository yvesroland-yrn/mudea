<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AuthController as Auth;

/*
|--------------------------------------------------------------------------
| SITE PUBLIC
|--------------------------------------------------------------------------
*/


Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/la-mutuelle', [PageController::class, 'mutuelle'])->name('mutuelle');
Route::get('/gouvernance', [PageController::class, 'gouvernance'])->name('gouvernance');
Route::get('/chefferie-patrimoine', [PageController::class, 'chefferie'])->name('chefferie');
Route::get('/education-excellence', [PageController::class, 'education'])->name('education');
Route::get('/jeunesse', [PageController::class, 'jeunesse'])->name('jeunesse');
Route::get('/cadres-diaspora', [PageController::class, 'cadres'])->name('cadres');
Route::get('/solidarite', [PageController::class, 'solidarite'])->name('solidarite');
Route::get('/projets-de-developpement', [PageController::class, 'projets'])->name('projets');
Route::get('/transparence', [PageController::class, 'transparence'])->name('transparence');
Route::get('/actualites', [PageController::class, 'actualites'])->name('actualites');
Route::get('/partenaires', [PageController::class, 'partenaires'])->name('partenaires');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/connexion', [Auth::class, 'login'])->name('login');
Route::post('/connexion', [Auth::class, 'login_store'])->name('login.store');
Route::post('/deconnexion', [Auth::class, 'logout'])->name('logout');



/*
|--------------------------------------------------------------------------
| ADMINISTRATION
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Tableau de bord
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [Auth::class, 'logout'])->name('logout');


    // Actualités
    Route::get('/actualites', [AdminController::class, 'actualites'])->name('actualites');


    // Pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('pages');


    // Vie & Coutumes
    Route::get('/vie-coutumes', [AdminController::class, 'vieCoutumes'])->name('vie-coutumes');

    // Education & Excellence
    Route::get('/education', [AdminController::class, 'education'])->name('education');

    // Espace communautaire
    Route::get('/communaute', [AdminController::class, 'communaute'])->name('communaute');

    // Projets
    Route::get('/projets', [AdminController::class, 'projets'])->name('projets');

    // Messages
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');

    // Utilisateurs
    Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs');

    // Paramètres
    Route::get('/parametres', [AdminController::class, 'parametres'])->name('parametres');

    // Statistiques
    Route::get('/statistiques', [AdminController::class, 'statistiques'])->name('statistiques');

});
