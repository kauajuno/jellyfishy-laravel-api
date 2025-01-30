<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Image::all()->map(function ($image) {
            return [
                'id' => $image->id,
                'url' => url("storage/$image->path"),
                'label' => $image->label,
            ];
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg'],
            'label' => ['nullable', 'string'],
        ]);

        $path = $request->file('image')->store('images', 'public');
    
        $image = Image::create([
            'path' => $path,
            'label' => $request->label,
        ]);

        return response($image, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return response(null, 204);
    }
}
