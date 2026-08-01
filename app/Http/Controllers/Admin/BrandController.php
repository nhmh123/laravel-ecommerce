<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thương hiệu đã được tạo thành công.',
            'data' => $brand,
        ], 201);
    }

    public function show(Brand $brand)
    {
        return response()->json([
            'success' => true,
            'data' => $brand,
        ]);
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thương hiệu đã được cập nhật thành công.',
            'data' => $brand->fresh(),
        ]);
    }

    public function destroy(Brand $brand)
    {
        if ($brand->products()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa thương hiệu vì vẫn còn sản phẩm thuộc thương hiệu này.',
            ], 422);
        }

        $brand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Thương hiệu đã được xóa thành công.',
        ]);
    }

    public function sidebar()
    {
        $brands = Brand::orderBy('name')->get();

        return response()->view('components.admin.brand-sidebar', compact('brands'));
    }
}
