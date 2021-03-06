<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Product;
use App\Subcategory;
use App\Variation;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Product::with('variations')->get();
    }

    public function getBySubcategory(Request $request)
    {
        $subcategory = Subcategory::where('name', $request->subcategory)->first();
        if (!$subcategory) return response('Not found', 404);
        return response(Product::where('subcategory_id', $subcategory->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validateProduct($request);
        $product = $this->createProductFromRequest($request);
        //Lets create the variations for the product

        foreach (json_decode($request->input('variations')) as $variation) {
            $db_variation = $this->createVariationFromRequest($request, $product);
            // Attach All Atributes to the current variation 
            foreach ($variation as $attribute) {
                $db_variation->attributes()->attach(json_decode($attribute->id));
            }
        }
        return response($product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response($product);
    }

    public function edit(Product $product)
    {
        $response = $product;
        $response['description'] = json_decode($response['description']);
        $newDescription = '';
        $aux = array_key_last ($response['description']);
        $doNotJump = false;
        foreach ($response['description'] as $key => $arrayItem) {
            $doNotJump = $key == $aux ? true:false;
            foreach ($arrayItem as $key => $value) {
                $newDescription = $doNotJump ? $newDescription.$key . ":" . $value:$newDescription.$key . ":" . $value."\n";
            }
        }
        $response['description'] = $newDescription;
        return response($response);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $this->validateProduct($request, true);
        $array = $request->all();
        unset($array['image']);
        unset($array['description']);
        $product->update($array);
        if ($request->hasFile('image')) {
            $imagenes = $this->saveImagesFromRequest($request);
            $product->images = json_encode($imagenes);
        }
        $product->description = $this->descriptionToJson($request->description);
        $product->save();
        return $product->id;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response('Product has been successfully deleted');
    }


    public function createVariationFromRequest($request, $product)
    {
        $db_variation = new Variation();
        $db_variation->name = $request->name;
        $db_variation->price = $request->price;
        $db_variation->description = $request->description;
        $db_variation->short_description = $request->short_description;
        $db_variation->discount = $request->discount;
        $db_variation->look_for_stock = $request->look_for_stock == 'true' ? 1 : 0;
        $db_variation->stock = $request->stock;
        $db_variation->sold = 0;
        $db_variation->reference = $request->reference;
        $db_variation->images = $product->images;
        $db_variation->product_id = $product->id;
        $db_variation->save();
        $db_variation->reference = $request->reference . '-' . $db_variation->id;
        $db_variation->save();
        return $db_variation;
    }
    public function createProductFromRequest($request)
    {
        $imagenes = $this->saveImagesFromRequest($request);

        $product = new Product();
        $product->name = $request->name;

        $product->description = $this->descriptionToJson($request->description);
        $product->short_description = $request->short_description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->reference = $request->reference;
        $product->look_for_stock = $request->look_for_stock == 'true' ? 1 : 0;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->product_type = $request->product_type;
        $product->subcategory_id = $request->subcategory_id;
        $product->images = json_encode($imagenes);
        $product->save();
        return $product;
    }
    public function descriptionToJson($description)
    {
        $descriptionAux = preg_split('/\r\n|[\r\n]/', $description);
        $description = [];
        foreach ($descriptionAux as $item) {
            $keyValue = explode(':', $item);
            $aux = (object)[
                $keyValue[0] => $keyValue[1]
            ];
            array_push($description, $aux);
        }
        return json_encode($description);
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

    public function validateProduct(Request $request, bool $checkCategories = false)
    {
        if (!$checkCategories) {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'short_description' => 'required|string',
                'price' => 'required|numeric',
                'discount' => 'required|numeric|lte:price',
                'reference' => 'required|string',
                'look_for_stock' => 'required|boolean',
                'stock' => 'nullable|numeric',
                'product_type' => 'required|string',
                'subcategory_id' => 'required|numeric',
                'images' => 'nullable',
            ]);
        } else {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'short_description' => 'required|string',
                'price' => 'required|numeric',
                'discount' => 'required|numeric|lte:price',
                'reference' => 'required|string',
                'look_for_stock' => 'required|boolean',
                'stock' => 'nullable|numeric',
                'images' => 'nullable',
            ]);
        }
    }
}
