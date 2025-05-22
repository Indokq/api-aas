<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|exists:roles,name'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        
        // Sync roles
        $user->syncRoles([$request->role]);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete yourself');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}