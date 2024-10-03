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
        $types = Type::all();
      

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

       // dd(config('constants.property_status'));

        Auth::user()->userAdmin();
        $types = Type::all();

        return Inertia::render('Property/Create', [
            'types' => $types,
            "propertyStatus" => config('constants.property_status')
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


       
        $property = Property::create($request->validated());


        return Redirect::route('properties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        Auth::user()->userAdmin();
        $wallpapers = Wallpaper::all();

        return Inertia::render('Property/Show', [
            'property' => $property->load(['propertyImages']),
            'wallpapers' => $wallpapers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {

        

        Auth::user()->userAdmin();
        $types = Type::all();

        return Inertia::render('Property/Edit', [
            'property' => $property,
            'types' => $types,
            "propertyStatus" => config('constants.property_status')
            
        ]);


     



    }


    public function update(PropertyRequest $request, Property $property)
    {
        Auth::user()->userAdmin();

        $property->update($request->validated());
        $previousImage = $property->img;

        if ($request->img) {

            $path = Storage::disk('public')->put('properties', $request->img);
            $property->img = $path;

            if (!is_null($previousImage)) {
                Storage::disk('public')->delete($previousImage);
            }
        }

        $property->save();
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

    public function images($propertyId)
    {
        Auth::user()->userAdmin();
        $property = Property::find($propertyId);
        return Inertia::render('Property/Images', [
            'property' => $property->load(['propertyImages']),
        ]);
    }

    public function addImage(PropertyImageRequest $request, Property $property)
    {
        Auth::user()->userAdmin();

        if ($request->image) {
            $path = Storage::disk('public')->put('properties', $request->image);
            $propertyImage = new PropertyImage();
            $propertyImage->property_id = $request->property_id;
            $propertyImage->image = $path;
            $propertyImage->save();
        }
        return Redirect::route('properties.images', [$request->property_id]);
    }

    public function deleteImage($imageId)
    {
        Auth::user()->userAdmin();
        $image = PropertyImage::find($imageId);
        $image->delete();
        return Redirect::route('properties.index');
    }

    public function propertyDetail($propertyId)
    {
        $property = Property::find($propertyId);

        return Inertia::render('Showcase/PropertyDetail', [
            'property' => $property->load("propertyImages")
        ]);
    }
}
