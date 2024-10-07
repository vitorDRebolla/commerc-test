@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
    @endif

        <div class="row">
            <div class="col-md-6">
                <h3>Price: ${{ number_format($product->price, 2) }}</h3>
            </div>

            <div class="col-md-6">
                @if($product->photo)
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="Product Photo" class="img-thumbnail" width="250">
                @else
                    <p>No Photo Available</p>
                @endif
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
            </form>

            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
        </div>
    </div>
@endsection
