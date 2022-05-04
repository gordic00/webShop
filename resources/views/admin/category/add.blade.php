@extends('layouts.admin')

@section('title')
DzEri - Admin - Nova Kategorija
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Nova kategorija</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                        <label for="description">Opis</label><br>
                        <textarea name="description" id="description" rows="3" class="form-control alert-light" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status - Turned off category</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popular">Popularna</label>
                        <input type="checkbox" name="popular">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_title">Meta Naslov</label>
                        <input type="text" class="form-control alert-light" name="meta_title" id="meta_title" placeholder="meta_naslov..." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meta_keywords">Meta ključne reči</label>
                        <input type="text" class="form-control alert-light" name="meta_keywords" id="meta_keywords" placeholder="meta_ključne_reči..." required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">Meta opis</label><br>
                        <textarea name="meta_descrip" id="meta_descrip" rows="3" class="form-control alert-light" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="image">Slika</label><br>
                        <input type="file" name="image" class="form-control alert-light" required>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">
                        <br>
                        <button type="submit" class="btn btn-primary">Napravi</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection