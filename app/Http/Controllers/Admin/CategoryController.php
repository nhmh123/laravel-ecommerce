<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

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
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if (!$this->categoryService->canMove($category, $request->parent_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể chọn danh mục hiện tại hoặc danh mục con của nó làm danh mục cha.'
            ], 422);
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id'=>$request->parent_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật danh mục thành công.',
            'data' => $category->fresh()->load('children'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->children()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa danh mục vì vẫn còn danh mục con.'
            ], 422);
        }

        if ($category->products()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa danh mục vì vẫn còn sản phẩm thuộc danh mục này.'
            ], 422);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa danh mục thành công.'
        ]);
    }

    public function sidebar(){
        $categories = Category::select('id', 'name')
            ->root()
            ->with('childrenRecursive:id,name,parent_id')
            ->get();

        return response()->view('components.admin.category-sidebar', compact('categories'));
    }

    public function options()
    {
        $categories = Category::query()
            ->root()
            ->with('childrenRecursive:id,name,parent_id')
            ->get(['id', 'name']);

        return response()->view('components.admin.category-option', compact('categories'));
    }
}
