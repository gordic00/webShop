@extends('layouts.front')

@section('title')
    Welcome to Dzeri E-shop
@endsection

@section('content')
    @include('layouts.inc.slider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h4 style="text-align: left">Top proizvodi</h4>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($featured_products as $prod)
                        <div class="item">
                            <a href="{{ url('category/'. $prod->product->category->slug.'/'.$prod->product->slug) }}" class="link-link">
                                <div class="card" style="height: 370px">
                                    <div>
                                        <img src="{{ asset('assets/uploads/products/'. $prod->image) }}" alt="Slika proizvoda">
                                    </div>
                                    <div class="card-body">
                                        <h5>{{ $prod->product->name }}</h5>
                                        <span>Boja: </span>
                                        <span>{{ $prod->color }}</span>
                                        <br>
                                        
                                        <span class="float-start">Zalihe: </span>
                                        <span> {{ $prod->qty }} kom.</span>
                                        @if ($prod->size)
                                            <span> - {{ $prod->size }}</span>
                                        @endif
                                        <br>
                                        <br>
                                        <span class="float-start">Cena: <b> {{ $prod->selling_price }} eura</b></span>
                                        <br>
                                        <span class="float-start"><s>Stara cena: {{ $prod->original_price }} eura</s></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h4 style="text-align: left">Kategorije u trendingu</h4>
                <div class="owl-carousel popular-carousel owl-theme">
                    @foreach ($trending_category as $cate)
                        <div class="item">
                            <a href="{{ url('view-category',$cate->slug) }}" class=" link-link">
                                <div class="card">
                                    <div>
                                        <img src="{{ asset('assets/uploads/category/'. $cate->image) }}" alt="Sliak kategorije">
                                    </div>
                                    <div class="card-body">
                                        <h5>{{ $cate->name }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
        $('.popular-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>
@endsection