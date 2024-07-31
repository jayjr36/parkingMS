<?php

namespace App\Http\Controllers;


use App\Models\NumberPlate;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
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
        'image' => 'required|string', 
    ]);

    $imageData = $request->input('image');
    $imageParts = explode(";base64,", $imageData);
    
    // Check if $imageParts has two elements
    if (count($imageParts) == 2) {
        $imageTypeInfo = explode("/", $imageParts[0]);
        
        // Check if $imageTypeInfo has two elements
        if (count($imageTypeInfo) == 2) {
            $imageType = $imageTypeInfo[1];
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
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid image format.'], 400);
        }
    } else {
        return response()->json(['success' => false, 'message' => 'Invalid image format.'], 400);
    }
}

private function extractTextFromImage($imagePath)
{
    $text = new TesseractOCR($imagePath);

    $text->lang('eng');

    $newtext = $text->run();

    return trim($newtext); 
}

}
