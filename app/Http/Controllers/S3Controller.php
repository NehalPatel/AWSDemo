<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class S3Controller extends Controller
{
    public function upload(Request $request)
    {
        $images = Image::get();
        return view('upload', ['images' => $images]);
    }

    public function store(Request $request)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            // dd($filename);

            $file->storeAs($filename, 's3');

            $url = Storage::disk('s3')->url($filename);

            Image::create([
                'image_name' => $filename,
                'image_path' => $url
            ]);

            return redirect()->back()->with('message', 'The image saved successfully.');
        }

        return redirect()->back()->with('message', 'No image found.');
    }

    public function show(Image $image)
    {
        return Storage::disk('s3')->response($image->image_name);
    }
}
