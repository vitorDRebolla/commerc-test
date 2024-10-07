@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
        @csrf

            <div class="form-group">
                <label for="client_id">Client</label>
                <select class="form-control" id="client_id" name="client_id" required>
                    <option value="">Select a Client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
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
                        <option value="{{ $product->id }}">{{ $product->name }} (${{ $product->price }})</option>
                    @endforeach
                </select>
                @error('product_ids')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">Cancel</a>
        </form>
    </div>
@endsection
