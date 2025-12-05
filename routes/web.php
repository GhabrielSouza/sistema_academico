<?php

use App\Http\Controllers\NotasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\DisciplinaController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::resource('turmas', TurmaController::class);
            Route::resource('disciplinas', DisciplinaController::class);
            Route::resource('notas', NotasController::class);
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
        });
    });

    Route::middleware('role:professor')->group(function () {
        Route::get('/professor/notas', [NotasController::class, 'index'])->name('professor.notas');
        Route::put('/professor/notas', [NotasController::class, 'update'])->name('professor.notas.update');
    });

    Route::middleware('role:aluno')->group(function () {
        Route::get('/aluno/notas', [NotasController::class, 'index'])->name('aluno.notas');
    });
});

require __DIR__ . '/auth.php';
