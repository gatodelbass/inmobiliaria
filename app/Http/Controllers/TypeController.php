<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Type;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TypeRequest;
use App\Models\TypeImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TypeImageRequest;
use App\Models\Wallpaper;
use App\Utilities\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->userAdmin();

        $types = Type::orderBy("type")->get();

        return Inertia::render('Type/Index', [
            'types' => $types,
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
        return Inertia::render('Type/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
        Auth::user()->userAdmin();

        $product = Type::create($request->validated());

        if ($request->image != null) {
            $path = Storage::disk('public')->put('types', $request->image);
            $product->img = $path;
            $product->save();
        }

        return Redirect::route('types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $product)
    {
        Auth::user()->userAdmin();
        $wallpapers = Wallpaper::all();

        return Inertia::render('Type/Show', [
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
    public function edit(Type $product)
    {
        Auth::user()->userAdmin();

        $colors = Helper::productColors();

        return Inertia::render('Type/Edit', [
            'record' => $product,
            'colors' => $colors,
        ]);
    }


    public function update(TypeRequest $request, Type $product)
    {
        Auth::user()->userAdmin();

        $product->update($request->validated());
        $previousImage = $product->img;

        if ($request->img) {

            $path = Storage::disk('public')->put('types', $request->img);
            $product->img = $path;

            if (!is_null($previousImage)) {
                Storage::disk('public')->delete($previousImage);
            }
        }

        $product->save();
        return Redirect::route('types.index');
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

        $brand = Type::find($id);
        $brand->delete();

        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->event = "eliminar locomotora";
        $log->message = Auth::user()->name . " (ID " . Auth::user()->id . ") ha eliminado locomotora " . $brand->name . " (ID " . $brand->id . ")";
        $log->save();

        return Redirect::route('types.index');
    }

    public function images($productId)
    {
        Auth::user()->userAdmin();
        $product = Type::find($productId);
        return Inertia::render('Type/Images', [
            'product' => $product->load(['productImages']),
        ]);
    }

    public function addImage(TypeImageRequest $request, Type $product)
    {
        Auth::user()->userAdmin();

        if ($request->image) {
            $path = Storage::disk('public')->put('types', $request->image);
            $productImage = new TypeImage();
            $productImage->product_id = $request->product_id;
            $productImage->image = $path;
            $productImage->save();
        }
        return Redirect::route('types.images', [$request->product_id]);
    }

    public function deleteImage($imageId)
    {
        Auth::user()->userAdmin();
        $image = TypeImage::find($imageId);
        $image->delete();
        return Redirect::route('types.index');
    }

    public function productDetail($productId)
    {
        $product = Type::find($productId);

        return Inertia::render('Showcase/TypeDetail', [
            'product' => $product->load("productImages")
        ]);
    }
}
