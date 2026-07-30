<div class="modal fade" id="modal-add-category" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-category" method="POST" data-store-url="{{ route('admin.categories.store') }}" novalidate>
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">
            <div class="modal-content">
                <div id="category-loading-overlay" class="overlay d-none">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Thêm danh mục mới</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="cat-name" class="form-control"
                            placeholder="Ví dụ: Điện thoại, Laptop..." required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Danh mục cha</label>
                        <select name="parent_id" id="cat-parent-id" class="form-control">
                            <option value="">-- Danh mục gốc --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
