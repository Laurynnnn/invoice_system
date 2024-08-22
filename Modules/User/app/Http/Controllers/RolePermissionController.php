<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\StoreRoleRequest;
use Modules\User\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\User\Models\PermissionCategory; // Make sure this is imported

class RolePermissionController extends Controller
{
    // public function __construct()
    // {
    //     // Apply middleware for user management permissions
    //     $this->middleware('permission:manage users', ['only' => ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']]);
    //     $this->middleware('permission:assign roles', ['only' => ['assignRole']]);
    //     $this->middleware('permission:assign permissions', ['only' => ['assignPermission']]);
    // }
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
        // Fetch all permission categories with their permissions
        $categories = PermissionCategory::with('permissions')->get();
        return view('user::roles.create', compact('categories')); // Pass categories to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();

        if (!isset($validated['name'])) {
            return redirect()->back()->withErrors(['name' => 'The role name is required.']);
        }

        $role = Role::create(['name' => $validated['name']]);

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
        $categories = PermissionCategory::with('permissions')->get(); // Fetch categories with permissions
        return view('user::roles.show', compact('role', 'categories')); // Pass categories to the view
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $categories = PermissionCategory::with('permissions')->get(); // Fetch all permission categories with their permissions
        return view('user::roles.edit', compact('role', 'categories')); // Pass categories to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $validated = $request->validated();
        $role = Role::findOrFail($id);

        $role->update(['name' => $validated['name']]);

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
