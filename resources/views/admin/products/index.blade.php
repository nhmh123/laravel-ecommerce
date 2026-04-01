@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap4.min.css">
@endpush

@section('page_title', 'Danh sách sản phẩm')

@section('content')
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-tag"></i>
                Loại sản phẩm
            </h3>
        </div>
        <div class="card-body d-flex">
            <div class="form-check mr-2">
                <input class="form-check-input" type="checkbox" checked="" data-gtm-form-interact-field-id="1">
                <label class="form-check-label">Hàng lẻ</label>
            </div>
            <div class="form-check mr-2">
                <input class="form-check-input" type="checkbox" checked="" data-gtm-form-interact-field-id="1">
                <label class="form-check-label">Combo</label>
            </div>
            <div class="form-check mr-2">
                <input class="form-check-input" type="checkbox" checked="" data-gtm-form-interact-field-id="1">
                <label class="form-check-label">Dịch vụ</label>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="row">
        <div class="col-lg-2">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-sitemap"></i>
                        Danh mục
                    </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool" style="line-height: 1;">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">

                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-warehouse"></i>
                        Kho hàng
                    </h3>
                </div>
                <div class="card-body p-0">

                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-industry"></i>
                        Hãng sản xuất
                    </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool" style="line-height: 1;">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">

                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <h4 class="m-0">Sản phẩm</h4>
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class=" bg-white p-3">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-success btn-flat dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-layer-group"></i>
                                    Thao tác
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-trash-alt"></i>
                                        Xóa</a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-file-excel"></i>
                                        Xuất Excel</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="input-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0 rounded-left-pill">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control border-left-0 border-right-0"
                                        placeholder="Tìm kiếm theo tên sản phẩm, mã sản phẩm">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-left-0 rounded-right-pill"></span>
                                    </div>
                                </div>

                                <a class="btn btn-outline-success btn-flat mx-2" href="#" title="Làm mới">
                                    <i class="fas fa-sync"></i>
                                </a>

                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-success btn-flat dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-plus"></i>
                                        Thêm mới
                                    </button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-box-open"></i>
                                            Thêm mới sản phẩm</a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-boxes"></i>
                                            Thêm mới combo</a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fab fa-usps"></i>
                                            Thêm mới dịch vụ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(function() {
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                });
            });
        </script>
    @endpush
@endsection
