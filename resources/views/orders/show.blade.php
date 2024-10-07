@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order Details</h1>

        <h3>Client: {{ $order->client->name }}</h3>
        <p><strong>Email:</strong> {{ $order->client->email }}</p>
        <p><strong>Phone:</strong> {{ $order->client->phone }}</p>

        <h4>Order Date: {{ $order->created_at->format('d/m/Y H:i') }}</h4>

        <h4>Products:</h4>
        <ul>
            @foreach($order->products as $product)
                <li>{{ $product->name }} - ${{ number_format($product->price, 2) }}</li>
            @endforeach
        </ul>

        <div class="mt-3">
            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
            </form>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>
@endsection
