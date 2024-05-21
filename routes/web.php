<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;


//Todo
Route::get('/', [TodoController::class, 'show'])->name('index')->middleware('auth');
Route::get('todo/{id}/fetch', [TodoController::class , 'show'])->name('todo.show');
Route::post('todo/create', [TodoController::class,'store'])->name('todo.create');
Route::get('todo/edit', [TodoController::class, 'update'])->name('todo.edit');
Route::get('todo/{id}/delete' , [TodoController::class , 'destroy'])->name('todo.delete');
Route::get('todo/{id}/completeTodo' , [TodoController::class , 'markAsCompleted'])->name('todo.complete');

//End of Todo

//Create Permissions

Route::get('permissions', [PermissionController::class, 'show'])->name('permissions');
Route::get('permissions/{id}/show' , [PermissionController::class, 'show'])->name('permissions.show');
Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::get('permissions/edit', [PermissionController::class, 'update'])->name('permissions.edit');
Route::get('permisions/{id}/delete' , [PermissionController::class , 'delete'])->name('permission.delete');

//End of Permissions

//Create Roles
Route::get('roles/create', [RoleController::class,'createAndEditRole'])->name('roles.create');
Route::get('roles' , [RoleController::class , 'fetchRoles'])->name('roles');
Route::get('roles/{id}/toggle' , [RoleController::class , 'toggle'])->name('roles.toggle');
Route::get('roles/{id}/delete', [RoleController::class , 'delete'])->name('roles.delete');
//end of roles

//User
Route::get('users', [UserController::class , 'fetch'])->name('users')->middleware('auth');
Route::get('users/{id}/toggle' , [UserController::class , 'toggleUser'])->name('users.toggle');
Route::get('user/save' , [UserController::class , 'save'])->name('users.save');
Route::get('user/delete' , [UserController::class , 'deleteUser'])->name('users.delete');
//End of Users

//Login/logout
Route::get('userlogin' , function (){
    return view('userlogin');
})->name('userlogin');
// Route::get('user/login', [UserController::class , 'login'])->name('user.login');
// Route::get('user/logout', [UserController::class , 'logout'])->name('user.logout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
