<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function settings()
    {
        return view('profile.settings', [
            'user' => Auth::user()
        ]);
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'currency' => 'required|in:BRL,USD,EUR',
            'language' => 'required|in:pt-BR,en,es',
            'theme' => 'required|in:light,dark,system'
        ]);

        $user->settings = array_merge($user->settings ?? [], $validated);
        $user->save();

        return redirect()->route('profile.settings')->with('success', 'Configurações atualizadas com sucesso!');
    }
}
