@extends('layouts.admin')

@section('title')
DzEri - Admin - Izmena kategorije
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Izmena kategorije</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Naziv</label>
                        <input type="text" class="form-control alert-light" name="name" value="{{ $category->name }}" id="name" placeholder="Naziv kategorije..." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control alert-light" name="slug" value="{{ $category->slug }}" id="slug" placeholder="Slug..." required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Opis</label><br>
                        <textarea name="description" id="description" rows="3" class="form-control alert-light" required>{{ $category->description }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status - Turned off category</label>
                        <input type="checkbox" {{ $category->status == "1" ? 'checked' : '' }} name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popular">Popularna</label>
                        <input type="checkbox" {{ $category->popular == "1" ? 'checked' : '' }}  name="popular">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_title">Meta Naslov</label>
                        <input type="text" class="form-control alert-light" name="meta_title" value="{{ $category->meta_title }}" id="meta_title" placeholder="meta_naslov..." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_keywords">Meta ključne reči</label>
                        <input type="text" class="form-control alert-light" name="meta_keywords" value="{{ $category->meta_keywords }}" id="meta_keywords" placeholder="meta_ključne_reči..." required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">Meta Opis</label><br>
                        <textarea name="meta_descrip" id="meta_descrip" rows="3" class="form-control alert-light" required>{{ $category->meta_descrip }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="image">Slika</label><br>
                        @if ($category->image)
                            <img src="{{ asset('assets/uploads/category/'. $category->image) }}" style="max-width: 400px" alt="Category image">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control alert-light">
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Izmeni</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection