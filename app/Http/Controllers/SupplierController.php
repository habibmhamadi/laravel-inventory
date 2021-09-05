<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
        $suppliers = Supplier::query();
        if($query)
        {
            $suppliers = $suppliers->where('name', 'like', '%'.$query.'%');
        }
        return view('pages.supplier.index')->with([
            'suppliers' => $suppliers->select('id', 'name', 'phone', 'email', 'address')->latest()->paginate(5),
            'query' => $query
        ]);
    }

    public function create()
    {
        return view('pages.supplier.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->validated());
        return redirect()->route('supplier.index')->with([
            'success' => _('Supplier created successfully.')
        ]);
    }

    public function show($id)
    {
        return back();
    }

    public function edit(Supplier $supplier)
    {
        return view('pages.supplier.edit')->with(['supplier' => $supplier]);
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return redirect()->route('supplier.index')->with([
            'success' => _('Supplier updated successfully.')
        ]);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with([
            'success' => _('Supplier deleted successfully.')
        ]);
    }
}
