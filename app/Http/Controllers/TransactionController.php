<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
        $transactions = Transaction::query();
        if($query)
        {
            $transactions = $transactions
                ->where('customer_name', 'like', '%'.$query.'%')
                ->orWhere('product_name', 'like', '%'.$query.'%');
        }
        return view('pages.transaction.index')->with([
            'transactions' => $transactions->latest()->paginate(5),
            'query' => $query
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreTransactionRequest $request)
    {
        $customer = Customer::findOrFail($request->customer_id);
        $carts = Cart::with('product')->get();
        if(!$carts->count())
        {
            return back();
        }
        $count = 0;
        foreach ($carts as $cart)
        {
            if($cart->product->quantity > $cart->quantity)
            {
                Transaction::create([
                    'customer_name' => $customer->name,
                    'product_name' => $cart->product->name,
                    'price' => $cart->product->price,
                    'quantity' => $cart->quantity,
                ]);
                $cart->product->decrement('quantity', $cart->quantity);
                $count++;
            }
        }
        Cart::destroy($carts);
        return back()->with($count ? ['success' => 'Transaction success.']
                : ['error' => 'Transaction failed. products are out of stock.']);
    }

    public function report()
    {
        return view('pages.transaction.report')->with([
            'customers' => Transaction::select('customer_name')->distinct()->get(),
            'products' => Transaction::select('product_name')->distinct()->get()
        ]);
    }

    public function createReport(Request $request)
    {
        $customer_name = $request->customer_name;
        $product_name = $request->product_name;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $transactions = Transaction::query();
        if($customer_name)
        {
            $transactions->where('customer_name', $customer_name);
        }
        if($product_name)
        {
            $transactions->where('product_name', $product_name);
        }
        if($from_date)
        {
            $transactions->where('created_at', '>=', $from_date);
        }
        if($to_date)
        {
            $transactions->where('created', '<=', $to_date);
        }

        $pdf = \Barryvdh\DomPDF\Facade::loadView('pages.transaction.report_template', [
            'title' => _('Transaction Report of '.config('app_name', 'Inventory')),
            'date' => date('M d, Y'),
            'transactions' => $transactions->orderBy('created_at')->get()
        ]);
        return $pdf->download('Transaction_Report_'.date('Y-m-d'));
    }
}
