<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // For hashing passwords
use Illuminate\Validation\Rules; // For password validation rules
use Spatie\Permission\Models\Role; // Import the Role model
use Spatie\Permission\Models\Permission; // Import the Permission model

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all users, eagerly loading their roles and permissions for display.
        $users = User::with('roles', 'permissions')->get();
        // Return the 'users.index' view, passing the users data.
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retrieve all available roles and permissions to allow assignment during user creation.
        $roles = Role::all();
        $permissions = Permission::all();
        // Return the 'users.create' view, passing the roles and permissions data.
        return view('users.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data for new user creation.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => ['array'], // Array of role names
            'permissions' => ['array'], // Array of permission names
        ]);

        // Create a new user with the validated data.
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign roles to the user if provided.
        if (!empty($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        }

        // Assign direct permissions to the user if provided.
        if (!empty($validated['permissions'])) {
            $user->syncPermissions($validated['permissions']);
        }

        // Redirect to the users index page with a success message.
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        // Find the user by ID, eagerly loading their roles and permissions.
        $user = User::with('roles', 'permissions')->findOrFail($id);
        // Return the 'users.show' view, passing the user data.
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        // Find the user by ID.
        $user = User::findOrFail($id);
        // Retrieve all available roles and permissions.
        $roles = Role::all();
        $permissions = Permission::all();

        // Get the names of roles and direct permissions currently assigned to this user.
        $userRoles = $user->roles->pluck('name')->toArray();
        $userPermissions = $user->permissions->pluck('name')->toArray();

        // Return the 'users.edit' view, passing the user, all roles, all permissions,
        // and the user's assigned roles/permissions.
        return view('users.edit', compact('user', 'roles', 'permissions', 'userRoles', 'userPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data for user update.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Password is optional on update
            'roles' => ['array'],
            'permissions' => ['array'],
        ]);

        // Find the user by ID.
        $user = User::findOrFail($id);

        // Update user details.
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        // Sync roles to the user.
        if (!empty($validated['roles'])) {
            $user->syncRoles($validated['roles']);
        } else {
            $user->syncRoles([]); // Remove all roles if none are selected
        }

        // Sync direct permissions to the user.
        if (!empty($validated['permissions'])) {
            $user->syncPermissions($validated['permissions']);
        } else {
            $user->syncPermissions([]); // Remove all direct permissions if none are selected
        }

        // Redirect to the users index page with a success message.
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        // Find the user by ID.
        $user = User::findOrFail($id);
        // Delete the user. This also detaches roles and permissions automatically.
        $user->delete();

        // Redirect to the users index page with a success message.
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
