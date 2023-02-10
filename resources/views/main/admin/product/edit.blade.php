<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link href="{{ url('css/style.css') }}" rel="stylesheet" />
</head>
<body style="padding: 100px">
<h1 style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">Edit product</h1>
<form method="POST" action="{{ url('admin/products/'.$product['id']) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Name</label>
    <input class="form-control" name="name" value="{{ old('name',$product->name) }}" />
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label>Description</label>
    <textarea class="form-control" name="description">{{ old('description',$product->description) }}</textarea>
    @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label>Price</label>
    <input class="form-control" name="price" type="number" value="{{ old('price',$product->price) }}" />
    @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label>Discount</label>
    <input class="form-control" name="discount" type="number" value="{{ old('discout',$product->discount) }}" step="0.01" />
    @error('discount')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label>Is Recent <input name="is_recent" type="checkbox" {{ old('is_recent'=='ON') ? 'checked' : '' }} /></label>
    <br />
    <label>Is Featured <input name="is_featured" type="checkbox" {{ old('is_featured',$product->is_featured) ? 'checked' : '' }} /></label>
    <br />
    <label>Image</label>
    <input  name="image" type="file" value="{{ old('image',$product->image) }}" />
    @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <label>Category</label>
    <select class="form-control" name="category_id">
        <option>Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
                {{ $category->name }}</option>
              
        @endforeach
        @error('category_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </select>

    <label>Color</label>
    <select class="form-control" name="color_id">
        <option>Select Color</option>
        @foreach ($colors as $color)
            <option value="{{ $color->id }}" {{ old('color_id') == $color['id'] ? 'selected' : '' }}>{{ $color->name }}
            </option>
            @error('color_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
        @endforeach
    </select>

    <label>Size</label>
    <select class="form-control" name="size_id">
        <option>Select Size</option>
        @foreach ($sizes as $size)
            <option value="{{ $size->id }}" {{ old('size_id') == $size['id'] ? 'selected' : '' }}>{{ $size->name }}
            </option>
            @error('size_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
        @endforeach
    </select>

    <button class="btn btn-primary">Edit</button>
    <a class="btn btn-secondary" href="{{ url('admin/products') }}">Cancel</a>
</form>
</body>
</html>