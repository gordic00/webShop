@extends('layouts.admin')

@section('title')
DzEri - Admin - Izmena Proizvoda
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Izmena Proizvoda</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $products->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12 mb-3">
                    <select class="form-select">
                        <option value="">{{ $products->category->name }}</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Naziv</label>
                        <input type="text" class="form-control alert-light" name="name" id="name" value="{{ $products->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control alert-light" name="slug" id="slug" value="{{ $products->slug }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="small_description">Mali opis</label><br>
                        <textarea name="small_description" id="small_description" rows="2" class="form-control alert-light" required>{{ $products->small_description }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Opis</label><br>
                        <textarea name="description" id="description" rows="3" class="form-control alert-light" required>{{ $products->description }}</textarea>
                    </div>

                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="original_price">Originalna cena</label>
                        <input type="text" class="form-control alert-light" name="original_price" id="original_price" value="{{ $products->productDetails[0]['original_price'] }}" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="selling_price">Prodajna cena</label>
                        <input type="text" class="form-control alert-light" name="selling_price" id="selling_price" value="{{ $products->productDetails[0]['selling_price'] }}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="qty">Kolicina</label>
                        <input type="number" class="form-control alert-light" name="qty" id="qty" value="{{ $products->productDetails[0]['qty'] }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="size">Veličina</label>
                        <input type="text" class="form-control alert-light" name="size" id="tax" value="{{ $products->productDetails[0]['size'] }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="color">Boja</label>
                        <input type="text" class="form-control alert-light" name="color" id="tax" value="{{ $products->productDetails[0]['color'] }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status - Turned off product</label>
                        <input type="checkbox" {{ $products->productDetails[0]['status'] == "1" ? 'checked' : '' }} name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="trending">Trending</label>
                        <input type="checkbox" {{ $products->productDetails[0]['trending'] == "1" ? 'checked' : '' }} name="trending">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_title">Meta naslov</label>
                        <input type="text" class="form-control alert-light" name="meta_title" id="meta_title"  value="{{ $products->productDetails[0]['meta_title'] }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_keywords">Meta ključne reči</label>
                        <input type="text" class="form-control alert-light" name="meta_keywords" id="meta_keywords" value="{{ $products->productDetails[0]['meta_keywords'] }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_description">Meta opis</label><br>
                        <textarea name="meta_description" id="meta_description" rows="2" class="form-control alert-light" required>{{ $products->productDetails[0]['meta_description'] }}</textarea>
                    </div>
                    <div class="col-md-6">
                        @if ($products->productDetails[0]['image'])
                            <img src="{{ asset('assets/uploads/products/'.$products->productDetails[0]['image']) }}" style="max-width: 400px" alt="Product image">
                        @endif
                        <input type="file" name="image" class="form-control alert-light">
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">
                        <br>
                        <button type="submit" class="btn btn-primary">Izmeni</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection