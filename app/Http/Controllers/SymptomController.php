<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $symptoms = Symptom::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $symptoms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'severity' => ['required', Rule::in(['mild', 'moderate', 'severe'])],
            'onset' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $symptom = Symptom::create([
            'description' => $validated['description'],
            'severity' => $validated['severity'],
            'onset' => $validated['onset'],
            'notes' => $validated['notes'] ?? null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Symptom recorded successfully',
            'data' => $symptom
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {
        return response()->json([
            'success' => true,
            'data' => $symptom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Symptom $symptom)
    {
        $validated = $request->validate([
            'description' => 'sometimes|required|string|max:255',
            'severity' => ['sometimes', 'required', Rule::in(['mild', 'moderate', 'severe'])],
            'onset' => 'sometimes|required|date',
            'notes' => 'nullable|string'
        ]);

        $symptom->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Symptom updated successfully',
            'data' => $symptom
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();

        return response()->json([
            'success' => true,
            'message' => 'Symptom deleted successfully'
        ]);
    }
}