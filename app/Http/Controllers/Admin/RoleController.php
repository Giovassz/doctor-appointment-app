<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles.index')->only('index');
        $this->middleware('can:roles.create')->only(['create', 'store']);
        $this->middleware('can:roles.edit')->only(['edit', 'update']);
        $this->middleware('can:roles.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $roles = Role::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.roles.index', compact('roles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $role = Role::firstOrCreate(['name' => $request->name, 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => $request->name, 'guard_name' => 'sanctum']);
        
        if ($request->has('permissions')) {
            // Sync permissions for web role
            $role->syncPermissions($request->permissions);
            
            // Sync for sanctum role (need to find sanctum permissions)
            $sanctumRole = Role::where('name', $request->name)->where('guard_name', 'sanctum')->first();
            if ($sanctumRole) {
                // Assuming permission names are same, we need to find them for sanctum guard
                $permissions = Permission::whereIn('name', $request->permissions)
                                         ->where('guard_name', 'sanctum')
                                         ->get();
                $sanctumRole->syncPermissions($permissions);
            }
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Role Created',
            'text' => 'The role has been created successfully.',
        ]);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
        ]);

        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Role Updated',
            'text' => 'The role has been updated successfully.',
        ]);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->name === 'Admin') {
            return back()->with('swal', [
                'icon' => 'error',
                'title' => 'Action Forbidden',
                'text' => 'You cannot delete the Admin role.',
            ]);
        }

        $role->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Role Deleted',
            'text' => 'The role has been deleted successfully.',
        ]);

        return redirect()->route('admin.roles.index');
    }
}
