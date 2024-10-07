@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Management</h1>
        <a href="{{ route('clients.index') }}" class="btn btn-primary">Clients</a>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Products</a>
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Orders</a>
    </div>
@endsection
