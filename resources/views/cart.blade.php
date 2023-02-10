<?php use App\Http\Controllers\CartController; ?>
@extends('main.main')
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
      <div class="col-lg-8 table-responsive mb-5">
        <table
          class="table table-light table-borderless table-hover text-center mb-0"
        >
          <thead class="thead-dark">
            <tr>
              <th>
                <input
                  type="text"
                  id="product-name"
                  placeholder="Product Name"
                />
              </th>
              <th><input type="text" id="price" placeholder="Price" /></th>
              <th>
                <input type="text" id="quantity" placeholder="Quantity" />
              </th>
              <th colspan="2"><button>Add</button></th>
            </tr>
            <tr>
              <th>Products</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
              <th>Remove</th>
            </tr>
            @foreach ($lines as $line) 
                
                <tr class="thead-dark" style="font-size: 18px; "><td><img src="{{asset('storage/'.$line['product']['image'])}}" width="40">{{$line['product']['name']}}</td><td>{{'$'.$line['product']['price']-$line['product']['price']*$line['product']['discount']}}</td><td><div class="numOfProducts"><a href="{{url('addproduct/'. $line['product']['id'].'/?minus')}}"><button class="btn btn-primary btn-minus">
                  <i class="fa fa-minus"></i>
              </button></i></a>
  
  </button><span style="padding: 10px; font-size:18px" >{{'  '.$line['quantity'].'  '}}</span>
  <a href="{{url('addproduct/'. $line['product']['id'].'/?plus')}}"><button class="btn btn-primary btn-plus">
    <i class="fa fa-plus"></i>
</button></a>
  </div>
  </td><td>{{'$'.CartController::line_total($line)}}</td><td><a style="color: red" href="{{url('addproduct/'. $line['product']['id'].'/?remove')}}">Remove</a></td></tr>`@endforeach
              </thead>
              <tbody class="align-middle" id="products">
              </tbody>
        </table>
      </div>
      <div class="col-lg-4">
        <form class="mb-30" action="">
          <div class="input-group">
            <input
              type="text"
              class="form-control border-0 p-4"
              placeholder="Coupon Code"
            />
            <div class="input-group-append">
              <button class="btn btn-primary">Apply Coupon</button>
            </div>
          </div>
        </form>
        <h5 class="section-title position-relative text-uppercase mb-3">
          <span class="bg-secondary pr-3">Cart Summary</span>
        </h5>
        <div class="bg-light p-30 mb-5">
          <div class="border-bottom pb-2">
            <div class="d-flex justify-content-between mb-3">
              <h6>Subtotal  </h6>
              <h6 id="sub-total">{{'$'.CartController::sub_total()}}</h6>
            </div>
            <div class="d-flex justify-content-between">
              <h6 class="font-weight-medium">Shipping</h6>
              <h6 class="font-weight-medium" id="shipping">{{'$'.CartController::get_shipping()}}</h6>
            </div>
          </div>
          <div class="pt-2">
            <div class="d-flex justify-content-between mt-2">
              <h5>Total</h5>
              <h5 id="total">{{'$'.CartController::total()}}</h5>
            </div>
            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">
              <a class="btn btn-block btn-primary font-weight-bold " href="{{url('/checkout')}}">Proceed To Checkout</a>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection