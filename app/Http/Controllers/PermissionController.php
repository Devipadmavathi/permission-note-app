<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission; // Import the Permission model

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all permissions
        $permissions = Permission::all();
        // Return the 'permissions.index' view, passing the permissions data.
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return the 'permissions.create' view.
        return view('permissions.create');
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
        // 'name' is required and must be unique in the 'permissions' table.
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        // Create a new permission with the validated name.
        Permission::create(['name' => $validated['name']]);

        // Redirect to the permissions index page with a success message.
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        // Find the permission by its ID, or throw a 404 exception if not found.
        $permission = Permission::findOrFail($id);
        // Return the 'permissions.show' view, passing the permission data.
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        // Find the permission by its ID, or throw a 404 exception if not found.
        $permission = Permission::findOrFail($id);
        // Return the 'permissions.edit' view, passing the permission data.
        return view('permissions.edit', compact('permission'));
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
        // 'name' is required and must be unique, except for the current permission's ID.
        $validated = $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
        ]);

        // Find the permission by its ID, or throw a 404 exception if not found.
        $permission = Permission::findOrFail($id);
        // Update the permission's name.
        $permission->name = $validated['name'];
        $permission->save();

        // Redirect to the permissions index page with a success message.
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        // Find the permission by its ID, or throw a 404 exception if not found.
        $permission = Permission::findOrFail($id);
        // Delete the permission.
        $permission->delete();

        // Redirect to the permissions index page with a success message.
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
