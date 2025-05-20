<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Muestra el perfil del usuario autenticado.
     */
    public function index()
    {
        $user = Auth::user();
        return view('profiles.index', compact('user'));
    }

    /**
     * Muestra el formulario para editar el perfil del usuario autenticado.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profiles.edit', compact('user'));
    }

    /**
     * Actualiza el perfil del usuario autenticado.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('profiles.index')->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Elimina la cuenta del usuario autenticado.
     */
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect('/')->with('success', 'Cuenta eliminada exitosamente.');
    }
}
