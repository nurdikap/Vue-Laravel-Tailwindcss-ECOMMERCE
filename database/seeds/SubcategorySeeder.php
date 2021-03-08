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
        $subcategory->description = 'Descripcion martillos';
        $subcategory->image = json_encode(['imagen1']);
        $subcategory->name = 'Martillos';
        $subcategory->category_id = 3;
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->description = 'Descripcion taladros';
        $subcategory->image = json_encode(['imagen1']);
        $subcategory->name = 'Taladros';
        $subcategory->category_id = 2;
        $subcategory->save();
    }
}
