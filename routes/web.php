<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;

Route::get('/', function () {
    return view('index');
})->name('index');


//Create Roles


Route::get('roles/create', [RoleController::class,'createAndEditRole'])->name('roles.create');

Route::get('roles' , [RoleController::class , 'fetchRoles'])->name('roles');
Route::get('roles/{id}/toggle' , [RoleController::class , 'toggle'])->name('roles.toggle');
Route::get('roles/{id}/delete', [RoleController::class , 'delete'])->name('roles.delete');

//end of roles

Route::get('users', function() {
    return view('users');
})->name('users');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
