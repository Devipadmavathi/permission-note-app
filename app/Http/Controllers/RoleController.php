<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all roles with their associated permissions eagerly loaded.
        $roles = Role::with('permissions')->get();
        // Return the 'roles.index' view, passing the roles data.
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retrieve all available permissions.
        $permissions = Permission::all();
        // Return the 'roles.create' view, passing the permissions data.
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data.
        // 'name' is required and must be unique in the 'roles' table.
        // 'permissions' is an optional array.
        $validated = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        // Create a new role with the validated name.
        $role = Role::create(['name' => $validated['name']]);

        // If permissions are provided, sync them to the newly created role.
        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        // Redirect to the roles index page with a success message.
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        // Find the role by its ID, or throw a 404 exception if not found.
        $role = Role::findOrFail($id);
        // Retrieve all available permissions.
        $permissions = Permission::all();
        // Get the names of the permissions currently assigned to this role.
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        // Return the 'roles.edit' view, passing the role, all permissions, and the role's assigned permissions.
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
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
        // Validate the incoming request data.
        // 'name' is required and must be unique, except for the current role's ID.
        // 'permissions' is an optional array.
        $validated = $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'array'
        ]);

        // Find the role by its ID, or throw a 404 exception if not found.
        $role = Role::findOrFail($id);
        // Update the role's name.
        $role->name = $validated['name'];
        $role->save();

        // Sync the new set of permissions to the role.
        // If 'permissions' is empty, all permissions will be revoked from the role.
        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        } else {
            // If no permissions are selected, clear all existing permissions for this role.
            $role->syncPermissions([]);
        }

        // Redirect to the roles index page with a success message.
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        // Find the role by its ID, or throw a 404 exception if not found.
        $role = Role::findOrFail($id);
        // Delete the role. This also detaches its permissions automatically.
        $role->delete();

        // Redirect to the roles index page with a success message.
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
