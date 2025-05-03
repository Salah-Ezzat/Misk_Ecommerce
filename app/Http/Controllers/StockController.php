<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $stocks = Stock::where('user_id', $id)->get('pro_id');
        $products = Product::whereNotIn('id', $stocks)->with('images')->paginate(15);
        return view('frontend.stocks.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function displayed()
    {
        $id = Auth::user()->id;
        $stocks = Stock::where('user_id', $id)->paginate(15);
        $proIds = $stocks->pluck('pro_id');
        $products = Product::whereIn('id', $proIds)->with('images')->get();
        return view('frontend.stocks.displayed', compact('products', 'stocks'));
    }
    public function comparePrices($pro_id)
    {
        $stocks = Stock::where('pro_id', $pro_id)->paginate(15);
        $userIds = $stocks->pluck('user_id');
        $users = User::whereIn('id', $userIds)->with('image')->get();
        $product = Product::where('id', $pro_id)->with('images')->first();
        return view('frontend.stocks.comparePrices', compact('users', 'stocks', 'product'));
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
        $shop = User::where('id', $id)->first();
        $stocks = Stock::where('user_id', $id)->get();
        $proIds = $stocks->pluck('pro_id');
        $userId= $id;
        $products = Product::whereIn('id', $proIds)->with('firstImage', 'category','stocks')->paginate(15);
        return view('frontend.traders.seller', compact('products', 'stocks', 'shop','userId'));
    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->back()->with('delete', 'تم الحذف بنجاح');
    }
}
