<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Property;
use App\Models\Type;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PropertyRequest;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PropertyImageRequest;
use App\Models\Wallpaper;
use App\Utilities\Helper;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->userAdmin();

        $properties = Property::orderBy("title")->get();
      

        return Inertia::render('Property/Index', [
            'properties' => $properties->load(['type']),
            'types' => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->userAdmin();
        $types = Type::all();
        return Inertia::render('Property/Create', [
            'types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        Auth::user()->userAdmin();

        $product = Property::create($request->validated());

        if ($request->image != null) {
            $path = Storage::disk('public')->put('properties', $request->image);
            $product->img = $path;
            $product->save();
        }

        return Redirect::route('properties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $product)
    {
        Auth::user()->userAdmin();
        $wallpapers = Wallpaper::all();

        return Inertia::render('Property/Show', [
            'product' => $product->load(['productImages']),
            'wallpapers' => $wallpapers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $product)
    {
        Auth::user()->userAdmin();

        $colors = Helper::productColors();

        return Inertia::render('Property/Edit', [
            'record' => $product,
            'colors' => $colors,
        ]);
    }


    public function update(PropertyRequest $request, Property $product)
    {
        Auth::user()->userAdmin();

        $product->update($request->validated());
        $previousImage = $product->img;

        if ($request->img) {

            $path = Storage::disk('public')->put('properties', $request->img);
            $product->img = $path;

            if (!is_null($previousImage)) {
                Storage::disk('public')->delete($previousImage);
            }
        }

        $product->save();
        return Redirect::route('properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->userAdmin();

        $brand = Property::find($id);
        $brand->delete();

        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->event = "eliminar locomotora";
        $log->message = Auth::user()->name . " (ID " . Auth::user()->id . ") ha eliminado locomotora " . $brand->name . " (ID " . $brand->id . ")";
        $log->save();

        return Redirect::route('properties.index');
    }

    public function images($productId)
    {
        Auth::user()->userAdmin();
        $product = Property::find($productId);
        return Inertia::render('Property/Images', [
            'product' => $product->load(['productImages']),
        ]);
    }

    public function addImage(PropertyImageRequest $request, Property $product)
    {
        Auth::user()->userAdmin();

        if ($request->image) {
            $path = Storage::disk('public')->put('properties', $request->image);
            $productImage = new PropertyImage();
            $productImage->product_id = $request->product_id;
            $productImage->image = $path;
            $productImage->save();
        }
        return Redirect::route('properties.images', [$request->product_id]);
    }

    public function deleteImage($imageId)
    {
        Auth::user()->userAdmin();
        $image = PropertyImage::find($imageId);
        $image->delete();
        return Redirect::route('properties.index');
    }

    public function productDetail($productId)
    {
        $product = Property::find($productId);

        return Inertia::render('Showcase/PropertyDetail', [
            'product' => $product->load("productImages")
        ]);
    }
}
