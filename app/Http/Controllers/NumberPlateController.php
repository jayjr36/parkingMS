<?php

namespace App\Http\Controllers;


use App\Models\NumberPlate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Intervention\Image\Laravel\Facades\Image;


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
    
        if (count($imageParts) == 2) {
            $imageTypeInfo = explode("/", $imageParts[0]);
    
            if (count($imageTypeInfo) == 2) {
                $imageType = $imageTypeInfo[1];
                $allowedTypes = ['png', 'jpg', 'jpeg', 'gif'];
                if (!in_array($imageType, $allowedTypes)) {
                    return response()->json(['success' => false, 'message' => 'Unsupported image format.'], 400);
                }
    
                if ($imageType === 'jpeg') {
                    $imageType = 'jpg';
                }
    
                $imageBase64 = base64_decode($imageParts[1]);
                $imageName = uniqid() . '.' . $imageType;
                $imagePath = 'number-plate-images/' . $imageName;
    
                // Resize the image
                $image = Image::read($imageBase64)->resize(120, 150);
                $image->save(storage_path('app/public/' . $imagePath));
    
                $extractedText = $this->extractTextFromImage(storage_path('app/public/'.$imagePath));
                if (empty($extractedText)) {
                    $extractedText = 'null';
                }
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
        try {
            $text = new TesseractOCR($imagePath);
    
            $text->lang('eng');
    
            $newtext = $text->run();
    
            // Return null if the extracted text is empty
            return !empty(trim($newtext)) ? trim($newtext) : 'failed extraction';
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return null;
        }
    }
    

    
}
