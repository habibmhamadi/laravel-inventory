<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
        $products = Product::query();
        if($query)
        {
            $products = $products->where('name', 'like', '%'.$query.'%');
        }
        return view('pages.product.index')->with([
            'products' => $products->with('measurement', 'supplier')->latest()->paginate(5),
            'query' => $query
        ]);
    }

    public function create()
    {
        return view('pages.product.create')->with([
            'suppliers' => Supplier::select('id', 'name')->orderBy('name')->get(),
            'measurements' => Measurement::select('id', 'name')->orderBy('name')->get()
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('product.index')->with([
            'success' => _('Product created successfully.')
        ]);
    }

    public function show($id)
    {
        return back();
    }

    public function edit(Product $product)
    {
        return view('pages.product.edit')->with([
            'product' => $product,
            'suppliers' => Supplier::select('id', 'name')->orderBy('name')->get(),
            'measurements' => Measurement::select('id', 'name')->orderBy('name')->get()
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('product.index')->with([
            'success' => _('Product updated successfully.')
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with([
            'success' => _('Product deleted successfully.')
        ]);
    }
}
