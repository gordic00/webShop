@extends('layouts.front')

@section('title')
    {{ $product->name }}
@endsection

@section('content')

<div class="py-3 shadow-sm bg-warning border-top">
    <div class=" container">
        <h6 class=" mb-0"><a class="link-link" href="{{ url('category') }}">Categories</a> / <a class="link-link" href="{{ url('view-category',$product->category->slug) }}">{{ $product->category->name }}</a> / {{ $product->name }}</h6>
    </div>
</div>

<div class=" container product_data">
    <div class=" card shadow">
        <div class=" card-body">
            <div class=" row">
                <div class=" col-md-4 border-right">
                    <img class="card-img-top" src="{{ asset('assets/uploads/products/'. $productDetails->image) }}" alt="Slika proizvoda" class=" w100">
                </div>
                <div class=" col-12">

                </div>
                <div class=" col-md-8">
                    <h2 class=" mb-0">
                        {{ $product->name }}
                        @if ($productDetails->trending == '1')
                            <label style="font-size: 16px" class=" float-end badge bg-danger">Trending</label>
                        @endif
                    </h2>
                    <hr>
                    <label class=" me-3">Original Price: <s>$ {{ $productDetails->original_price }} </s></label>
                    <label class=" fw-bold">Selling Price: $ {{ $productDetails->selling_price }} </label>
                    <p class=" mt-3">
                        {{  Str::substr($product->small_description, 0, 400) }}
                    </p>
                    <hr>
                    @if ($productDetails->qty > 0)
                        <label class=" badge bg-success">In stock</label>
                    @else
                        <label class=" badge bg-danger">Out of stock</label>
                    @endif
                    <div class=" row mt-2">
                        <input type="hidden" value="{{ $product->id }}" class="prod_id" name="prod_id">
                        <label for="quantity">Quantity</label>
                        <div class=" input-group text-center mb-3" style="max-width: 155px">
                            <button class=" input-group-text decrement-btn">-</button>
                            <input type="text" name="quantity" class=" form-control text-center qty-input" value="1">
                            <button class=" input-group-text increment-btn">+</button>
                        </div>
                    </div>
                    <div class=" col-md-10">
                        <br>
                        @if ($productDetails->qty > 0)
                            <a href="{{ url('add-to-cart', $productDetails->product->id) }}"><button type="submit" class=" btn btn-success me-3 float-start addToCartBtn">Add to Cart</button></a>
                        @endif
                        <button type="button" class=" btn btn-primary me-3 float-start">Add to Wishlist</button>
                    </div>
                    <a href="{{ url('cart') }}" class="btn btn-outline-primary float-start me-3">My Cart</a>
                </div>
            </div>
            <br>
            <hr>
            <div class=" col-md-12">
                <h3 class=" mb-0">
                    Description
                </h3>
                <p class=" mt-3">
                    {{  $product->description }}
                </p>
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
     });
 </script>
@endsection