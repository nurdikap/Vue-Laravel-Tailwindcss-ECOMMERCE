<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('admin/products')}}" 
    enctype="multipart/form-data"
    method="post">
    @csrf
    <input type="file" multiple name="image[]" id="">
    <button type="submit"></button>    
</form>
</body>
</html>