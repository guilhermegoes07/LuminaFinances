<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Auth::user()->profiles;
        return response()->json($profiles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:personal,business',
            'initial_balance' => 'required|numeric|min:0',
        ]);

        $profile = Profile::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
            'initial_balance' => $request->initial_balance,
        ]);

        return response()->json($profile, 201);
    }

    public function show(Profile $profile)
    {
        $this->authorize('view', $profile);
        return response()->json($profile);
    }

    public function update(Request $request, Profile $profile)
    {
        $this->authorize('update', $profile);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:personal,business',
            'initial_balance' => 'sometimes|required|numeric|min:0',
        ]);

        $profile->update($request->only(['name', 'type', 'initial_balance']));

        return response()->json($profile);
    }

    public function destroy(Profile $profile)
    {
        $this->authorize('delete', $profile);
        $profile->delete();
        return response()->json(null, 204);
    }
}
