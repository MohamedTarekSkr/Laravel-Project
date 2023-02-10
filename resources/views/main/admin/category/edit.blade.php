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
<h1>Add Category</h1>
<form method="POST" action="{{ url('admin/category/'.$category['id']) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Name</label>
    <input class="form-control" name="name" value="{{ old('name',$category->name) }}" />
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input name="image" type="file" /><br />
    @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <button class="btn btn-primary">Add</button>
    <a class="btn btn-secondary" href="{{ url('admin/categories') }}">Cancel</a>
</form>
</body>
</html>