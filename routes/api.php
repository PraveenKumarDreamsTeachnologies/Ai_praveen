<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\DiseaseAnalysisController;
use App\Http\Controllers\SymptomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('analyze', [DiseaseAnalysisController::class, 'analyzeSymptoms'])->name('analyze')->middleware('cors');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
});
    Route::apiResource('symptoms', SymptomController::class);
Route::apiResource('products', ProductController::class);
