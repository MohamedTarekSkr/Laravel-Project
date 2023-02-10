
    
@extends('main.admin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/style.css" rel="stylesheet" />
</head>
<body >
<div class="row align-items-center bg-dark py-3 px-xl-5 d-none d-lg-flex" >
            <div class="col-lg-4" >
                <a href="" class="text-decoration-none">
                <span  class="h1 text-uppercase text-dark bg-primary px-2 ml-n1" >multi</span>
                    <span class="h1 text-uppercase text-primary bg-dark px-2">shop</span>
                    
                </a>
            </div>
            <div class="col-lg-4 ">
            <span class=" py-2 h1 text-uppercase text-primary bg-dark px-2">orders page</span>
            </div>
            <div class="col-lg-4 col-6 text-right">
            <span class="h1 text-uppercase text-primary bg-dark px-2">Admin panel</span>
            </div>
        </div>
    </div>
<br>
<br>
@foreach ($orders as $order)
<div style="padding: 5px 0px 0px 250px">
<table class="table table-striped table-dark" >
  <thead>

    <tr >
      <th style=><h5 style='color:yellow'>#Order_Id</h5></th>
      <th style=><h5 style='color:yellow'>User_id</h5></th>
      <th style=><h5 style='color:yellow'>Sub Total</h5></th>
      <th style=><h5 style='color:yellow'>Shipping</h5></th>
      <th style=><h5 style='color:yellow'>Total</h5></th>
      <th style=><h5 style='color:yellow'>Payment method</h5></th>
      
      
        
          

    </tr>
  </thead >
  <tbody >
    <tr>
      <td > <h5 style='color:white'>{{$order['id']}}</td>
        <td > <h5 style='color:white'>{{$order['user_id']}}</td>
          <td ><h5 style='color:white'>{{$order['sub_total']}}</td>
      <td ><h5 style='color:white'>{{$order['shipping']}}</td>
        <td ><h5 style='color:white'>{{$order['total']}}</td>
          <td ><h5 style='color:white'>{{$order['payment']}}</td>
           <td> <form action="{{ url('admin/order/' . $order['id']) }}" method="POST">
              @method('DELETE')
              @csrf
              <button onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
          </form></td>
            

          
          
      </td>
        
        
        

    </tr>
   
  </tbody>
</table>
</div>
@endforeach
<div style="margin: 0 40%">
{!!$orders->links()!!}
</div>
</body>
</html>
@endsection