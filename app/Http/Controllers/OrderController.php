<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $shop = User::where('id', $id)->first('shop');
        $stocks = Stock::where('user_id', $id)->get();
        $proIds = $stocks->pluck('pro_id');
        $userId= $id;
        $products = Product::whereIn('id', $proIds)->with('firstImage', 'category','stocks')->paginate(15);
        return view('frontend.traders.seller', compact('products', 'stocks', 'shop','userId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // هنا تخزين المنتج في السلة
        Order::create([
            'stock_id' => $validated['stock_id'],
            'quantity' => $validated['quantity'],
            'user_id'=>Auth::user()->id,
            'invoice_id'=>5431,
        ]);

        return response()->json(['success' => true]);
    }
}
