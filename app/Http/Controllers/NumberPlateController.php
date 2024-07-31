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
    
        $imagePath = $request->file('image')->store('number-plate-images', 'public');
    
        $extractedText = $this->extractTextFromImage(storage_path('app/public/'. $imagePath));
    
        $numberPlate = new NumberPlate();
        $numberPlate->plate_number = $extractedText;
        $numberPlate->card_no = $request->input('card_no'); 
        $numberPlate->image_path = $imagePath; 
        $numberPlate->save();
    
        return response()->json(['success' => true]);
    }
    
    

    private function extractTextFromImage($imagePath)
    {
        $text = new TesseractOCR($imagePath);

        $text->lang('eng');

        $newtext = $text->run();

        return trim($newtext); 
    }
}
