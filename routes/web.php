<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\UserController;
use App\Models\Aluno;

/*
|--------------------------------------------------------------------------
| ROTAS DE AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/

// Cadastro
Route::get('/register', [AuthController::class, 'showCadastro'])->name('register');
Route::post('/register', [AuthController::class, 'cadastroSubmit'])->name('register.submit');

// Login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS (usuário logado)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $totalAlunos = Aluno::count();

        // Últimos 5 alunos cadastrados
        $ultimosAlunos = Aluno::orderBy('created_at', 'desc')->take(5)->get();

        return view('user.dashboard', compact(
            'totalAlunos',
            'ultimosAlunos'
        ));
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | USUÁRIO
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');

    /*
    |--------------------------------------------------------------------------
    | ALUNOS (CRUD)
    |--------------------------------------------------------------------------
    */
    Route::resource('alunos', AlunoController::class);
});