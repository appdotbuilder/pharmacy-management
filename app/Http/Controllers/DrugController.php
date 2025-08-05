<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDrugRequest;
use App\Http\Requests\UpdateDrugRequest;
use App\Models\Drug;
use Inertia\Inertia;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drugs = Drug::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('generic_name', 'like', "%{$search}%")
                      ->orWhere('brand', 'like', "%{$search}%");
            })
            ->when(request('category'), function ($query, $category) {
                $query->where('category', $category);
            })
            ->when(request('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('name')
            ->paginate(20);

        $categories = Drug::distinct()->pluck('category')->sort()->values();

        return Inertia::render('drugs/index', [
            'drugs' => $drugs,
            'categories' => $categories,
            'filters' => request()->only(['search', 'category', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Drug::distinct()->pluck('category')->sort()->values();
        
        return Inertia::render('drugs/create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDrugRequest $request)
    {
        $drug = Drug::create($request->validated());

        return redirect()->route('drugs.show', $drug)
            ->with('success', 'Drug created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Drug $drug)
    {
        return Inertia::render('drugs/show', [
            'drug' => $drug,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Drug $drug)
    {
        $categories = Drug::distinct()->pluck('category')->sort()->values();
        
        return Inertia::render('drugs/edit', [
            'drug' => $drug,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDrugRequest $request, Drug $drug)
    {
        $drug->update($request->validated());

        return redirect()->route('drugs.show', $drug)
            ->with('success', 'Drug updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drug $drug)
    {
        $drug->delete();

        return redirect()->route('drugs.index')
            ->with('success', 'Drug deleted successfully.');
    }
}