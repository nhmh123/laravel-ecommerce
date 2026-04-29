<div class="modal fade" id="modalAddBrand" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" method="POST" id="formAddBrand">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm thương hiệu mới</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên thương hiệu</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary shadow-sm">Lưu lại</button>
                </div>
            </div>
        </form>
    </div>
</div>