<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        return view('pages.cart.index')->with([
            'carts' => Cart::with('product')->latest()->get(),
            'customers' => Customer::select('id', 'name')->orderBy('name')->get()
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if(Cart::where('product_id', $product->id)->first())
        {
            return back()->with(['error' => 'Product already in cart.']);
        }
        if($product->quantity < 1)
        {
            return back()->with(['error' => 'Product out of stock.']);
        }
        $product->carts()->create();
        return back()->with(['success' => 'Product added to cart.']);
    }


    public function increment(Cart $cart)
    {
        $quantity = $cart->product->quantity;
        if($quantity > $cart->quantity)
        {
            $cart->increment('quantity');
            return back();
        }
        $cart->quantity = $quantity;
        if($quantity > 0)
        {
            return back()->with(['error' => 'No more left in stock.']);
        }
        else {
            return back()->with(['error' => 'Product out of stock.']);
        }
    }


    public function decrement(Cart $cart)
    {
        $quantity = $cart->product->quantity;
        if($quantity >= ($cart->quantity - 1))
        {
            if($cart->quantity > 1)
            {
                $cart->decrement('quantity');
            }
            return back();
        }
        $cart->quantity = $quantity;
        if($quantity > 0)
        {
            return back()->with(['error' => 'No more left in stock.']);
        }
        else {
            return back()->with(['error' => 'Product out of stock.']);
        }
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with(['success' => 'Product deleted from cart.']);
    }
}
