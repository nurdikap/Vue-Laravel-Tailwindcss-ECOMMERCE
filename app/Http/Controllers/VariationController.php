<?php

namespace App\Http\Controllers;

use App\Product;
use App\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.admin');

    }
    public function getVariations(){
       
        return Variation::with('attributes')->orderBy('name')->get();

    }
    public function getVariation($variation){
        
        return Variation::where('id',$variation)->with('attributes')->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(Variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function edit(Variation $variation)
    {

        return view('layouts.admin');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variation $variation)
    {
        $imagenes = $this->saveImagesFromRequest($request);
        $array = $request->all();
        unset($array['image']);
        $variation->update($array);
        $variation->images = json_encode($imagenes);
        $variation->save();
        return $variation;

    }
    public function saveImagesFromRequest($request)
    {
        if ($request->hasFile('image')) {
            $imagenes = [];

            foreach ($request->file('image') as $aux) {
                $image = $aux;

                $image_original_name = $image->getClientOriginalName();

                $image_changed_name = str_replace(' ', '-', $image_original_name);
                $image_destination_name = time() . '_' . $image_changed_name;
                $path = 'images/productos';
                $image->move($path, $image_destination_name);
                array_push($imagenes, $path . '/' . $image_destination_name);
            }
            return $imagenes;
        } else {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variation $variation)
    {
        //
    }
}
