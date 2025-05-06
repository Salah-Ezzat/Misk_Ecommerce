<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function filter()
    {
        $users = User::all();
        $sellers = User::whereIn('role_id', [2, 3])->get();
        return view('frontend.evaluations.filter', compact('users', 'sellers'));
    }


    public function evaluation(Request $request)
    {

        $from_date = $request->from_date ?? '1970-01-01';
        $to_date   = $request->to_date ?? date('Y-m-d');
        $status    = $request->status;

        $query = Invoice::query();

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->seller_id) {
            $query->where('seller_id', $request->seller_id);
        }

        switch ($status) {
            case 'منفذة':
                $query->where('done', 1);
                break;
            case 'ملغاة':
                $query->where('done', -1);
                break;
            case 'معلقة':
                $query->where('done', 0)->where('confirm', 1);
                break;
            case 'قيدالتحضير':
                $query->where('done', 0)->where('prepare', 1);
                break;
        }

        $invoices = $query->whereBetween('created_at', [$from_date, $to_date])
            ->with('user', 'seller')
            ->paginate(15)
            ->appends($request->query());

        return view('frontend.evaluations.evaluation', compact('invoices', 'status'));
    }

    public function howMany()
    {
        $sellers = User::whereIn('role_id', [2, 3])->get();
        return view('frontend.evaluations.statistics', compact('sellers'));
    }

    public function statistics(Request $request)
    {
        $sellers = User::whereIn('role_id', [2, 3])->get();

        $request->validate([
            'seller_id' => ['required', 'exists:users,id']
        ]);

        $from_date = $request->from_date ?? '1970-01-01';
        $to_date   = $request->to_date ?? date('Y-m-d');
        $client = User::find($request->seller_id);
        // الاستعلام الأساسي
        $baseQuery = Invoice::where('seller_id', $request->seller_id)
            ->whereBetween('created_at', [$from_date, $to_date]);


        $allInvoices      = $baseQuery->count();
        $invoicesValue    = (clone $baseQuery)->sum('invoice_total');
        $doneInvoices     = (clone $baseQuery)->where('done', 1)->count();
        $doneValue        = (clone $baseQuery)->where('done', 1)->sum('invoice_total');
        $cancelledInvoices = (clone $baseQuery)->where('done', -1)->count();
        $suspendInvoices   = (clone $baseQuery)->where('done', 0)->where('confirm', 1)->count();
        $preparedInvoices  = (clone $baseQuery)->where('done', 0)->where('prepare', 1)->count();
        $differance = $invoicesValue - $doneValue;

        return view('frontend.evaluations.statistics', compact(
            'invoicesValue',
            'doneInvoices',
            'doneValue',
            'cancelledInvoices',
            'suspendInvoices',
            'preparedInvoices',
            'allInvoices',
            'differance',
            'client',
            'sellers'
        ));
    }
}
