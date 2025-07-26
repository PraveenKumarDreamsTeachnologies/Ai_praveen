<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserDetailsRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserDetailsController extends Controller
{
    public function updateOrCreate(UpdateUserDetailsRequest $request): JsonResponse
    {
        // Generate a random password for new users
        $randomPassword = Str::random(12);

        // Find or create user by email
        $user = User::firstOrNew(['email' => $request->email]);

        // If this is a new user, set the required fields
        if (!$user->exists) {
            $user->password = Hash::make($randomPassword);
            $user->email_verified_at = now(); // Auto-verify since we're creating via API
        }

        // Update all fields that are present in the request
        $user->fill($request->only([
            'name',
            'gender',
            'age',
            'phone',
            'address',
            'height',
            'weight',
            'medical_history',
            'current_medications',
            'allergies'
        ]));

        $user->save();

        $response = [
            'message' => $user->wasRecentlyCreated ? 
                'User created successfully' : 'User details updated successfully',
            'user' => $user->makeHidden(['password', 'remember_token']),
        ];

        if ($user->wasRecentlyCreated) {
            $response['generated_password'] = $randomPassword;
        }

        return response()->json($response);
    }
}