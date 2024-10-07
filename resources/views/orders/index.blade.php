@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
    @endif

        <div class="mb-3">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">New</a>
            <a href="/" class="btn btn-primary">Cancel</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Client</th>
                <th>Products</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->client->name }}</td>
                    <td>
                        <ul>
                            @foreach($order->products as $product)
                                <li>{{ $product->name }} (${{ number_format($product->price, 2) }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
