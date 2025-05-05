<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $cat_id = request()->get('cat_id', 0);
        $categories = Category::get();
        $stocks = Stock::where('user_id', $id)->get('pro_id');
        if ($cat_id > 0) {
            $products = Product::whereNotIn('id', $stocks)->where ('cat_id', $cat_id)->with('images')->paginate(15);
        }else{
            $products =Product::whereNotIn('id', $stocks)->with('images')->paginate(15);
        }
        return view('frontend.stocks.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function displayed()
    {
        $id = Auth::user()->id;
        $cat_id = request()->get('cat_id', 0);
        if ($cat_id > 0) {
            $stocks = Stock::where('user_id', $id)->where('cat_id', $cat_id)->paginate(15);
        } else {
            $stocks = Stock::where('user_id', $id)->paginate(15);
        }
        $categoryIds = Stock::where('user_id', $id)->pluck('cat_id')->unique();
        $categories = Category::whereIn('id', $categoryIds)->get();
        $proIds = $stocks->pluck('pro_id');
        $products = Product::whereIn('id', $proIds)->with('images')->get();
        return view('frontend.stocks.displayed', compact('products', 'stocks', 'categories'));
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
        $request->validate([
            'stock'      => 'required|integer|min:1',
            'price'      => 'required|numeric|min:1',
            'sale'       => 'nullable|numeric|min:0',
            'max_limit'  => 'nullable|integer|min:1',
            'pro_id'     => 'required|exists:products,id',
            'cat_id'     => 'required|exists:categories,id',
        ]);

        $stock = Stock::create([
            'stock' => $request->stock,
            'price' => $request->price,
            'sale' => $request->sale,
            'max_limit' => $request->max_limit,
            'pro_id' => $request->pro_id,
            'cat_id' => $request->cat_id,
            'user_id' => Auth::user()->id,
            'role_id' => Auth::user()->role_id,

        ]);

        return redirect()->back()->with('add', 'تم إضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $shop = User::where('id', $id)->first();
        $baseQuery = Stock::where('user_id', $id);
        $categoryIds = $baseQuery->pluck('cat_id')->unique();
        $categories = Category::whereIn('id', $categoryIds)->get();

        $cat_id = request()->get('cat_id', 0);
        if ($cat_id > 0) {
            $stocks = $baseQuery->where('cat_id', $cat_id)->get();
        } else {
            $stocks = $baseQuery->get();
        }
        $proIds = $stocks->pluck('pro_id');
        $userId = $id;
        $products = Product::whereIn('id', $proIds)->with('firstImage', 'category', 'stocks')->paginate(15);
        return view('frontend.traders.seller', compact('products', 'stocks', 'shop', 'userId','categories'));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'stock'      => 'required|integer|min:1',
            'price'      => 'required|numeric|min:1',
            'sale'       => 'nullable|numeric|min:0',
            'max_limit'  => 'nullable|integer|min:1',
        ]);
        $stock = Stock::findOrFail($id);
        $stock->update([
            'stock' => $request->stock,
            'price' => $request->price,
            'sale' => $request->sale,
            'max_limit' => $request->max_limit,

        ]);

        return redirect()->back()->with('edit', 'تم تعديل المنتج بنجاح');
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
