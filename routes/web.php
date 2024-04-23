<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

//User
Route::get('users', [UserController::class , 'fetch'])->name('users');
Route::get('users/{id}/toggle' , [UserController::class , 'toggleUser'])->name('users.toggle');
Route::get('user/save' , [UserController::class , 'save'])->name('users.save');
Route::get('user/delete' , [UserController::class , 'deleteUser'])->name('users.delete');
//End of Users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
