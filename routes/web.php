<?php

use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ROTAS PÚBLICAS
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cadastro-candidato', [FormController::class, 'candidato'])->name('pages.candidate');
Route::get('/formulario-de-cadastro/{id}', [FormController::class, 'index'])->name('pages.registration');

// ROTAS DE LOGIN PADRÃO (fora do grupo painel, obrigatórias para funcionar corretamente com Auth)
Route::prefix('painel')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('painel.login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('painel.login.submit');
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('painel.logout');
});
Route::group(['middleware' => ['auth']], function () {

    Route::prefix('painel')->group(function () {

        Route::get('/', [PanelController::class, 'index'])->name('home.index');
        Route::get('/dashboards', [PanelController::class, 'index'])->name('dashboards'); // nome completo: painel.dashboards

        Route::get('/lista-de-cadastros', [PanelController::class, 'registrationlist'])->name('registrationlist');

        Route::get('/formulario-de-perguntas', [AdministrativoController::class, 'questions'])->name('pages.question');
        Route::get('/formulario-de-perguntas/criar', [AdministrativoController::class, 'questionsCreate'])->name('pages.question.create');
        Route::get('/formulario-de-perguntas/edit/{id}', [AdministrativoController::class, 'questionsUpdate'])->name('pages.question.update');

        Route::get('/usuarios', [AdministrativoController::class, 'usuarios'])->name('pages.usuarios');
        Route::get('/tabela-colunas', [AdministrativoController::class, 'tableColumn'])->name('pages.tablecolumn');
        Route::get('/perfil-acesso', [AdministrativoController::class, 'perfilAcesso'])->name('pages.perfilacesso');
        Route::get('/permissao/{permission}', [AdministrativoController::class, 'permission'])->name('pages.permission');

        Route::get('/errors/error404', [PanelController::class, 'error404'])->name('error404');
    });

});

// // ROTAS DO PAINEL (prefixo e nome painel.)
// Route::group([
//     'prefix' => 'painel',
//     'as' => 'painel.',
// ], function () {

//     // Rotas de autenticação (dentro do painel)
//     Auth::routes([
//         'register' => false,
//         'reset' => false,
//     ]);

//     // Rotas protegidas por auth
//     Route::group(['middleware' => ['auth']], function () {

//         Route::get('/', [PanelController::class, 'index'])->name('home.index');
//         Route::get('/dashboards', [PanelController::class, 'index'])->name('dashboards'); // nome completo: painel.dashboards

//         Route::get('/lista-de-cadastros', [PanelController::class, 'registrationlist'])->name('registrationlist');

//         Route::get('/formulario-de-perguntas', [AdministrativoController::class, 'questions'])->name('pages.question');
//         Route::get('/formulario-de-perguntas/criar', [AdministrativoController::class, 'questionsCreate'])->name('pages.question.create');
//         Route::get('/formulario-de-perguntas/edit/{id}', [AdministrativoController::class, 'questionsUpdate'])->name('pages.question.update');

//         Route::get('/usuarios', [AdministrativoController::class, 'usuarios'])->name('pages.usuarios');
//         Route::get('/perfil-acesso', [AdministrativoController::class, 'perfilAcesso'])->name('pages.perfilacesso');
//         Route::get('/permissao/{permission}', [AdministrativoController::class, 'permission'])->name('pages.permission');

//         Route::get('/errors/error404', [PanelController::class, 'error404'])->name('error404');
//     });
// });
