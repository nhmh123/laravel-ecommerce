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
                                <label>Mã sản phẩm (SKU)</label>
                                <input type="text" class="form-control" name="sku" placeholder="Tự động tạo mã"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu *</label>
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
                                <label>Danh mục *</label>
                                <select id="product-category-id" name="category_id" class="form-control"
                                    data-url="{{ route('admin.categories.options') }}">
                                    <option value="">-- Chọn danh mục --</option>
                                    <x-admin.category-option :categories="$categories" />
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Giá nhập *</label>
                                <div class="input-group">
                                    <input type="text" id="cost-price" name="cost_price" class="form-control"
                                        placeholder="Nhập giá nhập">
                                    <div class="input-group-append">
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Giá bán *</label>
                                <div class="input-group">
                                    <input type="text" id="selling-price" name="price" class="form-control"
                                        placeholder="Nhập giá bán">
                                    <div class="input-group-append">
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh sản phẩm</label>
                                <div class="mb-2">
                                    <label for="product-images" id="btn-select-product-images"
                                        class="btn btn-outline-primary btn-sm mb-0">
                                        <i class="fas fa-images mr-1"></i>
                                        Chọn hình ảnh
                                    </label>
                                    <input type="file" id="product-images" name="images[]" class="d-none"
                                        accept="image/*" multiple>
                                    <button type="button" id="btn-add-product-images"
                                        class="btn btn-outline-primary btn-sm d-none">
                                        <i class="fas fa-plus mr-1"></i>
                                        Thêm hình ảnh
                                    </button>
                                    <button type="button" id="btn-remove-all-product-images"
                                        class="btn btn-outline-danger btn-sm d-none">
                                        <i class="fas fa-trash mr-1"></i>
                                        Xóa tất cả
                                    </button>
                                    <div class="text-danger font-italic small mt-1">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Có thể chọn nhiều hình ảnh.
                                        Hình ảnh số 1 sẽ là hình ảnh chính.
                                        Nhấn vào ảnh để xem phóng to.
                                    </div>
                                </div>
                                <div id="product-image-preview" class="d-flex flex-wrap" style="gap: 10px;"></div>
                            </div>
                            <div class="form-group">
                                <label>Thông số kỹ thuật</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Thuộc tính</th>
                                            <th>Giá trị</th>
                                            <th width="60" class="text-nowrap">Thao tác</th>
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
                                <button type="button" class="btn btn-success" id="btn-add-spec">
                                    <i class="fas fa-plus"></i>
                                    Thêm thông số
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mô tả sản phẩm</label>
                        <textarea id="product-description" name="description" class="form-control" rows="10"></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="mb-0 mr-3">
                                    Kích hoạt
                                </label>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is-active"
                                        name="is_active" value="1" checked>

                                    <label class="custom-control-label" for="is-active"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-product-variant">
                                <i class="fas fa-plus mr-1"></i>
                                Thêm biến thể
                            </button> --}}
                            <div class="form-group">
                                <div class="d-flex align-items-center mb-2">
                                    <label class="mb-0 mr-3">
                                        Có biến thể
                                        <i class="fas fa-info-circle text-primary" data-toggle="tooltip"
                                            title="Sản phẩm có nhiều biến thể"></i>
                                    </label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input"
                                            id="product-has-variants">
                                        <label class="custom-control-label" for="product-has-variants"></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div id="product-variants-section" class="d-none">
                                <div class="form-group">
                                    <label>
                                        Màu sắc
                                    </label>
                                    <select class="form-control product-variant-select" multiple
                                        data-placeholder="Chọn Màu sắc">
                                        <option value="1">Đỏ</option>
                                        <option value="2">Trắng</option>
                                        <option value="3">Xanh</option>
                                        <option value="4">Đen</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Kích cỡ
                                    </label>
                                    <select class="form-control product-variant-select" multiple
                                        data-placeholder="Chọn Kích cỡ">
                                        <option value="5">S</option>
                                        <option value="6">M</option>
                                        <option value="7">L</option>
                                        <option value="8">XL</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Dung lượng
                                    </label>
                                    <select class="form-control product-variant-select" multiple
                                        data-placeholder="Chọn Dung lượng">
                                        <option value="9">128GB</option>
                                        <option value="10">256GB</option>
                                        <option value="11">512GB</option>
                                    </select>
                                </div>
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
