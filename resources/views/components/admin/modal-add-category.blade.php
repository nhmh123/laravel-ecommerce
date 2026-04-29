<div class="modal fade" id="modal-add-category" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-category" method="POST">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modal-title">Thêm danh mục mới</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="cat-name" class="form-control"
                            placeholder="Ví dụ: Điện thoại, Laptop..." required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Danh mục cha</label>
                        
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
