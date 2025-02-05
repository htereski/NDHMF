<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminService
{

    public function index(): array
    {
        $users = User::whereIn('role', ['ADMIN', 'DEFENSOR_SOCIAL'])->paginate(10);
        return array('users' => $users);
    }

    public function store(Request $request): void
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::default(), 'confirmed'],
            'role' => ['required', 'string', 'in:ADMIN,DEFENSOR_SOCIAL'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return;
    }

    public function edit(User $user): array
    {
        return array('user' => User::find($user)->first());
    }

    public function update(Request $request, string $id): void
    {
        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'string', 'in:ADMIN,DEFENSOR_SOCIAL'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->update();

        return;
    }

    public function destroy(string $id): array
    {
        $user = User::findOrFail($id);

        $user->delete();

        $users = User::whereIn('role', ['ADMIN', 'DEFENSOR_SOCIAL'])->paginate(10);

        return array('users' => $users);
    }
}
