@extends('layouts.admin')

@section('title')
    Order View Page
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="card-header">
            <h4>Order View: {{ $orders->tracking_no }}
                <a href="{{ route('orders.index') }}" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body row">
            <div class="col-md-6">
                <h4>Shipping Details</h4>
                <hr>
                <label for="" style="font-weight: bold">First Name</label>
                <div class=" border py-2 mb-3">
                    {{ $orders->fname }}
                </div>
                <label for="" style="font-weight: bold">Last Name</label>
                <div class=" border py-2">
                    {{ $orders->lname }}
                </div>
                <label for="" style="font-weight: bold">E-mail</label>
                <div class=" border py-2">
                    {{ $orders->email }}
                </div>
                <label for="" style="font-weight: bold">Phone Number</label>
                <div class=" border py-2">
                    {{ $orders->phone }}
                </div>
                <label for="" style="font-weight: bold">Shipping Address</label>
                <div class=" border py-2">
                    {{ $orders->address2 }}, {{ $orders->city }} {{ $orders->country }} {{ $orders->pincode }}
                </div>
                <label for="" style="font-weight: bold">Status</label>
                <div class=" border py-2">
                    @if ($orders->status == '0')
                        <span>Pending</span>
                    @else
                        <span>Complited</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <h4>Order Details</h4>
                <hr>
                <table class=" table table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders->orderitems as $item)
                            <tr>
                                <td>{{ $item->products->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    <img src="{{ asset('assets/uploads/products/' . $item->products->productDetails[0]['image']) }}" style="max-width: 60px" alt="Product Image">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4 class=" px-2">Total Price: <span class=" float-end">$ {{ $orders->total_price }}</span></h4>
                <div class="mt-5 px-2">
                    <label for="">Order Status</label>
                    <form action="{{ url('update-order/'. $orders->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select class=" custom-select custom-select-lg mb-3 table" name="order_status">
                            <option {{ $orders->status == '0'? 'selected':'' }} value="0">Pending</option>
                            <option {{ $orders->status == '1'? 'selected':'' }} value="1">Complited</option>
                        </select>
                        <button class="btn btn-primary mt-3 float-end" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection