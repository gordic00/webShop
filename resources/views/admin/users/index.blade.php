@extends('layouts.admin')

@section('title')
    Registered Users Page
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Registered Users Page</h4>
        <hr>
    </div>
    <div lass="card-body">
        <table class=" table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Opcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role_as == '0'? 'User' : 'Admin' }}</td>
                    <td>
                        <a href="{{ url('view-user/'. $item->id) }}"class="btn btn-primary btn-sm">View</a>
                    
                        <form id="delete-form" method="POST" action="{{ route('userss.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection