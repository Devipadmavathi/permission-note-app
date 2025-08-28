<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController; // Added
use App\Http\Controllers\UserController;     // Added

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public route (welcome page)
Route::get('/', function () {
    return view('welcome');
});

// Authenticated and Verified User Routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Route: This should be the final, effective dashboard route.
    // It passes necessary data (users, roles, permissions) to the dashboard view.
    Route::get('/dashboard', function () {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('dashboard', compact('users', 'roles', 'permissions'));
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource Routes for CRUD operations
    Route::resource('notes', NoteController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class); // Added missing resource route
    Route::resource('users', UserController::class);         // Added missing resource route
});

/*
|--------------------------------------------------------------------------
| Role-Based Routes (Examples)
|--------------------------------------------------------------------------
*/

// Example: Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Example: Editor-only routes
Route::middleware(['auth', 'role:editor'])->group(function () {
    Route::get('/editor', function () {
        return view('editor.dashboard');
    })->name('editor.dashboard');
});

require __DIR__.'/auth.php';

