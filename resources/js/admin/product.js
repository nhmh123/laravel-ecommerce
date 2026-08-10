$(function () {
    let productImageViewer = null;
    let productImageFiles = [];

    $('#modal-product').modal('show');

    $('#modal-product').on('shown.bs.modal', function () {
        reloadProductBrandOptions();
        reloadProductCategoryOptions();
    });

    $('#product-images').on('change', function () {
        const newFiles = Array.from(this.files);

        productImageFiles = productImageFiles.concat(newFiles);

        updateProductImageInput();
        renderProductImagePreview();
        updateProductImageButtons();

        this.value = '';
    });

    $('#btn-add-product-images').on('click', function () {
        $('#product-images').trigger('click');
    });

    $('#btn-remove-all-product-images').on('click', function () {
        Swal.fire({
            title: 'Xóa tất cả hình ảnh?',
            text: 'Tất cả hình ảnh đã chọn sẽ bị xóa.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa tất cả',
            cancelButtonText: 'Hủy',
            reverseButtons: true
        }).then(function (result) {
            if (!result.isConfirmed) {
                return;
            }

            productImageFiles = [];

            updateProductImageInput();
            renderProductImagePreview();
            updateProductImageButtons();
        });
    });

    $('#product-image-preview').on(
        'click',
        '.btn-delete-image',
        function () {
            const index = Number($(this).data('index'));

            productImageFiles.splice(index, 1);

            updateProductImageInput();
            renderProductImagePreview();
            updateProductImageButtons();

            if (productImageFiles.length === 0) {
                $('#btn-add-product-images').addClass('d-none');
                $('#btn-select-product-images').removeClass('d-none');
            }
        }
    );

    $('#btn-add-spec').on('click', function () {
        $('#specification-table').append(`
        <tr>
            <td>
                <input
                    type="text"
                    class="form-control"
                    name="specifications[key][]"
                >
            </td>

            <td>
                <input
                    type="text"
                    class="form-control"
                    name="specifications[value][]"
                >
            </td>

            <td>
                <button
                    type="button"
                    class="btn btn-danger btn-sm remove-spec"
                >
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    `);
    });

    $('#specification-table').on('click', '.remove-spec', function () {
        $(this).closest('tr').remove();
    });

    function initProductImageViewer() {
        const preview = $('#product-image-preview')[0];
        if (!preview) {
            return;
        }

        if (productImageViewer) {
            productImageViewer.destroy();
            productImageViewer = null;
        }

        productImageViewer = new Viewer(preview, {
            toolbar: true,
            navbar: true,
            title: true,
            movable: true,
            zoomable: true,
            rotatable: true,
            scalable: true,
            transition: true,
        });
    }

    function updateProductImageInput() {
        const input = document.getElementById('product-images');
        const dataTransfer = new DataTransfer();

        productImageFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    }

    function updateProductImageButtons() {
        const hasImages = productImageFiles.length > 0;

        $('#btn-select-product-images').toggleClass('d-none', hasImages);
        $('#btn-add-product-images').toggleClass('d-none', !hasImages);
        $('#btn-remove-all-product-images').toggleClass('d-none', !hasImages);
    }

    function renderProductImagePreview() {
        const input = $('#product-images');
        const $preview = $('#product-image-preview');

        $preview.empty();

        const files = Array.from(input[0].files);
        let loaded = 0;

        if (files.length === 0) {
            initProductImageViewer();
            return;

        }
        files.forEach(function (file, index) {
            if (!file.type.startsWith('image/')) {
                loaded++;
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                $preview.append(`
                <div
                    class="product-image-item position-relative"
                    style="width: 120px;"
                >
                    <img
                        src="${e.target.result}"
                        class="img-thumbnail product-preview-image"
                        title="${file.name}"
                        alt="${file.name}"
                        style="
                            width: 120px;
                            height: 120px;
                            object-fit: cover;
                            cursor: pointer;
                        "
                    >
                    <span
                        class="image-order badge badge-primary position-absolute"
                        style="top: 5px; left: 5px;"
                    >
                        ${index + 1}
                    </span>
                    <button
                        type="button"
                        class="btn btn-danger btn-sm btn-delete-image position-absolute"
                        data-index="${index}"
                        style="
                            top: 5px;
                            right: 5px;
                            width: 25px;
                            height: 25px;
                            padding: 0;
                        "
                    >
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="text-center small text-muted mt-1 text-truncate">
                        ${file.name}
                    </div>
                </div>
            `);
                loaded++;

                if (loaded === files.length) {
                    initProductImageViewer();
                }
            };

            reader.readAsDataURL(file);
        });
    }

    function reloadProductBrandOptions(selected = '') {
        const $select = $('#product-brand-id');

        if (!$select.length) {
            return;
        }

        $.get($select.data('url'), function (html) {
            $select.html(
                '<option value="">-- Chọn thương hiệu --</option>' + html
            );

            if (selected) {
                $select.val(selected);
            }
        });
    }

    function reloadProductCategoryOptions(selected = '') {
        const $select = $('#product-category-id');

        $.get($select.data('url'), function (html) {
            $select.html(
                '<option value="">-- Chọn danh mục --</option>' + html
            );

            if (selected) {
                $select.val(selected);
            }
        });
    }
});
