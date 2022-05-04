@extends('layouts.front')

@section('title')
    {{ $category->name }}
@endsection

@section('content')

<div class="py-3 shadow-sm bg-warning border-top">
    <div class=" container">
        <h6 class=" mb-0"> <a class="link-link" href="{{ url('category') }}">Categories</a> / {{ $category->name }} </h6>
    </div>
</div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h4 style="text-align: left">{{ $category->name }}</h4>
                @foreach ($productDetails as $prod)
                @if ($prod->product->category_id == $category->id)
                    <div class="card m-3 link-link" style="width: 12rem;">
                        <a href="{{ url('category/'.$category->slug.'/'.$prod->product->slug) }}" class="link-link">
                            <img class="card-img-top" src="{{ asset('assets/uploads/products/'. $prod->image) }}" alt="Slika proizvoda">
                            <div class="card-body">
                                <p class="card-text">
                                    <b>{{ $prod->product->name }}</b>
                                </p>
                                <p class="card-text">
                                    {{ Str::substr($prod->product->description, 0, 55) }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

@endsection