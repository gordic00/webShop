@extends('layouts.front')

@section('title')
    Wishlist
@endsection

@section('content')

<div class="py-3 shadow-sm bg-warning border-top">
    <div class=" container">
        <h6 class=" mb-0"> 
            <a class="link-link" href="{{ url('/') }}">
                Home
            </a> /
            <a class="link-link" href="{{ url('wishlist') }}">
                Wishlist
            </a>
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">
            @if($wishlist->count() > 0)
                @foreach ($wishlist as $item)
                    <div class=" row product_data">
                        <div class=" col-md-2">
                            <img src="{{ asset('assets/uploads/products/'. $item->products->productDetails[0]['image']) }}" alt="Product image" style="max-width: 100px">
                        </div>
                        <div class=" col-md-2 my-4">
                            <h4>{{ $item->products->name }}</h4>
                        </div>
                        <div class=" col-md-2 my-4">
                            <h4>$ {{ $item->products->productDetails[0]['selling_price'] }}</h4>
                        </div>
                        <div class=" col-md-2">
                            <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                            @if ($item->products->productDetails[0]['qty'] > 0)
                                <label for="quantity">Quantity</label>
                                <div class=" input-group text-center mb-3" style="max-width: 135px">
                                    <button class=" input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" class=" form-control text-center qty-input" value="1">
                                    <button class=" input-group-text increment-btn">+</button>
                                </div>
                            @else
                                <h6 class=" my-4">Out of Stock</h6>
                            @endif
                            
                        </div>
                        <div class=" col-md-2 my-4"> 
                            @if ($item->products->productDetails[0]['qty'] > 0)
                                <button class=" btn btn-success addToCartBtn delete-wishlist-item">Add To Cart</button>
                            @endif
                        </div>
                        <div class=" col-md-2 my-4"> 
                            <button class=" btn btn-danger delete-wishlist-item">Remove</button>
                        </div>
                    </div>
                @endforeach
            @else
                <h4>
                    You have not added any products to your Wishlist.
                    <a href="{{ url('category') }}" class="btn btn-outline-primary float-end">Continue Shopping</a><br>
                </h4>
            @endif
        </div>
    </div>
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
        
            $('.delete-wishlist-item').click(function (e) { 
                e.preventDefault();
                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                $.ajax({
                    method: "POST",
                    url: "/delete-wishlist-item",
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