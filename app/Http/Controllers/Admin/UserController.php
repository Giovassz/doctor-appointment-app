<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only(['create', 'store']);
        $this->middleware('can:users.edit')->only(['edit', 'update']);
        $this->middleware('can:users.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::with('roles')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('id_number', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'id_number' => 'required|string|max:20|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_number' => $request->id_number,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        // Find role for web guard to ensure compatibility
        $role = Role::where('name', $request->role)->where('guard_name', 'web')->first();
        
        if (!$role) {
            $anyRole = Role::where('name', $request->role)->first();
            if ($anyRole) {
                $role = Role::create(['name' => $request->role, 'guard_name' => 'web']);
            }
        }

        if ($role) {
            $user->assignRole($role);
        }

        // Logical split for Patient creation
        if ($request->role === 'Paciente') {
            // Split name into first and last name if possible
            $names = explode(' ', $request->name, 2);
            $firstName = $names[0];
            $lastName = isset($names[1]) ? $names[1] : '';

            \App\Models\Patient::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Usuario y Paciente Creados!',
                'text' => 'El usuario ha sido registrado y se ha creado su ficha de paciente automáticamente.',
            ]);

            return redirect()->route('admin.patients.index');
        }
        if ($request->role === 'Doctor') {
            $doctor = \App\Models\Doctor::create([
                'user_id' => $user->id,
            ]);

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Usuario y Doctor Creados!',
                'text' => 'El usuario ha sido registrado exitosamente. Ahora puedes completar su información de doctor.',
            ]);

            return redirect()->route('admin.doctors.edit', $doctor);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Usuario Creado!',
            'text' => 'El usuario ha sido registrado exitosamente.',
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'id_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required|exists:roles,name',
            'password' => 'nullable|string|confirmed|min:8',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'id_number' => $request->id_number,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);
        $user->syncRoles([$request->role]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'User Updated',
            'text' => 'The user has been updated successfully.',
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('swal', [
                'icon' => 'error',
                'title' => 'Action Forbidden',
                'text' => 'You cannot delete yourself.',
            ]);
        }

        $user->roles()->detach();
        $user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'User Deleted',
            'text' => 'The user has been deleted successfully.',
        ]);

        return redirect()->route('admin.users.index');
    }
}
