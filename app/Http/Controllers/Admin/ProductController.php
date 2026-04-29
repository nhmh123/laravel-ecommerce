<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::whereNull('parent_id')->with('children:id,name,parent_id')->get(['id', 'name']);
        $brands = Brand::get(['id', 'name']);
        $productTypes = ProductType::get(['id', 'name']);

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'categories' => $categories, 
                'brands' => $brands, 
                'productTypes' => $productTypes
            ]);
        }
        return view('admin.products.index', compact('categories', 'brands', 'productTypes'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
