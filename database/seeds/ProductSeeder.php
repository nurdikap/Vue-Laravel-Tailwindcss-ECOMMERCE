<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1;$i<5;$i++){

            $product = new Product();
            $product->name = 'Martillo '.$i;
            $product->slug = 'Martillo-'.$i;
            $product->price = 30000;
            $product->discount = 20000;
            $product->description = 'Martillo marca ingercol larga';
            $product->short_description = 'Martillo corta';
            $product->reference = 'MARTILLO-'.$i;
            $product->subcategory_id = '1';
            $product->look_for_stock = 1;
            $product->images = '["images\/productos\/1615173165_1574182305.png","images\/productos\/1615173165_1574182305.png","images\/productos\/1615173165_1574182323.png","images\/productos\/1615173165_1574182337.png","images\/productos\/1615173165_1574182424.png"]';
            $product->product_type = 'simple';
            $product->stock = 6;
            $product->sold = 2;
            $product->save();
    
            $product = new Product();
            $product->name = 'Taladro '.$i;
            $product->slug = 'Taladro-'.$i;
            $product->price = 30000;
            $product->discount = 20000;
            $product->description = 'Taladro marca ingercol larga';
            $product->short_description = 'Taladro corta';
            $product->reference = 'Taladro-'.$i;
            $product->subcategory_id = '2';
            $product->look_for_stock = 0;
            $product->images = '["images\/productos\/final2.jpg"]';
            $product->product_type = 'simple';
            $product->stock = 6;
            $product->sold = 2;
            $product->save();
        }
    }
}
