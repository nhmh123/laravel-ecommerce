<div class="modal fade" id="modal-add-brand" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-brand" method="POST" data-store-url="{{ route('admin.brands.store') }}" novalidate>
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">
            <div class="modal-content">
                <div id="brand-loading-overlay" class="overlay d-none">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">
                        Thêm thương hiệu mới
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Tên thương hiệu
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="brand-name" name="name" class="form-control"
                            placeholder="Ví dụ: Apple, Samsung, Sony..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                </div>
            </div>
        </form>
    </div>
</div>
