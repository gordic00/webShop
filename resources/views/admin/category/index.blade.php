@extends('layouts.admin')

@section('title')
DzEri - Admin - Kategorije
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Kategorije</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Naziv</th>
                        <th>Opis</th>
                        <th>Slika</th>
                        <th>Opcije</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="desc-css">
                            {{ $string =Str::substr($item->description, 0, 30) }}
                        </td>
                        <td>
                            <img src="{{ asset('assets/uploads/category/'.$item->image) }}" class="cate-image" alt="Image here">
                        </td>
                        <td>
                            <a href="{{ route('categories.edit', $item) }}"class="btn btn-primary">Izmeni</a>
                            <form id="delete-form" method="POST" action="{{ route('categories.destroy', $item) }}">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Obriši</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection