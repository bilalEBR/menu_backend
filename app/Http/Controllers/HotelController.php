<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     * Maps to: GET /api/hotels
     */
    public function index(): JsonResponse
    {
        // Fetch all hotels and paginate them for efficient API performance.
        $hotels = Hotel::paginate(10); 

        return response()->json([
            'message' => 'Hotels retrieved successfully.',
            'data' => $hotels
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * Maps to: POST /api/hotels
     */
    public function store(Request $request): JsonResponse
    {
        // 1. Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100', // Added city as an example field
        ]);
        
        // 2. Create the new Hotel record
        $hotel = Hotel::create($validated);

        // 3. Return 201 Created status
        return response()->json([
            'message' => 'Hotel created successfully.',
            // Return only essential data for the response
            'data' => $hotel->only(['id', 'name', 'address', 'city']) 
        ], 201);
    }

    /**
     * Display the specified resource.
     * Maps to: GET /api/hotels/{hotel}
     */
 // In HotelController.php

public function show($id)
{
    // The query starts at the Hotel model
    $hotel = Hotel::where('id', $id)
        // Eager load the 'categories' relationship, 
        // AND then eagerly load the 'menuItems' relationship WITHIN each category.
        ->with('categories.menuItems') 
        ->firstOrFail();

    return response()->json([
        'data' => $hotel, 
        'message' => 'Hotel details and menus retrieved successfully'
    ], 200);
}

    /**
     * Update the specified resource in storage.
     * Maps to: PUT/PATCH /api/hotels/{hotel}
     */
    public function update(Request $request, Hotel $hotel): JsonResponse
    {
        // 1. Validation rules for updating a hotel. Using 'sometimes' allows for partial PATCH updates.
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:100',
        ]);
        
        // 2. Fill and save the model with only the fields present in $validated
        $hotel->update($validated);
        
        // 3. Return 200 OK status
        return response()->json([
            'message' => 'Hotel updated successfully.',
            'data' => $hotel->only(['id', 'name', 'address', 'city'])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * Maps to: DELETE /api/hotels/{hotel}
     */
    public function destroy(Hotel $hotel): JsonResponse
    {
        // 1. Deletes the hotel record. Laravel Model Deletion handles cascading deletes 
        //    if you set up the foreign key constraint correctly in the migration (e.g., deleting all menu items).
        $hotel->delete();

        // 2. Return 204 No Content status code, as the resource no longer exists.
        return response()->json([
            'message' => 'Hotel deleted successfully.'
        ], 204); 
    }
}
