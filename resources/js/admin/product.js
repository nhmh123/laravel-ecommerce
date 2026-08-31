$(function () {
    let productImageViewer = null;
    let productImageFiles = [];
    const productImageInput = $('#product-images')[0];
    const productImagePreview = $('#product-image-preview')[0];
    productImageViewer = initImageViewer('#product-image-preview', productImageViewer);

    new AutoNumeric('#cost-price', {
        digitGroupSeparator: ',',
        decimalPlaces: 0,
        suffixText: ' ₫',
        modifyValueOnWheel: false,
        unformatOnSubmit: true
    });

    new AutoNumeric('#selling-price', {
        digitGroupSeparator: ',',
        decimalPlaces: 0,
        suffixText: ' ₫',
        modifyValueOnWheel: false,
        unformatOnSubmit: true
    });

    function initImageViewer(selector, currentViewer) {
        const preview = $(selector)[0];
        if (!preview) {
            return currentViewer;
        }
        if (currentViewer) {
            currentViewer.destroy();
            currentViewer = null;
        }
        return new Viewer(preview, {
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

    Sortable.create(productImagePreview, {
        sort: true,
        animation: 150,

        // Bắt sự kiện bắt đầu kéo
        onStart: function (evt) {
            console.log("Bắt đầu kéo item tại index:", evt.oldIndex);
        },

        // Bắt sự kiện khi thay đổi thứ tự trong danh sách
        onUpdate: function (evt) {
            console.log("Thứ tự đã thay đổi từ vị trí", evt.oldIndex, "sang vị trí", evt.newIndex);
            updateImageInput(productImageInput,productImageFiles);
        },

        // Bắt sự kiện kết thúc kéo thả (thả chuột ra)
        onEnd: function (evt) {
            console.log("Đã kết thúc kéo thả!");
            console.log("Vị trí cũ (oldIndex):", evt.oldIndex);
            console.log("Vị trí mới (newIndex):", evt.newIndex);

            // Bạn có thể viết thêm logic cập nhật lại mảng dữ liệu hoặc cập nhật lại số thứ tự (STT) hiển thị ở đây
        }
    });

    let variantImageViewer = null;

    $('#modal-product').modal('show');

    $('#modal-product').on('shown.bs.modal', function () {
        reloadProductBrandOptions();
        reloadProductCategoryOptions();
    });

    $('#product-images').on('change', function () {
        const newFiles = Array.from(this.files);

        productImageFiles = productImageFiles.concat(newFiles);

        // updateProductImageInput();
        updateImageInput(productImageInput, productImageFiles);
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

    $('#product-image-preview').on('click', '.btn-delete-image', function () {
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

    $('#product-has-variants').on('change', function () {
        if ($(this).is(':checked')) {
            $('#product-variants-section')
                .removeClass('d-none');
            initProductVariantSelect2();
        } else {
            $('#product-variants-section')
                .addClass('d-none');
        }
    });

    function initProductVariantSelect2() {
        $('#product-variants-section .product-variant-select').each(function () {
            const $select = $(this);
            if ($select.hasClass('select2-hidden-accessible')) {
                return;
            }
            $select.select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: $select.data('placeholder'),
                allowClear: true,
                closeOnSelect: false,
                minimumResultsForSearch: 0,
                dropdownParent: $('#modal-product')
            });
        });
    }

    function updateProductImageInput() {
        const input = $('#product-images')[0];
        const dataTransfer = new DataTransfer();

        productImageFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    }

    function updateImageInput(inputElement, filesArray) {
        // 1. Console.log trước khi update (danh sách file hiện tại của input)
        console.log("=== TRƯỚC KHI UPDATE (input.files) ===", inputElement.files);

        const dataTransfer = new DataTransfer();

        filesArray.forEach(function (file) {
            dataTransfer.items.add(file);
        });

        inputElement.files = dataTransfer.files;

        // 2. Console.log sau khi update (danh sách file mới được gán vào input)
        console.log("=== SAU KHI UPDATE (input.files) ===", inputElement.files);
    }

    function updateProductImageButtons() {
        const hasImages = productImageFiles.length > 0;
        $('#btn-select-product-images').toggleClass('d-none', hasImages);
        $('#btn-add-product-images').toggleClass('d-none', !hasImages);
        $('#btn-remove-all-product-images').toggleClass('d-none', !hasImages);
    }

    function renderImagePreview(inputSelector, previewSelector, currentViewer) {
        const $input = $(inputSelector);
        const $preview = $(previewSelector);

        $preview.empty();

        const files = Array.from($input[0].files);

        if (files.length === 0) {
            return initImageViewer(previewSelector, currentViewer);
        }

        let loaded = 0;

        files.forEach(function (file, index) {
            if (!file.type.startsWith('image/')) {
                loaded++;
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                $preview.append(
                    createImagePreviewItem(file, e.target.result, index)
                );

                loaded++;

                if (loaded === files.length) {
                    currentViewer = initImageViewer(
                        previewSelector,
                        currentViewer
                    );
                }
            };

            reader.readAsDataURL(file);
        });
        return currentViewer;
    }

    function createImagePreviewItem(file, src, index) {
        return `
        <div class="list-group-item d-flex align-items-center">
            <div
                class="mr-3 font-weight-bold text-muted image-order"
                style="width: 25px;"
            >
                ${index + 1}
            </div>

            <img
                src="${src}"
                class="img-thumbnail mr-3 flex-shrink-0"
                width="80"
                height="80"
                style="object-fit: cover; cursor: pointer;"
                title="${file.name}"
                alt="${file.name}"
            >

            <div class="flex-grow-1 mr-3" style="min-width: 0;">
                <div class="font-weight-bold text-break">
                    ${file.name}
                </div>

                <div class="small text-muted">
                    ${file.size}
                </div>
            </div>

            <button
                type="button"
                class="btn btn-danger btn-sm btn-delete-image flex-shrink-0 ml-auto"
                data-index="${index}"
            >
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
    }

    function renderProductImagePreview() {
        productImageViewer = renderImagePreview('#product-images', '#product-image-preview', productImageViewer);
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

    function formatFileSize(bytes) {
        if (bytes < 1024) {
            return `${bytes} B`;
        }

        if (bytes < 1024 * 1024) {
            return `${(bytes / 1024).toFixed(1)} KB`;
        }

        return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
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

    $('.variant-cost, .variant-price').each(function () {
        new AutoNumeric(this, {
            digitGroupSeparator: ',',
            decimalPlaces: 0,
            suffixText: ' ₫',
            modifyValueOnWheel: false,
            unformatOnSubmit: true
        });
    });

    const variantImagePreview = $('#variant-image-preview')[0];

    Sortable.create(variantImagePreview, {
        group: 'sorting',
        sort: true,
        animation: 150
    });
});
