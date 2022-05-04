@extends('layouts.admin')

@section('title')
DzEri - Admin - Proizvodi
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Proizvodi</h4>
            <hr>
        </div>
        <div lass="card-body">
            <table class=" table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Kategorija</th>
                        <th>Naziv</th>
                        <th>Boja</th>
                        <th>Slika</th>
                        <th>Opcije</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td> 
                            {{ $item->productDetails[0]['color'] }}
                        </td>
                        <td> 
                            <img src="{{ asset('assets/uploads/products/'.$item->productDetails[0]["image"]) }}" class="cate-image" alt="Image here"> 
                            <br>
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $item) }}"class="btn btn-primary btn-sm">Izmeni</a>

                            <form id="delete-form" method="POST" action="{{ route('products.destroy', $item) }}">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Obriši</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection