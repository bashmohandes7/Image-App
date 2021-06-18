<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('welcome', compact('products'));
    }

    public function store(Request $request)
    {
         $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        //intervention magic happens here, we are resizing the image before saving to db
        $image = Image::make(public_path("storage/{$imagePath}"));
        $image->fit(300, 300);
        $image->save();

        Product::create([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return redirect('/')->with('success', 'Your image has been successfully Uploaded');
    }
}
