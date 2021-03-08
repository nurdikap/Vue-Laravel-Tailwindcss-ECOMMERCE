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
        $category->icon = 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = true;
        $category->name = 'Carpintería';
        $category->icon = 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = true;
        $category->name = 'Construcción';
        $category->icon = 'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = true;
        $category->name = 'Eléctricos';
        $category->icon = 'M13 10V3L4 14h7v7l9-11h-7z';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = true;
        $category->name = 'Jardinería';
        $category->icon = 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = false;
        $category->name = 'Pinturas y aereosolores';
        $category->icon = 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z';
        $category->save();

        $category = new Category;
        $category->description = 'Descripcion 1';
        $category->image = json_encode(['imagen1']);
        $category->featured = false;
        $category->name = 'Seguridad industrial';
        $category->icon = 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z';
        $category->save();

    }
}
