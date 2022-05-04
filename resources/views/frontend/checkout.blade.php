@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')

    <div class="py-3 shadow-sm bg-warning border-top">
        <div class=" container">
            <h6 class=" mb-0"> 
                <a class="link-link" href="{{ url('/') }}">
                    Home
                </a> /
                <a class="link-link" href="{{ url('cart') }}">
                    My Cart 
                </a> /
                <a class="link-link" href="{{ url('checkout') }}">
                    Checkout
                </a>
            </h6>
        </div>
    </div>

    <div class="container mt-5">
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="fname">First Name</label>
                                    <input type="text" class=" form-control" id="fname" name="fname" value="{{ Auth::user()->name }}" placeholder="Enter First Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class=" form-control" id="lname" name="lname" value="{{ Auth::user()->lname }}" placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="text" class=" form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Enter Email">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class=" form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" placeholder="Enter Phone Number">
                                </div>
                                <div class="col-md-6">
                                    <label for="address1">Address</label>
                                    <input type="text" class=" form-control" id="address1" name="address1" value="{{ Auth::user()->address1 }}" placeholder="Enter Address">
                                </div>
                                <div class="col-md-6">
                                    <label for="address2">Shipping Address</label>
                                    <input type="text" class=" form-control" id="address2" name="address2" value="{{ Auth::user()->address2 }}" placeholder="Enter Shipping Address">
                                </div>
                                <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" class=" form-control" id="city" name="city" value="{{ Auth::user()->city }}" placeholder="Enter City">
                                </div>
                                <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" class=" form-control" id="country" name="country" value="{{ Auth::user()->country }}" placeholder="Enter Country">
                                </div>
                                <div class="col-md-6">
                                    <label for="pincode">Pin Code</label>
                                    <input type="text" class=" form-control" id="pincode" name="pinCode" value="{{ Auth::user()->pincode }}" placeholder="Enter Pin Code">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h6>Order Details</h6>
                                <hr>
                                @if ($cartitems->count() > 0)
                                @php 
                                    $total = 0; 
                                @endphp
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cartitems as $item)
                                                <tr>
                                                    <td>{{ $item->products->name }}</td>
                                                    <td>{{ $item->prod_qty }}</td>
                                                    <td>$ {{ $item->products->productDetails[0]['selling_price'] }}</td>
                                                </tr>
                                                @php 
                                                    $total += $item->products->productDetails[0]['selling_price'] * $item->prod_qty ; 
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr>
                                        Total price: $ {{ $total }}
                                    <hr>
                                    <button class="btn btn-primary float-end" type="submit">Place Order</button>
                                @else
                                    <h6 class=" text-center">No products in cart.</h6>
                                    <a href="{{ url('category') }}" class="btn btn-outline-primary float-start">Continue Shopping</a><br>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
@endsection
