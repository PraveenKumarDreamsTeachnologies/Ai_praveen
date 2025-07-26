<?php

use App\Http\Controllers\DiseaseAnalysisController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\OpenAIController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prompt', [DiseaseAnalysisController::class, 'showSymptomsForm']);
Route::post('/openai.submit-symptoms', [OpenAIController::class, 'ask'])->name('openai.submit-symptoms');
Route::post('/gemini.submit-symptoms', [GeminiController::class, 'ask'])->name('gemini.submit-symptoms');
Route::post('analyze', [DiseaseAnalysisController::class, 'analyzeSymptoms'])->name('analyze');
