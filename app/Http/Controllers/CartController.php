<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
        $invoice = Invoice::create([
            'user_id' => Auth::user()->id,
            'seller_id' => $request->seller_id,
            'invoice_total' => $request->invoice_total
        ]);
        $invoice_id = $invoice->id;
        $count = count($request->stock_ids);
        $product_ids = $request->product_ids;
        $quantity = $request->quantity;
        $prices = $request->prices;
        $previous= $request->previous_url;

        for ($i = 0; $i < $count; $i++) {
            $cart = Cart::create([
                'pro_id' => $product_ids[$i],
                'user_id' => Auth::user()->id,
                'seller_id' => $request->seller_id,
                'quantity' => $quantity[$i],
                'price' => $prices[$i],
                'invoice_id' => $invoice_id,
                'invoice_total' => $request->invoice_total,
            ]);
        }
        return redirect($previous)->with('success', 'تم إرسال طلب الشراء بنجاح.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        session(['previous_previous_url' => url()->current()]);

        $invoice = Invoice::findOrFail($id);
        $carts = Cart::where('invoice_id', $id)->with('product', 'user', 'invoice', 'product.firstImage')->get();

        return view('frontend.invoices.invoice', compact('carts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {


        $cartItems = Cart::where('invoice_id', $id)->delete();
        $invoice_cancell = Invoice::findOrFail($id);
        $invoice_cancell->update([
            'done' => -1
        ]);

        // return redirect()->to(session('previous_previous_url', '/'))
        // ->with('danger', 'تم إلغاء الطلبية .');
        // ارجع للرابط اللي جالك من الباراميتر previous (أو ارجع back)
        $redirectUrl = $request->query('previous', url()->previous());

        return redirect($redirectUrl)->with('danger', 'تم إلغاء الطلبية.');
    }


    public function bulkUpdate(Request $request)
    {

        $count = count($request->cart_ids);

        for ($i = 0; $i < $count; $i++) {
            $cart = Cart::findOrFail($request->cart_ids[$i]);
            $changed = $request->new_total == 0 ? "-1" : ($cart->invoice_total == $request->new_total ? "1" : ($cart->invoice_total < $request->new_total ? "2" : null));

            $cart->update([

                'new_quantity' => $request->new_quantity[$i],
                'new_total' => $request->new_total,
                'changed' => $changed
            ]);
        }
        $invoice = Invoice::findOrFail($cart->invoice_id);
        $invoice->update([
            'done' => 1,
            'real_total' => $request->new_total,
            'edit_cause' => $request->edit_cause,
        ]);

        $previous = $request->input('previous_url');

        return redirect($previous)->with('success', 'تم الانتهاء من تحضير الطلبية بنجاح.');
    }
}
