@extends('layouts.front')

@section('title')
    My Orders
@endsection

@section('content')

<div class="py-3 shadow-sm bg-warning border-top">
    <div class=" container">
        <h6 class=" mb-0"> 
            <a class="link-link" href="{{ url('/') }}">
                Home
            </a> /
            <a class="link-link" href="{{ url('cart') }}">
                My Cart
            </a> / 
            <a class="link-link" href="{{ url('my-orders') }}">
                My Orders
            </a>
        </h6>
    </div>
</div>

    <div class="container py-5">
        <div class="row">
            <div class="card-header">
                <h4>My Orders</h4>
            </div>
            <div class="card-body">
                <table class=" table table-bordered">
                    <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Tracking Number</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->tracking_no }}</td>
                                <td>$ {{ $item->total_price }}</td>
                                <td>{{ $item->status== '0' ? 'pending' : 'complited' }}</td>
                                <td>
                                    <a href="{{ url('view-order/'. $item->id) }}" class=" btn btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class=" px-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

@endsection