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
        $users = User::whereIn('role', ['ADMIN', 'MARIELLE'])->paginate(10);
        return array('users' => $users);
    }

    public function store(Request $request): array
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::default(), 'confirmed'],
            'role' => ['required', 'string', 'in:ADMIN,MARIELLE'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return array('message' => 'Usuário cadastrado com sucesso!');
    }

    public function edit(User $user): array
    {
        return array('user' => User::find($user)->first());
    }

    public function update(Request $request, string $id): array
    {
        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'string', 'in:ADMIN,MARIELLE'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->update();

        return array('message' => 'Usuário atualizado com sucesso!');
    }

    public function destroy(string $id): array
    {
        $user = User::findOrFail($id);

        $user->delete();

        $users = User::whereIn('role', ['ADMIN', 'MARIELLE'])->paginate(10);
        
        return array('users' => $users);
    }
}
