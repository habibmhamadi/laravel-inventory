<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMeasurementRequest;
use App\Http\Requests\UpdateMeasurementRequest;
use App\Models\Measurement;

class MeasurementController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');
        $measurements = Measurement::query();
        if($query)
        {
            $measurements = $measurements->where('name', 'like', '%'.$query.'%');
        }
        return view('pages.measurement.index')->with([
            'measurements' => $measurements->select('id', 'name')->latest()->paginate(5),
            'query' => $query
        ]);
    }

    public function create()
    {
        return view('pages.measurement.create');
    }

    public function store(StoreMeasurementRequest $request)
    {
        Measurement::create($request->validated());
        return redirect()->route('measurement.index')->with([
            'success' => _('Measurement created successfully.')
        ]);
    }

    public function show($id)
    {
        return back();
    }

    public function edit(Measurement $measurement)
    {
        return view('pages.measurement.edit')->with(['measurement' => $measurement]);
    }

    public function update(UpdateMeasurementRequest $request, Measurement $measurement)
    {
        $measurement->update($request->validated());
        return redirect()->route('measurement.index')->with([
            'success' => _('Measurement updated successfully.')
        ]);
    }

    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return redirect()->route('measurement.index')->with([
            'success' => _('Measurement deleted successfully.')
        ]);
    }
}
