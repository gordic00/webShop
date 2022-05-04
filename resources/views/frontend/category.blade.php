@extends('layouts.front')

@section('title')
    Kategorije
@endsection

@section('content')

<div class="py-3 shadow-sm bg-warning border-top">
    <div class=" container">
        <h6 class=" mb-0"> <a class="link-link" href="{{ url('category') }}">Categories</a> </h6>
    </div>
</div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h4 style="text-align: left">Kategorije</h4>
                @foreach ($category as $cate)
                    <div class="card m-3 link-link" style="width: 12rem;">
                        <a href="{{ url('view-category',$cate->slug) }}" class="link-link">
                            <div class="card-img">
                                <img class="card-img-top" src="{{ asset('assets/uploads/category/'. $cate->image) }}" alt="Slika kategorije">
                            </div>
                            <div class="card-body">
                                
                                <p class="card-text">
                                    {{  Str::substr($cate->description, 0, 55) }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
