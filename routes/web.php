<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BureauMemberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AuthController as Auth;
use App\Http\Controllers\admin\ActualiteController as Actualite;
use App\Http\Controllers\admin\VieCoutumeController as VieCoutume;
use App\Http\Controllers\admin\EducationController as Education;
use App\Http\Controllers\Admin\CommunauteController as Communaute;

/*
|--------------------------------------------------------------------------
| SITE PUBLIC
|--------------------------------------------------------------------------
*/



Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/la-mutuelle', [PageController::class, 'mutuelle'])->name('mutuelle');
Route::get('/gouvernance', [PageController::class, 'gouvernance'])->name('gouvernance');
Route::get('/chefferie-patrimoine', [PageController::class, 'chefferie'])->name('chefferie');
Route::get('/chefferie/{id}', [PageController::class, 'chefferieDetail'])->name('chefferie.detail');
Route::get('/education-excellence', [PageController::class, 'education'])->name('education');
Route::get('/education/{slug}', [PageController::class, 'educationDetail'])->name('education.detail');
Route::get('/jeunesse', [PageController::class, 'jeunesse'])->name('jeunesse');
Route::get('/cadres-diaspora', [PageController::class, 'cadres'])->name('cadres');
Route::get('/solidarite', [PageController::class, 'solidarite'])->name('solidarite');
Route::get('/projets-de-developpement', [PageController::class, 'projets'])->name('projets');
Route::get('/projets/{slug}', [PageController::class, 'projetsDetail'])->name('projets.detail');
Route::get('/transparence', [PageController::class, 'transparence'])->name('transparence');
Route::get('/actualites', [PageController::class, 'actualites'])->name('actualites');
Route::get('/actualites/{slug}', [PageController::class, 'actualitesDetail'])->name('actualites.detail');
Route::get('/partenaires', [PageController::class, 'partenaires'])->name('partenaires');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/gouvernance/telechargement/{type}/{slug}', function (string $type, string $slug) {
    $catalog = [
        'document' => [
            'statuts-reglement-interieur' => 'Statuts et règlement intérieur',
            'code-ethique-deontologie' => 'Code d\'éthique et de déontologie',
            'manuel-procedures' => 'Manuel de procédures',
            'plan-strategique-2023-2027' => 'Plan stratégique 2023-2027',
        ],
        'rapport' => [
            'rapport-activites-2023' => 'Rapport d\'activités 2023',
            'rapport-activites-2022' => 'Rapport d\'activités 2022',
            'rapport-activites-2021' => 'Rapport d\'activités 2021',
            'rapport-activites-2020' => 'Rapport d\'activités 2020',
        ],
    ];

    abort_unless(isset($catalog[$type][$slug]), 404);

    $title = $catalog[$type][$slug];
    $fileName = $slug . '.txt';
    $content = $title . "\n\nDocument de présentation MUDEA.\nCe fichier a été généré automatiquement pour permettre le téléchargement depuis le site.\n";

    return response()->streamDownload(function () use ($content) {
        echo $content;
    }, $fileName, [
        'Content-Type' => 'text/plain; charset=UTF-8',
    ]);
})->name('gouvernance.download');


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

    // Actualités
    Route::prefix('actualites')->name('actualites.')->group(function () {
        Route::get('/', [Actualite::class, 'index'])->name('index');
        Route::get('/create', [Actualite::class, 'create'])->name('create');
        Route::post('/', [Actualite::class, 'store'])->name('store');
        Route::get('/{id}', [Actualite::class, 'show'])->name('show');
        Route::get('/{id}/edit', [Actualite::class, 'edit'])->name('edit');
        Route::put('/{id}', [Actualite::class, 'update'])->name('update');
        Route::delete('/{id}', [Actualite::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/statut', [Actualite::class, 'changeStatut'])->name('statut');
    });


    // Pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('pages');



    // Vie & Coutumes
    Route::prefix('vie-coutumes')->name('vie-coutumes.')->group(function () {
        Route::get('/', [VieCoutume::class, 'index'])->name('index');
        Route::post('/', [VieCoutume::class, 'store'])->name('store');
        Route::put('/{id}', [VieCoutume::class, 'update'])->name('update');
        Route::delete('/{id}', [VieCoutume::class, 'destroy'])->name('destroy');
    });


    // Education & Excellence
    Route::prefix('education')->name('education.')->group(function () {
        Route::get('/', [Education::class, 'index'])->name('index');
        Route::post('/', [Education::class, 'store'])->name('store');
        Route::put('/{id}', [Education::class, 'update'])->name('update');
        Route::delete('/{id}', [Education::class, 'destroy'])->name('destroy');
    });


    // Espace communautaire
    Route::prefix('communaute')->name('communaute.')->group(function () {
        Route::get('/', [Communaute::class, 'index'])->name('index');
        Route::post('/', [Communaute::class, 'store'])->name('store');
        Route::put('/{id}', [Communaute::class, 'update'])->name('update');
        Route::delete('/{id}', [Communaute::class, 'destroy'])->name('destroy');
    });


    // Projets
    Route::get('/projets', [AdminController::class, 'projets'])->name('projets');
    Route::post('/projets', [AdminController::class, 'storeProjet'])->name('projets.store');
    Route::patch('/projets/{projet}', [AdminController::class, 'updateProjet'])->name('projets.update');
    Route::delete('/projets/{projet}', [AdminController::class, 'destroyProjet'])->name('projets.destroy');

    // Bureau
    Route::prefix('bureau')->name('bureau.')->group(function () {
        Route::get('/', [BureauMemberController::class, 'index'])->name('index');
        Route::post('/', [BureauMemberController::class, 'store'])->name('store');
        Route::put('/{id}', [BureauMemberController::class, 'update'])->name('update');
        Route::delete('/{id}', [BureauMemberController::class, 'destroy'])->name('destroy');
    });

    // Messages
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages');


    // Utilisateurs
    Route::post('/utilisateurs', [AdminController::class, 'storeUtilisateur'])->name('utilisateurs.store');
    Route::get('/utilisateurs', [AdminController::class, 'utilisateurs'])->name('utilisateurs');


    // Paramètres
    Route::get('/parametres', [AdminController::class, 'parametres'])->name('parametres');
    Route::post('/parametres/mot-de-passe', [AdminController::class, 'updatePassword'])->name('parametres.password.update');


    // Statistiques
    Route::get('/statistiques', [AdminController::class, 'statistiques'])->name('statistiques');
});
