const $ = window.jQuery;
if ($) {
    $(function () {
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function reloadCategorySidebar() {
            const $sidebar = $('#category-sidebar');
            $.get($sidebar.data('url'), function (html) {
                $sidebar.html(html);
                checkAllCategorySidebarsItem();
            });
        }

        function checkAllCategorySidebarsItem() {
            $('.category-sidebar .custom-control-input').prop('checked', true);
        }

        checkAllCategorySidebarsItem()

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
            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('[data-category-feedback]').remove();
            $('#category-loading-overlay').addClass('d-none');
        });

        $('#form-category').on('submit', function (event) {
            event.preventDefault();

            const $form = $(this);
            const $submit = $form.find('button[type="submit"]');
            const $overlay = $('#category-loading-overlay');

            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('[data-category-feedback]').remove();
            $submit.prop('disabled', true);
            $overlay.removeClass('d-none');

            $.ajax({
                url: $form.data('store-url'),
                method: 'POST',
                data: $form.serialize(),
                headers: { Accept: 'application/json' },
            })
                .done(function (response) {
                    $('#modal-add-category').modal('hide');

                    reloadCategorySidebar();

                    $form[0].reset();

                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 1500,
                    };
                    toastr.success(response.message, 'Success');
                })
                .fail(function (xhr) {
                    const errors = xhr.responseJSON && xhr.responseJSON.errors;
                    console.log(errors)
                    if (errors) {
                        Object.entries(errors).forEach(function ([field, messages]) {
                            const $field = $form.find('[name="' + field + '"]');
                            let $feedback = $form.find('[data-category-feedback="' + field + '"]');

                            if (!$feedback.length) {
                                $feedback = $('<div></div>', {
                                    class: 'invalid-feedback d-block',
                                    'data-category-feedback': field,
                                }).insertAfter($field);
                            }

                            $field.addClass('is-invalid');
                            $feedback.text(messages[0]);
                        });
                    } else {
                        toastr.error('Unable to save the category. Please try again.');
                    }
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
                title: 'Delete category?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
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
    });
}
