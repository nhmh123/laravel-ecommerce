<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tạo danh mục thành công.',
            'data' => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Danh mục đã được cập nhật!',
            'data' => $category->fresh()->load('children')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->children()->exists()) {
            return response()->json([
                'message' => 'Cannot delete a category that has child categories.'
            ], 422);
        }

        if ($category->products()->exists()) {
            return response()->json([
                'message' => 'Cannot delete category because it still contains products.'
            ], 422);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.'
        ]);
    }

    public function sidebar(){
        $categories = Category::select('id', 'name')
            ->root()
            ->with('childrenRecursive:id,name,parent_id')
            ->get();

        return response()->view('components.admin.category-sidebar', compact('categories'));
    }
}
