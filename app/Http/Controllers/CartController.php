<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Http\Request;

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
        //
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
