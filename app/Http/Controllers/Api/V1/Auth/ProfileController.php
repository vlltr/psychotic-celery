<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user()->only('name', 'email'));
    }

    public function update(Request $request)
    {
        $validateUserData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user())],
        ]);

        auth()->user()->update($validateUserData);

        return response()->json($validateUserData, Response::HTTP_ACCEPTED);
    }
}
