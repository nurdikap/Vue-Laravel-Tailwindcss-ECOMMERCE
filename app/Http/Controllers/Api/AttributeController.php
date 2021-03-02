<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
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
            $variations = DB::table('attributes')->select('value', 'id')->where('name', $value->name)->get();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->deleteRemovedKeys($request->removedIndex);
        $this->keepOldItemsCreateNewOnes($request->input('attributes'));

        return response($request);
    }
    public function deleteRemovedKeys(array $removedIndex){
        if (!$removedIndex) return false;
        foreach ($removedIndex as $index){
            Attribute::destroy($index);
        }
        return true;
    }
    public function keepOldItemsCreateNewOnes(array $attributes){
        if (!$attributes) return false;
        foreach ($attributes as $attribute) {
            $name = $attribute['name'];
            foreach ($attribute['variations'] as $variation) {

                $newAttribute = Attribute::firstOrCreate(
                    ['id' => $variation['id']],
                    ['name' => $name, 'value' => $variation['value']]
                );
            }
        }
        return true;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response('Attribute has been successfully deleted');
    }
}
