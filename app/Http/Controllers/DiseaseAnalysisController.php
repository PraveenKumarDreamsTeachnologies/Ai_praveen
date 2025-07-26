<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService; // Use your GeminiService
use App\Models\Product; // Your Product model
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // For string manipulation

class DiseaseAnalysisController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    /**
     * Show the form for reporting symptoms.
     */
    public function showSymptomsForm()
    {
        return view('prompt');
    }

    /**
     * Handle the symptom submission, analyze with Gemini, and suggest products.
     */
    public function analyzeSymptoms(Request $request)
    {
        // 1. Validate the incoming request
        $validator = Validator::make($request->all(), [
            'symptoms' => 'required|string|min:20|max:2000',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Added webp
            'images' => 'max:5',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userSymptomsDescription = $request->input('symptoms');
        $uploadedImages = $request->file('images');
        // 2. Store images and get public URLs
        $imagePaths = [];
        if (!empty($uploadedImages)) {
            foreach ($uploadedImages as $image) {
                // Generate a unique file name
                $fileName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                // Store the image in the 'public/symptoms_images' directory
                $path = $image->storeAs('public/symptoms_images', $fileName);
                $imagePaths[] = Storage::url($path); // Get the public URL for the stored image
            }
        }

        // 3. Analyze symptoms using Gemini
        try {
            // Use analyzeDiseaseWithImages if images are present, otherwise analyzeDisease
            // if (!empty($imagePaths)) {
            //     $identifiedSymptoms = $this->geminiService->analyzeDiseaseWithImages($userSymptomsDescription, $imagePaths);
            // } else {
            //     $identifiedSymptoms = $this->geminiService->analyzeDisease($userSymptomsDescription);
            // }
            $identifiedSymptoms = ["cough", "fever", "sore throat", "skin rash"];
            dd($identifiedSymptoms);    
            // If Gemini didn't return any symptoms, you might want to handle it.
            if (empty($identifiedSymptoms)) {
                return redirect()->back()->with('info', 'Could not identify specific symptoms from your description. Please try again with more details.')->withInput();
            }

            // 4. Compare identified symptoms with products table
            $suggestedProducts = [];

            // Fetch all products with their solution arrays
            $allProducts = Product::all();

            foreach ($allProducts as $product) {
                // Get the solutions array for the current product (already cast to array by Eloquent)
                $productSolutions = $product->solution;

                // Find common symptoms between user's identified symptoms and product's solutions
                // Case-insensitive comparison is important here
                $commonSymptoms = array_intersect(
                    array_map('mb_strtolower', $identifiedSymptoms),
                    array_map('mb_strtolower', $productSolutions)
                );

                if (!empty($commonSymptoms)) {
                    // Calculate a score or simply add the product if there's a match
                    $suggestedProducts[] = [
                        'product' => $product,
                        'matched_symptoms' => $commonSymptoms,
                        'match_count' => count($commonSymptoms),
                    ];
                }
            }

            // Sort suggested products by the number of matched symptoms (most relevant first)
            usort($suggestedProducts, function($a, $b) {
                return $b['match_count'] <=> $a['match_count'];
            });

            // You might want to limit the number of suggestions
            $suggestedProducts = array_slice($suggestedProducts, 0, 5); // Get top 5

            // 5. Prepare a user-friendly response from Gemini for the identified symptoms
            // This is separate from the symptom extraction for better conversational tone
            $geminiMedicalAdvicePrompt = "Based on the following identified symptoms: " . implode(', ', $identifiedSymptoms) . ". Provide general, non-diagnostic, preliminary advice. Remind the user that this is not a substitute for professional medical consultation. Keep it concise.";
            $geminiMedicalAdvice = $this->geminiService->ask($geminiMedicalAdvicePrompt);


            // 6. Return response to the user
            return view('symptom_results', compact(
                'userSymptomsDescription',
                'imagePaths',
                'identifiedSymptoms',
                'geminiMedicalAdvice',
                'suggestedProducts'
            ));

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error("Disease analysis failed: " . $e->getMessage() . " on line " . $e->getLine() . " in " . $e->getFile());
            return redirect()->back()->with('error', 'Failed to analyze symptoms. Please try again later. If the issue persists, contact support.')->withInput();
        }
    }
}