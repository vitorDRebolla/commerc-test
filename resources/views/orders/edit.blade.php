@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Order</h1>

        <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

            <div class="form-group">
                <label for="client_id">Client</label>
                <select class="form-control" id="client_id" name="client_id" required>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $client->id == $order->client_id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
                @error('client_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_ids">Products</label>
                <select class="form-control" id="product_ids" name="product_ids[]" multiple required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ in_array($product->id, $selectedProducts) ? 'selected' : '' }}>
                            {{ $product->name }} (${{ $product->price }})
                        </option>
                    @endforeach
                </select>
                @error('product_ids')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


