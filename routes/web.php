<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Type\Integer;
use App\Http\Controllers\SuperAdminController;
use App\Models\SuperAdmin;

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



/*
Route::prefix('/blog')->controller(PostController::class)->name('blog.')->group(function(){






    Route::get('/','index' )->name('index');

    Route::get('/{slug}/{id}','show' )/*->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');




});*/


//all routes

//Super Admin route web


Route::get('superadmin/registration', [SuperAdminController::class, 'registration'])->name('superadmin.registration');
Route::post('superadmin/registration_post', [SuperAdminController::class, 'registration_post'])->name('superadmin.registration_post');

Route::get('superadmin/login', [SuperAdminController::class, 'login'])->name('superadmin.login');
Route::post('superadmin/login_post', [SuperAdminController::class, 'login_post'])->name('superadmin.login_post');



Route::get('superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');


//
Route::get('superadmin/dashboard/createclubs', [SuperAdminController::class, 'createclubs'])->name('superadmin.create-clubs');
Route::post('superadmin/dashboard/createclubs_post', [SuperAdminController::class, 'createclubs_post'])->name('superadmin.create-clubs_post');




Route::get('logout',[SuperAdminController::class,'logout']);

//

//




//super admin middleware 
Route::middleware('guest.superadmin')
     ->group(function () {
         // Affiche le formulaire
         Route::get('superadmin/registration', [SuperAdminController::class, 'registration'])
              ->name('superadmin.registration');

         // Traitement du formulaire
         Route::post('superadmin/registration_post', [SuperAdminController::class, 'registration_post'])
              ->name('superadmin.registration_post');


            // Affiche le formulaire de login
        Route::get('superadmin/login', [SuperAdminController::class, 'login'])
              ->name('superadmin.login');
      
          // Traitement du login
        Route::post('superadmin/login_post', [SuperAdminController::class, 'login_post'])
              ->name('superadmin.login_post');



/*
            // Route pour la page de création de clubs
            Route::get('superadmin/dashboard/createclubs', [SuperAdminController::class, 'createclubs'])
                ->name('superadmin.create-clubs');
            // Route pour le traitement de la création de clubs
            Route::post('superadmin/dashboard/createclubs_post', [SuperAdminController::class, 'createclubs_post'])
                ->name('superadmin.create-clubs_post'); */

     });

     Route::middleware('auth:superadmin')->group(function () {
        Route::get('superadmin/dashboard', [SuperAdminController::class, 'dashboard'])
            ->name('superadmin.dashboard');
    
        Route::post('superadmin/logout', [SuperAdminController::class, 'logout'])
            ->name('superadmin.logout');

        
        
        // Route pour la page de création de clubs
        Route::get('superadmin/dashboard/createclubs', [SuperAdminController::class, 'createclubs'])
        ->name('superadmin.create-clubs');
    // Route pour le traitement de la création de clubs
    Route::post('superadmin/dashboard/createclubs_post', [SuperAdminController::class, 'createclubs_post'])
        ->name('superadmin.create-clubs_post');
    });
    

    


     




