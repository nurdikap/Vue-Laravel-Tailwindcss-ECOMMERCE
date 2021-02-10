<?php

use App\Subcategory;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategory = new Subcategory();
        $subcategory->description = 'Descripcion 1';
        $subcategory->image = json_encode(['imagen1']);
        $subcategory->name = 'Palas';
        $subcategory->category_id = 1;

        $subcategory->save();
    }
}
