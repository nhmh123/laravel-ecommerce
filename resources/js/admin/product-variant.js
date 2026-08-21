$(function () {

    let optionIndex = 1;

    $('#btn-add-variant-option').on('click', function () {

        $('#variant-options').append(`
            <div class="variant-option-row mb-2">
                <div class="row">
                    <div class="col-md-5">
                        <label>Mã tùy chọn</label>
                        <input
                            type="text"
                            class="form-control"
                            name="options[${optionIndex}][code]"
                            placeholder="Ví dụ: den"
                        >
                    </div>
                    <div class="col-md-5">
                        <label>
                            Tên tùy chọn
                            <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            name="options[${optionIndex}][name]"
                            placeholder="Ví dụ: Đen"
                        >
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button
                            type="button"
                            class="btn btn-danger btn-block btn-remove-variant-option"
                        >
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `);
        optionIndex++;
    });


    $(document).on(
        'click',
        '.btn-remove-variant-option',
        function () {
            $(this)
                .closest('.variant-option-row')
                .remove();
        }
    );

});
