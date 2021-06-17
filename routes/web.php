<?php

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\Teste;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['can:create_user'])->group(function () {
        Route::get('/invite', [InvitationController::class, 'create'])->name('invitation.create');
        Route::post('/invite', [InvitationController::class, 'store'])->name('invitation.store');
    });

    Route::get('/ticket', [TicketController::class, 'index']);

    Route::middleware(['can:create_ticket'])->group(function () {
        Route::get('/ticket/create', [TicketController::class, 'create']);
        Route::post('/ticket', [TicketController::class, 'store']);
    });

    Route::middleware(['can:edit_ticket'])->group(function () {
        Route::get('/ticket/{ticket}/edit', [TicketController::class, 'edit']);
        Route::put('/ticket/{ticket}/edit', [TicketController::class, 'put']);
        Route::delete('/ticket/{ticket}', [TicketController::class, 'destroy']);
    });

    Route::get('/hello', [Teste::class, 'index']);
});

Route::get('/first-register', function() {
    return view('auth.register');
})->middleware('can:create_admin')->name('setup');


