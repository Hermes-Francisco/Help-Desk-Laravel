<?php

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\Teste;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

    Route::get('/ticket', [TicketController::class, 'index']);
    Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');

    Route::middleware(['can:create_user'])->group(function () {
        Route::get('/invite', [InvitationController::class, 'create'])->name('invitation.create');
        Route::post('/invite', [InvitationController::class, 'store'])->name('invitation.store');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');
        Route::put('/users/{user}/recover', [UserController::class, 'recover'])->name('users.recover');
    });

    Route::get('/ticket/{ticket}/', [TicketController::class, 'show'])
        ->name('ticket.show');

        Route::get('/', [TicketController::class, 'index'])
        ->name('dashboard');;

    Route::middleware(['can:edit_ticket'])->group(function () {
        Route::get('/ticket/{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit');
        Route::put('/ticket/{ticket}/edit', [TicketController::class, 'update'])->name('ticket.update');
        //Route::delete('/ticket/{ticket}', [TicketController::class, 'destroy']);
    });

    Route::middleware(['can:create_action'])->group(function () {
        Route::get('/ticket/{ticket}/create_action');
        Route::post('/ticket/{ticket}/create_action');
    });

    Route::get('/hello', [Teste::class, 'index']);
});

Route::get('/first-register', function() {
    return view('auth.register');
})->middleware('can:create_admin')->name('setup');

Route::post('/users/forgot', [UserController::class, 'forgot'])->name('users.forgot');


