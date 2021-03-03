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
        $category->featured = true;
        $category->name = 'Agrícola';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = true;
        $category->name = 'Carpintería';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = true;
        $category->name = 'Construcción';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = true;
        $category->name = 'Eléctricos';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = true;
        $category->name = 'Jardinería';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = false;
        $category->name = 'Pinturas y aereosolores';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = false;
        $category->name = 'Seguridad industrial';
        $category->save();

    }
}
