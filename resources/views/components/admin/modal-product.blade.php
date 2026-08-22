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
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-product-variant">
                                <i class="fas fa-plus mr-1"></i>
                                Thêm biến thể
                            </button>
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
                            <!-- Product Variants -->
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-layer-group mr-1"></i>
                                        Danh sách biến thể
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="card variant-card mb-3">
                                        <div class="card-header bg-light">
                                            <h3 class="card-title font-weight-bold">
                                                Biến thể #1
                                            </h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label>
                                                            SKU
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            name="variants[0][sku]" value="IPHONE-15PM-BLACK-256"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>
                                                            Thuộc tính
                                                        </label>
                                                        <div>
                                                            <span class="badge badge-secondary mr-1">
                                                                Đen
                                                            </span>
                                                            <span class="badge badge-secondary">
                                                                256GB
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>
                                                                    Giá nhập
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control variant-cost"
                                                                    name="variants[0][cost_price]" value="26000000">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>
                                                                    Giá bán
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control variant-price"
                                                                    name="variants[0][price]" value="30000000">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <label class="mb-0">
                                                                Kích hoạt
                                                            </label>
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="variant-active-0"
                                                                    name="variants[0][is_active]" value="1"
                                                                    checked>
                                                                <label class="custom-control-label"
                                                                    for="variant-active-0">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label>
                                                            Hình ảnh biến thể
                                                        </label>
                                                        <div class="mb-2">
                                                            <input type="file" class="d-none variant-image-input"
                                                                id="variant-images-0" name="variants[0][images][]"
                                                                multiple accept="image/*">
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm btn-select-variant-images"
                                                                data-input="#variant-images-0">
                                                                <i class="fas fa-images mr-1"></i>
                                                                Chọn hình ảnh
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm btn-clear-variant-images">
                                                                <i class="fas fa-trash mr-1"></i>
                                                                Xóa tất cả
                                                            </button>
                                                        </div>
                                                        <div class="text-danger font-italic small mb-2">
                                                            <i class="fas fa-info-circle mr-1"></i>
                                                            Kéo thả để thay đổi thứ tự hình ảnh.
                                                            Hình đầu tiên sẽ là hình ảnh chính của biến thể.
                                                        </div>
                                                        <!-- SORTABLE IMAGE LIST -->
                                                        <div id="variant-image-preview" class="list-group">
                                                            <div class="list-group-item d-flex align-items-center">
                                                                <div class="mr-3 font-weight-bold text-muted"
                                                                    style="width: 25px;">
                                                                    1
                                                                </div>
                                                                <img src="https://placehold.co/80x80"
                                                                    class="img-thumbnail mr-3">
                                                                <div class="flex-grow-1">
                                                                    <div class="font-weight-bold">
                                                                        iphone-15-pro-max-black.jpg
                                                                    </div>
                                                                    <div class="small text-muted">
                                                                        1.2 MB
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                            <div class="list-group-item d-flex align-items-center">
                                                                <!-- ORDER -->
                                                                <div class="mr-3 font-weight-bold text-muted"
                                                                    style="width: 25px;">
                                                                    2
                                                                </div>
                                                                <!-- IMAGE -->
                                                                <img src="https://placehold.co/80x80"
                                                                    class="img-thumbnail mr-3">
                                                                <!-- FILE NAME -->
                                                                <div class="flex-grow-1">
                                                                    <div class="font-weight-bold">
                                                                        iphone-15-pro-max-black-back.jpg
                                                                    </div>
                                                                    <div class="small text-muted">
                                                                        980 KB
                                                                    </div>
                                                                </div>
                                                                <!-- DELETE -->
                                                                <button type="button" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                            <!-- IMAGE 3 -->
                                                            <div class="list-group-item d-flex align-items-center">
                                                                <!-- ORDER -->
                                                                <div class="mr-3 font-weight-bold text-muted"
                                                                    style="width: 25px;">
                                                                    3
                                                                </div>
                                                                <!-- IMAGE -->
                                                                <img src="https://placehold.co/80x80"
                                                                    class="img-thumbnail mr-3">
                                                                <!-- FILE NAME -->
                                                                <div class="flex-grow-1">
                                                                    <div class="font-weight-bold">
                                                                        iphone-15-pro-max-black-side.jpg
                                                                    </div>
                                                                    <div class="small text-muted">
                                                                        856 KB
                                                                    </div>
                                                                </div>
                                                                <!-- DELETE -->
                                                                <button type="button" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
