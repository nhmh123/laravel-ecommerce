<div class="modal fade" id="modal-product-variant" tabindex="-1" role="dialog"
    aria-labelledby="modal-product-variant-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-product-variant-title">
                    Thêm mới biến thể sản phẩm
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="product-variant-form">
                    <h5 class="mb-3 text-uppercase">
                        Biến thể sản phẩm
                    </h5>
                    <div class="form-group">
                        <label>
                            Tên biến thể <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="variant-name" name="name"
                            placeholder="Ví dụ: Kích thước">
                    </div>
                    <div class="form-group">
                        <label>
                            Mã biến thể
                        </label>
                        <input type="text" class="form-control" id="variant-code" name="code"
                            placeholder="Tự động tạo mã">
                    </div>
                    <div class="form-group">
                        <label>Vị trí</label>
                        <input type="number" class="form-control" id="variant-position" name="position" min="0"
                            value="0">
                    </div>
                    <h5 class="text-uppercase mt-4 mb-3">
                        Tùy chọn của biến thể
                    </h5>
                    <div id="variant-options">
                        <div class="variant-option-row mb-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <label>
                                        Mã tùy chọn
                                    </label>
                                    <input type="text" class="form-control" name="options[0][code]"
                                        placeholder="Ví dụ: den">
                                </div>
                                <div class="col-md-5">
                                    <label>
                                        Tên tùy chọn
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" class="form-control" name="options[0][name]"
                                        placeholder="Ví dụ: Đen">
                                </div>

                                {{-- Xóa --}}
                                <div class="col-md-2 d-flex align-items-end">

                                    <button type="button" class="btn btn-danger btn-block btn-remove-variant-option">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-success" id="btn-add-variant-option">
                            <i class="fas fa-plus mr-1"></i>
                            Thêm tùy chọn
                        </button>

                    </div>

                </form>

            </div>

            {{-- Footer --}}
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>
                    Hủy
                </button>

                <button type="button" class="btn btn-primary" id="btn-save-product-variant">
                    <i class="fas fa-check mr-1"></i>
                    Lưu
                </button>

            </div>

        </div>

    </div>

</div>
