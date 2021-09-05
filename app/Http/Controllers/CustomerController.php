<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->query('query');
        $customers = Customer::query();
        if($query)
        {
            $customers = $customers->where('name', 'like', '%'.$query.'%');
        }
        return view('pages.customer.index')->with([
            'customers' => $customers->latest()->paginate(5),
            'query' => $query
        ]);
    }

    public function create()
    {
        return view('pages.customer.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        Customer::create($request->validated());
        return redirect()->route('customer.index')->with([
            'success' => _('Customer created successfully.')
        ]);
    }

    public function show($id)
    {
        return back();
    }

    public function edit(Customer $customer)
    {
        return view('pages.customer.edit')->with(['customer' => $customer]);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return redirect()->route('customer.index')->with([
            'success' => _('Customer updated successfully.')
        ]);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with([
            'success' => _('Customer deleted successfully.')
        ]);
    }
}
