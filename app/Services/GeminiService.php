<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function ask(string $prompt): string
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $this->apiKey,
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', [
            'contents' => [
                ['parts' => [
                    ['text' => $prompt]
                ]]
            ]
        ]);
        return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
    }

    /**
     * Analyzes user-provided symptoms to identify potential diseases or key symptoms.
     *
     * @param string $userSymptoms The user's description of their symptoms.
     * @return array An array of identified symptoms/keywords or an empty array.
     */
    public function analyzeDisease(string $userSymptoms): array
    {
        $prompt = "The user describes their symptoms as: \"{$userSymptoms}\". Identify the most relevant single-word or short-phrase symptoms/conditions from this description. Provide these as a comma-separated list, lowercased, with no extra characters or explanations. For example: fever,cough,headache,runny nose.";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $this->apiKey,
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', [ // Using gemini-pro for text analysis
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        $geminiOutput = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';

        // Clean and parse the output into an array of symptoms
        if (!empty($geminiOutput)) {
            // Remove any leading/trailing whitespace and split by comma
            $symptoms = array_map('trim', explode(',', $geminiOutput));
            // Filter out any empty strings that might result from multiple commas
            $symptoms = array_filter($symptoms);
            // Ensure all are lowercase for consistent comparison
            $symptoms = array_map('mb_strtolower', $symptoms);
            return array_values($symptoms); // Re-index array
        }

        return [];
    }

    /**
     * Analyzes user-provided symptoms and images to identify potential diseases or key symptoms.
     *
     * @param string $userSymptoms The user's description of their symptoms.
     * @param array $imageUrls An array of publicly accessible image URLs.
     * @return array An array of identified symptoms/keywords or an empty array.
     */
    public function analyzeDiseaseWithImages(string $userSymptoms, array $imageUrls = []): array
    {
        $parts = [];

        // Add the text part
        $textPrompt = "The user describes their symptoms as: \"{$userSymptoms}\".";
        $textPrompt .= " Based on this description and any provided images, identify the most relevant single-word or short-phrase symptoms/conditions. Provide these as a comma-separated list, lowercased, with no extra characters or explanations. For example: fever,cough,headache,skin rash.";
        $parts[] = ['text' => $textPrompt];

        // Add image parts
        foreach ($imageUrls as $imageUrl) {
            // Gemini Vision API expects image data in base64 or a Google Cloud Storage URI.
            // For simplicity and quick setup, we'll try to convert URLs to base64.
            // In a production environment, consider storing images in GCS and using gs:// URIs,
            // or ensuring your web server directly serves these images for Gemini to fetch.
            // If the image is large, base64 might hit limits.
            try {
                $imageData = base64_encode(file_get_contents($imageUrl));
                $mimeType = mime_content_type($imageUrl); // This might fail if the URL isn't directly accessible
                // A better way to get mime type from URL if file_get_contents is used:
                $info = getimagesize($imageUrl);
                $mimeType = $info['mime'] ?? 'image/jpeg'; // Fallback

                $parts[] = [
                    'inlineData' => [
                        'mimeType' => $mimeType,
                        'data' => $imageData,
                    ],
                ];
            } catch (\Exception $e) {
                // Log error if image conversion fails, but continue without the image.
                \Log::error("Failed to process image for Gemini: " . $e->getMessage() . " URL: " . $imageUrl);
            }
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $this->apiKey,
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', [ // Use gemini-pro-vision for images
            'contents' => [
                ['parts' => $parts]
            ]
        ]);

        $geminiOutput = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';
        if (!empty($geminiOutput)) {
            $symptoms = array_map('trim', explode(',', $geminiOutput));
            $symptoms = array_filter($symptoms);
            $symptoms = array_map('mb_strtolower', $symptoms);
            return array_values($symptoms);
        }

        return [];
    }

    
}
