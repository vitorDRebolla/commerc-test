@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $client->name }}</h1>

        <ul>
            <li><strong>Email:</strong> {{ $client->email }}</li>
            <li><strong>Phone:</strong> {{ $client->phone }}</li>
            <li><strong>Birth Date:</strong> {{ $client->birth_date }}</li>
            <li><strong>Address:</strong> {{ $client->address }}</li>
        </ul>

        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
