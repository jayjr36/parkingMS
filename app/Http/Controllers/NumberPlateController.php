<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\NumberPlate;
use Intervention\Image\Facades\Image;
use thiagoalessio\TesseractOCR\TesseractOCR;

class NumberPlateController extends Controller
{
    public function showPlates()
    {
        $plates = NumberPlate::orderBy('created_at', 'desc')->get();

        return view('plates', compact('plates'));
    }
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $imagePath = $request->file('image')->store('number-plate-images', 'public');

        // Process the image and extract text from number plate using Tesseract OCR
        $extractedText = $this->extractTextFromImage(storage_path('app/public/' . $imagePath));

        // Store extracted text in the database
        $numberPlate = new NumberPlate();
        $numberPlate->plate_number = $extractedText;
        $numberPlate->save();

        return response()->json(['message' => 'Image uploaded and text extracted successfully']);
    }

    private function extractTextFromImage($imagePath)
    {
        // Use Tesseract OCR to extract text from image
        $text = (new TesseractOCR($imagePath))->run();

        return trim($text); 
    }
}
