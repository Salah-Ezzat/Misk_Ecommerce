<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Invoice;
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
       
        $count = count($request->stock_ids);
        $product_ids = [];
        $stock_ids = [];
        $quantity = [];

        for ($i = 0; $i < $count; $i++) {
            
            if ($request->quantity[$i] > 0) {
     
                $product_ids[]=$request->product_ids[$i];
                $stock_ids[]=$request->stock_ids[$i];
                $quantity[]=$request->quantity[$i];
            }
        }
        $quantity_assoc = array_combine($product_ids, $quantity);
        $invoice_total = $request->invoice_total;
        $seller = User::where('id', $request->seller_id)->first();
        $stocks = Stock::whereIn('id', $stock_ids)->get();
        $proIds = $product_ids;
        $userId = $request->seller_id;
        $products = Product::whereIn('id', $proIds)->with('firstImage', 'category', 'stocks')->get();
        return view('frontend.orders.confirmOrders', compact('products', 'stocks', 'seller', 'userId', 'quantity_assoc', 'invoice_total'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $seller = User::where('id', $id)->first();
        $stocks = Stock::where('user_id', $id)->get();
        $proIds = $stocks->pluck('pro_id');
        $userId = $id;
        $products = Product::whereIn('id', $proIds)->with('firstImage', 'category', 'stocks')->get();
        return view('frontend.orders.order', compact('products', 'stocks', 'seller', 'userId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function editform($invoice_id)
    // {
    //     $orders = Order::where('invoice_id', $invoice_id)->with('product.product', 'product.pack', 'user', 'invoice', 'stocks', 'product.firstImage')->get();
    //     return view('frontend.orders.confirmOrders', compact('orders'));
    // }

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
            'user_id' => Auth::user()->id,
            'invoice_id' => 5431,
        ]);

        return response()->json(['success' => true]);
    }
}
