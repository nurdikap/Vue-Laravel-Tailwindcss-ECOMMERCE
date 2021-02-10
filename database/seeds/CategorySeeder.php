<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->name = 'Agrícola';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->name = 'Carpintería';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->name = 'Construcción';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->name = 'Eléctricos';
        $category->save();

    }
}
