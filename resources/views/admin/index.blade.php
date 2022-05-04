@extends('layouts.admin')

@section('title')
Dashboard Page
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <h3>{{ Auth::user()->name }}</h3>
        </div>
    </div>

@endsection