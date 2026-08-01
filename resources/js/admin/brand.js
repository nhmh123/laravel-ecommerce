const $ = window.jQuery;

if ($) {
    $(function () {
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let updateUrl = '';

        checkAllBrandSidebarItems();

        function reloadBrandSidebar() {
            const $sidebar = $('#brand-sidebar');
            $.get($sidebar.data('url'), function (html) {
                $sidebar.html(html);
                checkAllBrandSidebarItems();
            });
        }

        function checkAllBrandSidebarItems() {
            $('#brand-sidebar .custom-control-input').prop('checked', true);
        }

        $('#modal-add-brand').on('shown.bs.modal', function () {
            $('#brand-name').trigger('focus');
        });

        $('#modal-add-brand').on('hidden.bs.modal', function () {
            const $form = $('#form-brand');

            $form[0].reset();

            $('#modal-title').text('Thêm thương hiệu mới');
            $('#form-method').val('POST');

            updateUrl = '';

            $form
                .attr('data-mode', 'create')
                .removeAttr('data-update-url');

            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('[data-brand-feedback]').remove();

            $('#brand-loading-overlay').addClass('d-none');
        });

        $('#form-brand').on('submit', function (e) {
            e.preventDefault();

            const $form = $(this);
            const isUpdate = $form.data('mode') === 'update';
            const $submit = $form.find('button[type="submit"]');
            const $overlay = $('#brand-loading-overlay');

            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('[data-brand-feedback]').remove();

            $submit.prop('disabled', true);
            $overlay.removeClass('d-none');

            $.ajax({
                url: isUpdate ? updateUrl : $form.data('store-url'),
                method: isUpdate ? 'PUT' : 'POST',
                data: $form.serialize(),
                headers: {
                    Accept: 'application/json'
                }
            })
                .done(function (response) {
                    $('#modal-add-brand').modal('hide');

                    reloadBrandSidebar();

                    toastr.success(response.message);
                })
                .fail(function (xhr) {
                    const response = xhr.responseJSON;

                    $form.find('.is-invalid').removeClass('is-invalid');
                    $form.find('[data-brand-feedback]').remove();

                    if (response?.errors) {
                        Object.entries(response.errors).forEach(function ([field, messages]) {

                            const $field = $form.find('[name="' + field + '"]');

                            $('<div>', {
                                class: 'invalid-feedback d-block',
                                'data-brand-feedback': field,
                                text: messages[0]
                            }).insertAfter($field);

                            $field.addClass('is-invalid');
                        });

                        return;
                    }

                    toastr.error(response?.message ?? 'Đã xảy ra lỗi. Vui lòng thử lại sau.');
                })
                .always(function () {
                    $submit.prop('disabled', false);
                    $overlay.addClass('d-none');
                });
        });

        $('#brand-sidebar').on('click', '.edit-brand', function () {
            const $button = $(this);

            updateUrl = $button.data('url');

            $('#modal-title').text('Cập nhật thương hiệu');
            $('#brand-name').val($button.data('name'));

            $('#form-method').val('PUT');

            $('#form-brand')
                .attr('data-mode', 'update')
                .attr('data-update-url', updateUrl);

            $('#modal-add-brand').modal('show');
        });

        $('#brand-sidebar').on('click', '.delete-brand', function () {
            const url = $(this).data('url');

            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Thương hiệu sẽ bị xóa vĩnh viễn. Bạn có muốn tiếp tục?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, xóa ngay',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then(function (result) {

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

                        reloadBrandSidebar();

                        toastr.success(response.message);
                    })
                    .fail(function (xhr) {
                        toastr.error(
                            xhr.responseJSON?.message ??
                            'Không thể xóa thương hiệu.'
                        );
                    });
            });
        });

        $('#search-brand').on('input', function () {
            const keyword = $(this).val().trim().toLowerCase();

            $('#brand-list .brand-item').each(function () {
                const name = $(this)
                    .find('.custom-control-label')
                    .text()
                    .trim()
                    .toLowerCase();

                console.log({
                    keyword,
                    name,
                    match: name.includes(keyword),
                });

                if (name.includes(keyword)) {
                    $(this).removeClass('d-none').addClass('d-flex');
                } else {
                    $(this).removeClass('d-flex').addClass('d-none');
                }
            });
        });
    });
}
