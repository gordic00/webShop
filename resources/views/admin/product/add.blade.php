@extends('layouts.admin')

@section('title')
DzEri - Admin - Novi Proizvod
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Novi proizvod</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mb-3">
                    <select class="form-select" name="category_id">
                        @foreach ($category as $item)                            
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Naziv</label>
                        <input type="text" class="form-control alert-light" name="name" id="name" placeholder="Naziv..." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control alert-light" name="slug" id="slug" placeholder="Slug..." required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="small_description">Mali opis</label><br>
                        <textarea name="small_description" id="small_description" rows="2" class="form-control alert-light" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Opis</label><br>
                        <textarea name="description" id="description" rows="3" class="form-control alert-light" required></textarea>
                    </div>
                <!--product details insert -->
                    <div class="col-md-6 mb-3">
                        <label for="original_price">Originalna cena</label>
                        <input type="text" class="form-control alert-light" name="original_price" id="original_price" placeholder="Originalna cena..." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="selling_price">Prodajna cena</label>
                        <input type="text" class="form-control alert-light" name="selling_price" id="selling_price" placeholder="Prodajna cena..." required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="qty">Kolicina</label>
                        <input type="number" class="form-control alert-light" name="qty" id="qty" placeholder="Kolicina..." required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="size">Veličina</label>
                        <input type="text" class="form-control alert-light" name="size" id="tax" placeholder="Veličina...">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="color">Boja</label>
                        <input type="text" class="form-control alert-light" name="color" id="tax" placeholder="Boja..." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status - Turned off product</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="trending">Trending</label>
                        <input type="checkbox" name="trending">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_title">Meta naslov</label>
                        <input type="text" class="form-control alert-light" name="meta_title" id="meta_title" placeholder="Meta naslov..." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_keywords">Meta ključne reči</label>
                        <input type="text" class="form-control alert-light" name="meta_keywords" id="meta_keywords" placeholder="Meta ključne reči..." required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_description">Meta opis</label><br>
                        <textarea name="meta_description" id="meta_description" rows="2" class="form-control alert-light" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="image">Slika</label>
                        <input type="file" name="image" id="image" class="form-control alert-light">
                        <br>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Napravi</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection