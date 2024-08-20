<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\StoreRoleRequest;
use Modules\User\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('user::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all(); // Fetch all permissions
        return view('user::roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // Debugging: Log the validated data
        // Log::info('Validated Data:', $validated);

        // Check if 'name' is set in validated data
        if (!isset($validated['name'])) {
            return redirect()->back()->withErrors(['name' => 'The role name is required.']);
        }

        // Create role
        $role = Role::create(['name' => $validated['name']]);

        // Assign permissions
        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }


    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('user::roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all(); // Fetch all permissions
        return view('user::roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $validated = $request->validated();
        $role = Role::findOrFail($id);

        // Update role
        $role->update(['name' => $validated['name']]);

        // Update permissions
        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    /**
     * Reactivate the specified resource.
     */
    public function reactivate($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->restore();

        return redirect()->route('roles.index')->with('success', 'Role reactivated successfully.');
    }

    /**
     * Display a listing of inactive resources.
     */
    public function inactive()
    {
        $roles = Role::onlyTrashed()->get();
        return view('user::roles.inactive', compact('roles'));
    }

    /**
     * Show a specific inactive role.
     */
    public function show_inactive($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        return view('user::roles.show_inactive', compact('role'));
    }
}
