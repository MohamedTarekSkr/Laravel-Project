@extends('main.admin')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="../css/style.css" rel="stylesheet" />
    </head>

    <body>
        @if (session()->has('message'))
            <div style="margin: 0 10% 0 20%" class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        @if (session()->has('alert'))
            <div style="margin: 0 10% 0 20%" class="alert alert-danger" role="alert">
                {{ Session::get('alert') }}
            </div>
        @endif
        <br>
        <a class="btn btn-primary" href="{{ url('admin/products/create') }}" role="button"
            style="margin: 0px 50%; width:300px;background-color:rgb(246, 223, 18)">ADD PRODUCT</a>
        <?php

foreach ($products as $product){?>
        <div style="padding: 5px 0px 0px 250px">
            <table class="table table-striped table-dark">
                <thead>

                    <tr>
                        <th style=>
                            <h5 style='color:yellow'>#Id</h5>
                        </th>
                        <th style=>
                            <h5 style='color:yellow'>Category</h5>
                        </th>
                        <th style=>
                            <h5 style='color:yellow'>Image</h5>
                        </th>
                        <th style=>
                            <h5 style='color:yellow'>Name</h5>
                        </th>
                        <th style=>
                            <h5 style='color:yellow'>Price</h5>
                        </th>
                        <th style=>
                            <h5 style='color:yellow'>Discount</h5>
                        </th>
                        <th style=>
                            <h5 style='color:yellow'>Color</h5>
                        </th>
                        <th style=>
                            <h5 style='color:yellow'>Size</h5>
                        </th>
                        <th style=>
                            <h5 style='color:yellow'>Recent?</h5>
                        </th>
                        <th style=>
                            <h5 style='color:yellow'>Featured?</h5>
                        </th>



                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h5 style='color:white'>{{ $product['id'] }}
                        </td>
                        <td>
                            <h5 style='color:white'>{{ $product['category']['name'] }}
                        </td>
                        <td><img src="{{ asset('storage/' . $product['image']) }}" alt="" width="70"></td>
                        <td>
                            <h5 style='color:white'>{{ $product['name'] }}
                        </td>
                        <td>
                            <h5 style='color:white'>{{ $product['price'] }}
                        </td>
                        <td>
                            <h5 style='color:white'>{{ $product['discount'] }}
                        </td>
                        <td>
                            <h5 style='color:white'>{{ $product['color']['name'] }}
                        </td>
                        <td>
                            <h5 style='color:white'>{{ $product['size']['name'] }}
                        </td>
                        <td>
                            <h5 style='color:white'>{{ $product['is_recent'] ? 'Yes' : 'No' }}
                        </td>
                        <td>
                            <h5 style='color:white'>{{ $product['is_featured'] ? 'Yes' : 'No' }}
                        </td>
                        <td><br><a style="width: 100px" class="btn btn-primary"
                                href="{{ url('admin/products/' . $product['id'] . '/show') }}"
                                role="button">SHOW</a><br><a style="width: 100px" class="btn btn-primary"
                                href="{{ url('admin/products/' . $product['id'] . '/edit') }}" role="button">EDIT</a><br>
                        </td>
                        <td style="padding: 50px 0px">
                            <form action="{{ url('admin/products/' . $product['id']) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                            </form>
                        </td>




                    </tr>

                </tbody>
            </table>
        </div>
        <?php
}

?>
        {!! $products->links() !!}
        </div>
    </body>

    </html>
@endsection
