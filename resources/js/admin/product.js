$(function () {
    $('#modal-product').on('shown.bs.modal', function () {
        reloadProductBrandOptions();
        reloadProductCategoryOptions();
    });

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
