<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService; // Use your GeminiService
use App\Models\Product; // Your Product model
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; // For string manipulation

class GeminiController extends Controller
{
    protected $geminiService;
    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }
    public function ask(Request $request)
    {
        return view('prompt');
    }
    public function analyze(Request $request)
    {
        // 1. Validate the incoming request
        $validator = Validator::make($request->all(), [
            'symptoms' => 'required|string|min:3|max:2000',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
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
                try {
                    $fileName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('public/symptoms_images', $fileName);
                    $imagePaths[] = Storage::url($path);
                } catch (\Exception $e) {
                    Log::error("Failed to store uploaded image: " . $e->getMessage());
                    // Optionally, you can return an error here or skip the image
                }
            }
        }

        $identifiedSymptoms = [];
        $geminiMedicalAdvice = "Unable to provide preliminary advice at this time.";
        $suggestedRealProducts = [];
        $suggestedVirtualProducts = [];

        try {
            // 3. Analyze symptoms using Gemini (Vision API if images are present)
            if (!empty($imagePaths)) {
                $identifiedSymptoms = $this->geminiService->analyzeDiseaseWithImages($userSymptomsDescription, $imagePaths);
            } else {
                $identifiedSymptoms = $this->geminiService->analyzeDisease($userSymptomsDescription);
            }
            // dd($identifiedSymptoms);
            // If Gemini didn't return any symptoms, handle it gracefully
            if (empty($identifiedSymptoms)) {
                $geminiMedicalAdvice = $this->geminiService->ask(
                    "The user provided symptoms: \"" . $userSymptomsDescription . "\". I couldn't clearly identify specific common medical symptoms. Please provide general, non-diagnostic, preliminary advice. Remind the user that this is not a substitute for professional medical consultation. Keep it concise."
                );
                // Redirect back with an info message but still show the Gemini advice for general health
                return redirect()->back()->with('info', 'We could not pinpoint specific symptoms from your description, but here is some general advice. Please try to be more detailed if you submit again.')->withInput();
            }

            // 4. Get general medical advice from Gemini based on identified symptoms
            $geminiMedicalAdvicePrompt = "Based on the following identified symptoms: " . implode(', ', $identifiedSymptoms) . ". Provide general, non-diagnostic, preliminary advice. Remind the user that this is not a substitute for professional medical consultation. Keep it concise, around 50-80 words.";
            $geminiMedicalAdvice = $this->geminiService->ask($geminiMedicalAdvicePrompt);

            // --- OPTIMIZED PRODUCT MATCHING START ---

            // Normalize identified symptoms to lowercase for case-insensitive matching
            $normalizedIdentifiedSymptoms = array_map('mb_strtolower', $identifiedSymptoms);

            // Fetch products that match ANY of the identified symptoms
            $matchingProducts = Product::where(function ($query) use ($normalizedIdentifiedSymptoms) {
                foreach ($normalizedIdentifiedSymptoms as $symptom) {
                    // Use LIKE for partial text match within JSON array string
                    // This is less efficient than a proper JSON contains query (MySQL 5.7.8+ or PostgreSQL)
                    // but works if the 'solution' column is just a text field storing JSON string.
                    // For better performance with JSON columns, see the note below.
                    $query->orWhereJsonContains('solution', $symptom);
                }
            })->get();
            foreach ($matchingProducts as $product) {
                // Get the solutions array for the current product (already cast to array by Eloquent)
                $productSolutions = $product->solution; // This is now correctly an array

                // Find common symptoms between user's identified symptoms and product's solutions
                $commonSymptoms = array_intersect(
                    $normalizedIdentifiedSymptoms, // Already normalized
                    array_map('mb_strtolower', $productSolutions) // Normalize product solutions
                );

                if (!empty($commonSymptoms)) {
                    $suggestedRealProducts[] = [
                        'product' => $product,
                        'matched_symptoms' => $commonSymptoms,
                        'match_count' => count($commonSymptoms),
                        'is_virtual' => false,
                    ];
                }
            }
            // Sort and limit real products
            usort($suggestedRealProducts, function ($a, $b) {
                return $b['match_count'] <=> $a['match_count'];
            });
            $suggestedRealProducts = array_slice($suggestedRealProducts, 0, 5); // Get top 5
            // --- OPTIMIZED PRODUCT MATCHING END ---

            // 5. Generate virtual product suggestions if real products are scarce or as an alternative
            // You can adjust this condition based on your business logic.
            // For example, always show virtual, or only if real are empty.
            // if (empty($suggestedRealProducts) || count($suggestedRealProducts) < 3) {
            //      $suggestedVirtualProducts = $this->geminiService->generateVirtualProducts($identifiedSymptoms);
            //      // Limit virtual products too if desired
            //      $suggestedVirtualProducts = array_slice($suggestedVirtualProducts, 0, 3);
            // }

            // Combine all suggestions (real products prioritized, then virtual)
            $allSuggestedProducts = array_merge($suggestedRealProducts, $suggestedVirtualProducts);
            // dd($geminiMedicalAdvice);
            return redirect()->route('products.listing.by.symptoms')
                ->with('userSymptomsDescription', $userSymptomsDescription)
                ->with('imagePaths', $imagePaths)
                ->with('identifiedSymptoms', $identifiedSymptoms)
                ->with('geminiMedicalAdvice', $geminiMedicalAdvice)
                ->with('allSuggestedProducts', $allSuggestedProducts);
        } catch (\Exception $e) {
            dd($e);
            Log::error("Disease analysis process failed: " . $e->getMessage() . " on line " . $e->getLine() . " in " . $e->getFile());
            // Provide a user-friendly error message
            return redirect()->back()->with('error', 'We encountered an issue analyzing your symptoms. Please try again later.')->withInput();
        }

        // 6. Return response to the user
        return view('symptom_results', compact(
            'userSymptomsDescription',
            'imagePaths',
            'identifiedSymptoms',
            'geminiMedicalAdvice',
            'allSuggestedProducts' // Pass the combined list
        ));
    }

    /**
     * Display all products, or filter by symptoms if redirected from analysis.
     */
    public function showListing(Request $request)
    {
        // Data passed via ->with() will be available in the session flash data
        $userSymptomsDescription = $request->session()->get('userSymptomsDescription', 'No symptoms reported.');
        $imagePaths = $request->session()->get('imagePaths', []);
        $identifiedSymptoms = $request->session()->get('identifiedSymptoms', []);
        $geminiMedicalAdvice = $request->session()->get('geminiMedicalAdvice', 'No specific advice available.');
        $allSuggestedProducts = $request->session()->get('allSuggestedProducts', []);
        $infoMessage = $request->session()->get('info'); // For info messages from analysis
        // If no products were suggested by the symptom analysis, or if the user
        // directly accesses this page, load all active products.
        if (empty($allSuggestedProducts)) {
            $allSuggestedProducts = Product::where('status', 'active')->get()->map(function ($product) {
                // Format real products similarly for consistent display
                return [
                    'product' => $product,
                    'matched_symptoms' => $product->solution, // Show all solutions if not symptom-matched
                    'match_count' => 0, // No specific match count if showing all
                    'is_virtual' => false,
                ];
            })->toArray();
        }

        return view('product_listing', compact(
            'userSymptomsDescription',
            'imagePaths',
            'identifiedSymptoms',
            'geminiMedicalAdvice',
            'allSuggestedProducts',
            'infoMessage' // Pass info message to view
        ));
    }
}
