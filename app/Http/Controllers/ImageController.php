<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');
        $imageName = Str::uuid() . "." . $image->extension();
        $imageSavedServer = Image::make($image);
        $imageSavedServer->fit(1000, 1000);

        $imagePath = public_path('uploads') . '/' . $imageName;
        $imageSavedServer->save($imagePath);

        return response()->json(['image' => $imageName]);
    }
}
