<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with('client', 'products')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('orders.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'client_id' => $request->client_id,
            'created_at' => now(),
        ]);

        $order->products()->attach($request->product_ids);

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $clients = Client::all();
        $products = Product::all();
        $selectedProducts = $order->products->pluck('id')->toArray();
        return view('orders.edit', compact('order', 'clients', 'products', 'selectedProducts'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update([
            'client_id' => $request->client_id,
        ]);

        $order->products()->sync($request->product_ids);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->products()->detach();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load('client', 'products');
        return view('orders.show', compact('order'));
    }
}

