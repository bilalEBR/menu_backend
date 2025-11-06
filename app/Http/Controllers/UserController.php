<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{

    use HasApiTokens, Notifiable;
    /**
     * Display a listing of the resource.
     * Maps to: GET /api/users
     */
    public function index(): JsonResponse
    {
        // Fetch all users. For real APIs, always use pagination to limit results.
        $users = User::select('id', 'name', 'email', 'created_at')->paginate(15);

        return response()->json([
            'message' => 'Users retrieved successfully.',
            'data' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * Maps to: POST /api/users
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Define validation rules for creating a new user.
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed', // 'confirmed' checks for 'password_confirmation' field
            ]);

            // Create the user and hash the password before saving.
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return response()->json([
                'message' => 'User created successfully.',
                'data' => $user->only(['id', 'name', 'email'])
            ], 201); // 201 Created status code

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity status code
        }
    }

    /**
     * Display the specified resource.
     * Maps to: GET /api/users/{user}
     */
    public function show(User $user): JsonResponse
    {
        // Route Model Binding handles finding the user.
        return response()->json([
            'message' => 'User retrieved successfully.',
            'data' => $user->only(['id', 'name', 'email', 'created_at'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     * Maps to: PUT/PATCH /api/users/{user}
     */
    public function update(Request $request, User $user): JsonResponse
    {
        try {
            // Validation rules for updating a user. 'email' is ignored for the current user ID.
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            // Fill only validated fields
            $user->fill($validated);

            // Manually hash password if it was provided
            if (isset($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            return response()->json([
                'message' => 'User updated successfully.',
                'data' => $user->only(['id', 'name', 'email'])
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     * Maps to: DELETE /api/users/{user}
     */
    public function destroy(User $user): JsonResponse
    {
        // Deletes the user record from the database.
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.'
        ], 204); // 204 No Content status code
    }
}
