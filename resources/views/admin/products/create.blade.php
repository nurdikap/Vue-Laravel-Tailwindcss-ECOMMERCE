<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>
<body>
    <form action="{{url('products.store')}}">
    @csrf
    <label for="name">Nombre del producto</label>
    <input type="text" id="name" name="name" placeholder="Nombre del producto">

    <label for="price">Precio del producto</label>
    <input type="text" id="price" name="price" placeholder="Precio del producto">
    
    <label for="discount">Descuento del producto</label>
    <input type="text" id="discount" name="discount" placeholder="Descuento del producto">

    <label for="short_description">Descripción corta</label>
    <input type="text" id="short_description" name="short_description" placeholder="Descripcion corta">

    <label for="description">Descripción del producto</label>
    <input type="text" id="description" name="description" placeholder="Descripcion del producto">

    <label for="reference">Referencia del producto</label>
    <input type="text" id="reference" name="reference" placeholder="Referencia del producto">

    <label for="price">Precio del producto</label>
    <input type="text" id="price" name="price" placeholder="Precio del producto">

    <label for="price">Precio del producto</label>
    <input type="text" id="price" name="price" placeholder="Precio del producto">


    </form>
</body>
</html>