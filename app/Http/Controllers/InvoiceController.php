<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
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

        $invoice= Invoice::findOrFail($id);
        $carts= Cart::where('invoice_id', $id)->with('product', 'user', 'invoice', 'product.firstImage')->get();

        return view('frontend.invoices.invoice', compact('carts', 'invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        session(['previous_previous_url' => url()->current()]);
        $invoice= Invoice::findOrFail($id);
        $carts= Cart::where('invoice_id', $id)->with('product', 'user', 'invoice', 'product.firstImage')->get();

        return view('frontend.invoices.edit', compact('carts', 'invoice'));
    }

    public function prepare($id)
    {
        
        $invoice_prepare= Invoice::findOrFail($id);
        $invoice_prepare->update([
            'prepare'=>1
        ]);

        return redirect()->to(route('invoices.edit', $id))
        ->with('success', 'سيتم نقل الفاتورة لقسم فواتير قيد التحضير');
    
    }

    public function confirm($id)
    {
        
        $invoice_confirm= Invoice::findOrFail($id);
        $invoice_confirm->update([
            'confirm'=>1
        ]);

        return redirect()->to(route('invoices.suspendInvoices'))
        ->with('success', 'تم تأكيد الفاتورة بنجاح');
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->back()->with('delete', 'تم الحذف بنجاح');
    }

    public function doneInvoices()
    {
        $invoices= Invoice::where('seller_id', Auth::user()->id)
                          ->where('done', 1)
                          ->with('user', 'seller')
                          ->paginate(15);
        return view('frontend.invoices.doneInvoices', compact('invoices'));
    }

    public function myInvoices()
    {
        $invoices= Invoice::where('user_id', Auth::user()->id)
                          ->where('done', 1)
                          ->with('user', 'seller')
                          ->paginate(15);
        return view('frontend.invoices.myInvoices', compact('invoices'));
    }
    public function cancelledInvoices()
    {
        $invoices= Invoice::where('seller_id', Auth::user()->id)
                          ->where('done', -1)
                          ->with('user', 'seller')
                          ->paginate(15);
        return view('frontend.invoices.cancelledInvoices', compact('invoices'));
    }
    public function preparedInvoices()
    {
        $invoices= Invoice::where('seller_id', Auth::user()->id)
                          ->where('done', 0)
                          ->where('confirm', 1)
                          ->where('prepare', 1)
                          ->with('user', 'seller')
                          ->paginate(15);
        return view('frontend.invoices.preparedInvoices', compact('invoices'));
    }

    public function newInvoices()
    {
        $invoices= Invoice::where('seller_id', Auth::user()->id)
                          ->where('done', 0)
                          ->where('confirm', 1)
                          ->where('prepare', 0)
                          ->with('user', 'seller')
                          ->paginate(15);
        return view('frontend.invoices.newInvoices', compact('invoices'));
    }

    public function suspendInvoices()
    {
        $invoices= Invoice::where('confirm', 0)                          
                          ->with('user', 'seller')
                          ->paginate(15);
        return view('frontend.invoices.suspendInvoices', compact('invoices'));
    }

   
}
