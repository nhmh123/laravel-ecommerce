const $ = window.jQuery;
if ($) {
    $(function () {
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var updateUrl = '';

        checkAllCategorySidebarsItem()

        function reloadCategorySidebar() {
            const $sidebar = $('#category-sidebar');
            $.get($sidebar.data('url'), function (html) {
                $sidebar.html(html);
                checkAllCategorySidebarsItem();
            });
        }

        function reloadCategoryOptions(selected = '') {
            const $select = $('#cat-parent-id');

            $.get($select.data('url'), function (html) {
                $select.html('<option value="">-- Danh mục gốc --</option>' + html);

                if (selected) {
                    $select.val(selected);
                }
            });
        }

        function checkAllCategorySidebarsItem() {
            $('.category-sidebar .custom-control-input').prop('checked', true);
        }

        $('.filter-sidebar').on('change', '.custom-control-input', function () {
            const isChecked = $(this).is(':checked');
            const $childrenContainer = $(this).closest('.d-flex').next('.ml-3');

            if ($childrenContainer.length) {
                $childrenContainer.find('.custom-control-input').prop('checked', isChecked);
            }
        });

        $('#modal-add-category').on('shown.bs.modal', function () {
            $('#cat-name').trigger('focus');
        });

        $('#modal-add-category').on('hidden.bs.modal', function () {
            const $form = $('#form-category');
            $form[0].reset();
            $('#modal-title').text('Thêm danh mục mới');
            $('#form-method').val('POST');
            $form.attr('data-mode', 'create').removeAttr('data-update-url');
            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('[data-category-feedback]').remove();
            $('#category-loading-overlay').addClass('d-none');
        });

        $('#form-category').on('submit', function (event) {
            event.preventDefault();

            const $form = $(this);
            const isUpdate = $form.data('mode') === 'update';
            const $submit = $form.find('button[type="submit"]');
            const $overlay = $('#category-loading-overlay');

            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('[data-category-feedback]').remove();
            $submit.prop('disabled', true);
            $overlay.removeClass('d-none');

            console.log($form.attr('data-update-url'));
            console.log(updateUrl);

            $.ajax({
                url: isUpdate
                    ? updateUrl
                    : $form.data('store-url'),
                method: isUpdate ? 'PUT' : 'POST',
                data: $form.serialize(),
                headers: { Accept: 'application/json' },
            })
                .done(function (response) {
                    $('#modal-add-category').modal('hide');
                    reloadCategorySidebar();
                    reloadCategoryOptions();
                    $form[0].reset();
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 1500,
                    };
                    toastr.success(response.message, 'Success');
                })
                .fail(function (xhr) {
                    const response = xhr.responseJSON;

                    $form.find('.is-invalid').removeClass('is-invalid');
                    $form.find('[data-category-feedback]').remove();

                    if (response?.errors) {
                        Object.entries(response.errors).forEach(function ([field, messages]) {
                            const $field = $form.find('[name="' + field + '"]');
                            let $feedback = $form.find('[data-category-feedback="' + field + '"]');

                            if (!$feedback.length) {
                                $feedback = $('<div>', {
                                    class: 'invalid-feedback d-block',
                                    'data-category-feedback': field,
                                }).insertAfter($field);
                            }

                            $field.addClass('is-invalid');
                            $feedback.text(messages[0]);
                        });

                        return;
                    }

                    if (response?.message) {
                        toastr.error(response.message);
                        return;
                    }

                    toastr.error('Đã xảy ra lỗi. Vui lòng thử lại sau.');
                })
                .always(function () {
                    $submit.prop('disabled', false);
                    $overlay.addClass('d-none');
                });
        });

        $('#category-sidebar').on('click', '.delete-category', function () {
            const $button = $(this);
            const url = $button.data('url');

            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Danh mục sẽ bị xóa vĩnh viễn. Bạn có muốn tiếp tục?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, xóa ngay',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        Accept: 'application/json'
                    }
                })
                    .done(function (response) {
                        toastr.success(response.message);
                        reloadCategorySidebar();
                    })
                    .fail(function (xhr) {
                        const message =
                            xhr.responseJSON?.message ??
                            'Unable to delete category.';

                        toastr.error(message);
                    });
            });
        });

        $('#category-sidebar').on('click', '.edit-category', function () {
            const $button = $(this);
            updateUrl = $(this).data('url');
            $('#modal-title').text('Cập nhật danh mục');
            $('#cat-name').val($button.data('name'));
            $('#cat-parent-id').val($button.data('parent-id'));
            $('#form-method').val('PUT');
            $('#form-category').attr('data-mode', 'update').attr('data-update-url', $button.data('url'));
            $('#modal-add-category').modal('show');
        });
    });
}
