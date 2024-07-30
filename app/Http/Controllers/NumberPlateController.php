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
            'card_no' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Store the uploaded image in the 'number-plate-images' directory within the 'public' disk
        $imagePath = $request->file('image')->store('number-plate-images', 'public');
    
        // Process the image and extract text from the number plate using Tesseract OCR
        $extractedText = $this->extractTextFromImage(storage_path('app/public/' . $imagePath));
    
        // Store extracted text, card number, and image path in the database
        $numberPlate = new NumberPlate();
        $numberPlate->plate_number = $extractedText;
        $numberPlate->card_no = $request->input('card_no'); // Save the card number
        $numberPlate->image_path = $imagePath; // Save the image path
        $numberPlate->save();
    
        return response()->json(['success' => true]);
    }
    
    

    private function extractTextFromImage($imagePath)
    {
        // Use Tesseract OCR to extract text from image
        $text = new TesseractOCR($imagePath);

        $text->lang('eng');

        $newtext = $text->run();

        return trim($newtext); 
    }
}
