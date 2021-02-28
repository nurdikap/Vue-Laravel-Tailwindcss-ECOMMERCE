<?php

use Illuminate\Database\Seeder;
use App\Attribute;
class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attribute = new Attribute();
        $attribute->name = 'Color';
        $attribute->value = 'Rojo';
        $attribute->save();

        $attribute = new Attribute();
        $attribute->name = 'Color';
        $attribute->value = 'Amarillo';
        $attribute->save();

        $attribute = new Attribute();
        $attribute->name = 'Color';
        $attribute->value = 'Verde';
        $attribute->save();

        $attribute = new Attribute();
        $attribute->name = 'Tamaño';
        $attribute->value = 'Grande';
        $attribute->save();

        $attribute = new Attribute();
        $attribute->name = 'Tamaño';
        $attribute->value = 'Pequeño';
        $attribute->save();

        $attribute = new Attribute();
        $attribute->name = 'Tamaño';
        $attribute->value = 'Mediano';
        $attribute->save();

    }
}
