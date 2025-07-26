<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;

class GeminiController extends Controller
{
    protected $geminiService;
    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }
    public function ask(Request $request)
    {
       $prompt = $request->input('symptoms');
       $response = $this->geminiService->analyzeDisease($prompt);
       dd($response);
    }
}
