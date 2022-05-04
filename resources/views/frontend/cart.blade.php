@extends('layouts.front')

@section('title')
    My Cart
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
            </a>
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class=" card-body">
        @if ($cartitems->count() > 0)
            @php 
                $total = 0; 
            @endphp
            @foreach ($cartitems as $item)
                <div class=" row product_data">
                    <div class=" col-md-2">
                        <img src="{{ asset('assets/uploads/products/'. $item->products->productDetails[0]['image']) }}" alt="Product image" style="max-width: 100px">
                    </div>
                    <div class=" col-md-3 my-4">
                        <h4>{{ $item->products->name }}</h4>
                    </div>
                    <div class=" col-md-2 my-4">
                        <h4>$ {{ $item->products->productDetails[0]['selling_price'] }}</h4>
                    </div>
                    <div class=" col-md-3">
                        <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                        @if ($item->products->productDetails[0]['qty'] >= $item->prod_qty)
                            <label for="quantity">Quantity</label>
                            <div class=" input-group text-center mb-3" style="max-width: 135px">
                                <button class=" input-group-text changeQuantity decrement-btn">-</button>
                                <input type="text" name="quantity" class=" form-control text-center qty-input" value="{{ $item->prod_qty }}">
                                <button class=" input-group-text changeQuantity increment-btn">+</button>
                            </div>
                            @php 
                                $total += $item->products->productDetails[0]['selling_price'] * $item->prod_qty ; 
                            @endphp
                        @else
                            <h6 class=" my-4">Out of Stock</h6>
                        @endif
                        
                    </div>
                    <div class=" col-md-2 my-4"> 
                        <button class=" btn btn-danger delete-cart-item">Remove</button>
                    </div>
                </div>
            @endforeach
        @else
            <h4>
                You have not added any products to your shopping cart.
                <a href="{{ url('category') }}" class="btn btn-outline-primary float-end">Continue Shopping</a><br>
            </h4>
        @endif
    </div>
    <div class="card-footer">
        @if ($cartitems->count() > 0)
            <h6>Total price: $ {{ $total }} 
                <a href="{{ url('checkout') }}"><button class="btn btn-outline-success float-end">Proceed to Checkout</button></a>
            </h6>
        @else
        <h6>Total price: $ 0 </h6>
        @endif
    </div>
</div>

@endsection

@section('scripts')
    <script>
       
       $('.addToCartBtn').click(function (e) { 
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty =  $(this).closest('.product_data').find('.qty-input').val();

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/add-to-cart",
            data: {
                'product_id' : product_id,
                'product_qty' :product_qty,
            },
            success: function (response) {
                swal(response.status);
                }
            });
        });

        $(document).ready(function () {
            $('.increment-btn').click(function (e) { 
                e.preventDefault();
                
                //var inc_value = $('.qty-input').val();
                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value < 10)
                {
                    value++;
                    //$('.qty-input').val(value);
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });

            $('.decrement-btn').click(function (e) { 
                e.preventDefault();
                
                //var dec_value = $('.qty-input').val();
                var dec_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1)
                {
                    value--;
                    //$('.qty-input').val(value);
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });

            $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        
            $('.delete-cart-item').click(function (e) { 
                e.preventDefault();
                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                $.ajax({
                    method: "POST",
                    url: "/delete-cart-item",
                    data: {
                        'prod_id' : prod_id,
                    },
                    success: function (response) {
                        swal("", response.status,"success");
                        window.location.reload();
                    }
                });
            });

            $('.changeQuantity').click(function (e) { 
                e.preventDefault();

                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                var qty = $(this).closest('.product_data').find('.qty-input').val();
                data = {
                    'prod_id' : prod_id,
                    'prod_qty' : qty,
                }

                $.ajax({
                    method: "POST",
                    url: "update-cart",
                    data: data,
                    success: function (response) {
                        window.location.reload();
                    }
                });

            });
        
        });
    </script>
@endsection
