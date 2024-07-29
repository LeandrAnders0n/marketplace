<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class RecommendationController extends Controller
{
    protected $pythonPath = 'C:\\Users\\Leandra\\AppData\\Local\\Programs\\Python\\Python311\\python.exe'; // Updated path

    public function recommendProducts($productName)
    {
        $process = new Process([$this->pythonPath, base_path('ml_integration/content_based_recommendation.py'), $productName]);
        $process->run();

        if (!$process->isSuccessful()) {
            $errorOutput = $process->getErrorOutput();
            Log::error('Product Recommendation Error: ' . $errorOutput);
            return response()->json(['error' => $errorOutput], 500);
        }

        return response()->json(json_decode($process->getOutput(), true));
    }

    public function predictCategory(Request $request)
    {
        $description = $request->input('description');
        $process = new Process([$this->pythonPath, base_path('ml_integration/category_prediction_model.py'), $description]);
        $process->run();

        if (!$process->isSuccessful()) {
            $errorOutput = $process->getErrorOutput();
            Log::error('Category Prediction Error: ' . $errorOutput);
            return response()->json(['error' => $errorOutput], 500);
        }

        return response()->json(json_decode($process->getOutput(), true));
    }
}
