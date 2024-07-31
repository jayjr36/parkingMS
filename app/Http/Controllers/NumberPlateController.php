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
        'image' => 'required|string', // Base64 encoded image should be a string
    ]);

    $imageData = $request->input('image');
    $imageParts = explode(";base64,", $imageData);
    $imageType = explode("/", $imageParts[0])[1];
    $imageBase64 = base64_decode($imageParts[1]);
    $imageName = uniqid() . '.' . $imageType;
    $imagePath = 'number-plate-images/' . $imageName;

    Storage::disk('public')->put($imagePath, $imageBase64);

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
