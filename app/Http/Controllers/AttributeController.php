<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $attributes = DB::table('attributes')->select('name')->groupBy('name')->get();
        $final_attributes = $this->convertAttributesToArray($attributes);
        return $final_attributes;
    }
    public function convertAttributesToArray($attributes)
    {

        if (!$attributes) return;
        $final_attributes = array();
        foreach ($attributes as $value) {
            $variations = DB::table('attributes')->select('value','id')->where('name', $value->name)->get();
            $final_variation = [];
            foreach ($variations as $variation) {
                $auxiliary_variation = [
                    'value' => $variation->value,
                    'id' => $variation->id
                ];
                array_push($final_variation, $auxiliary_variation);
            }
            $object = (object)[
                'name' => $value->name,
                'variations' => $final_variation,
                'color' => $this->getRandomColor(),
                
            ];
            array_push($final_attributes, $object);
        }

        return $final_attributes;
    }
    public function getRandomColor()
    {
        return array_rand(array_flip(['red', 'blue', 'green', 'purple', 'yellow']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        foreach ($request->input('attributes') as $attribute) {
            $name = $attribute['name'];
            foreach ($attribute['variations'] as $variation) {
                $newAttribute = Attribute::updateOrCreate(
                    ['name'=>$name , 'value' => $variation]
                );
               
            }
        }
       
        return response($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
