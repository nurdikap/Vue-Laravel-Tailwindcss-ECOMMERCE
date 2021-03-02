<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response(Variation::with('attributes')->orderBy('name')->get());
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Variation::where('id', $id)->with('attributes')->first();
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validateVariation($request);
        $variation = Variation::findOrFail($id);
        $imagenes = $this->saveImagesFromRequest($request);
        $array = $request->all();
        unset($array['image']);
        $variation->update($array);
        $variation->images = json_encode($imagenes);
        $variation->save();
        return $variation->id;
    }
    public function validateVariation($request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'required|string',
            'price' => 'required|numeric',
            'discount' => 'required|numeric|lte:price',
            'reference' => 'required|string',
            'look_for_stock' => 'required|boolean',
            'stock' => 'nullable|numeric',
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variation $variation)
    {
        $variation->delete();
        return response('variation group has been successfully deleted');
    }
}
