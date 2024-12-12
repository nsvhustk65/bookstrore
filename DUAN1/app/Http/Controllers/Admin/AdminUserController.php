<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('admins.user.index', compact('users'));
    }

    public function create()
    {
        return view('admins.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' =>Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect()->route('admins.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admins.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admins.user.edit', compact('user'));
    }

    public function update(Request $request,User $user)
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
            'phone' => 'required|digits_between:10,15',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role
        ]);

        return redirect()->route('admins.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user )
    {
        $user->delete();
        return redirect()->route('admins.users.index')->with('success', 'User deleted successfully.');
    }
}
