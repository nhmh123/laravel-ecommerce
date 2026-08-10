@props(['categories', 'level' => 0, 'productTypes' => [], 'brands' => []])
<div class="modal fade" id="modal-product" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <form id="product-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="font-weight-bold mb-4">
                        THÔNG TIN SẢN PHẨM
                    </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên sản phẩm *</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu</label>
                                <select id="product-brand-id" class="form-control" name="brand_id"
                                    data-url="{{ route('admin.brands.options') }}">
                                    <option value="">-- Chọn thương hiệu --</option>
                                    <x-admin.brand-option :brands="$brands" />
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select id="product-type-id" name="type_id" class="form-control">
                                    @foreach ($productTypes as $productType)
                                        <option value="{{ $productType->id }}" @selected($productType->id === 1)>
                                            {{ $productType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" name="status_id">
                                    <option value="">
                                        Chọn trạng thái
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select id="product-category-id" name="category_id" class="form-control"
                                    data-url="{{ route('admin.categories.options') }}">
                                    <option value="">-- Chọn danh mục --</option>
                                    <x-admin.category-option :categories="$categories" />
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" rows="8" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Thông số kỹ thuật</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Thuộc tính</th>
                                            <th>Giá trị</th>
                                            <th width="60"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="specification-table">
                                        <tr>
                                            <td>
                                                <input class="form-control" name="specifications[key][]">
                                            </td>
                                            <td>
                                                <input class="form-control" name="specifications[value][]">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-spec">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-success btn-sm" id="btn-add-spec">
                                    <i class="fas fa-plus"></i>
                                    Thêm thông số
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="font-weight-bold mb-3">
                        SKU
                    </h5>
                    <div id="single-sku-section">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SKU Code</label>
                                    <input class="form-control" name="sku_code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trạng thái SKU</label>
                                    <select class="form-control" name="sku_status_id">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Giá bán</label>
                                    <input type="number" class="form-control" name="price">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Giá nhập</label>
                                    <input type="number" class="form-control" name="cost_price">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tồn kho</label>
                                    <input type="number" class="form-control" name="total_stock">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is-service"
                                        name="is_service">
                                    <label class="custom-control-label" for="is-service">
                                        Là dịch vụ
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="font-weight-bold mb-3">
                        Hình ảnh
                    </h5>
                    <div class="border rounded p-4 text-center">
                        <i class="fas fa-image fa-3x mb-3 text-secondary"></i>
                        <input type="file" name="images[]" multiple>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="custom-control custom-switch">
                                <input checked type="checkbox" class="custom-control-input" id="is-active"
                                    name="is_active">
                                <label class="custom-control-label" for="is-active">
                                    Kích hoạt
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="has-variants"
                                    name="has_variants">
                                <label class="custom-control-label" for="has-variants">
                                    Có biến thể
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>
                        Lưu sản phẩm
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
