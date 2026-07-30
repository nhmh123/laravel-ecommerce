const $ = window.jQuery;

if ($) {
    $(function () {
        console.log('category.js loaded');
        $('.category-sidebar .custom-control-input').prop('checked', true);

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

        $(document).on('click', '.edit-category', function () {
            alert('OK');
        });

        $(document).on('click', '.action-icons', function (e) {
            console.log(e.target);
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
                    $form[0].reset();

                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 1500,
                    };
                    toastr.success(response.message, 'Success');

                    setTimeout(function () {
                        window.location.reload();
                    }, 1600);
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
    });
}
