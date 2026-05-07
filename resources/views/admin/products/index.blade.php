@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap4.min.css">
@endpush

@section('page_title', 'Danh sách sản phẩm')

@section('content')
    <div class="bg-white shadow-sm rounded p-3 mb-3">
        <div class="d-flex align-items-center">
            <div class="mr-4 text-muted border-right pr-4 d-none d-md-block">
                <h6 class="font-weight-bold m-0 text-uppercase">
                    <i class="fas fa-tag mr-1"></i> Loại sản phẩm
                </h6>
            </div>

            <div class="d-flex flex-wrap align-items-center">
                @foreach ($productTypes as $type)
                    <div class="custom-control custom-checkbox mr-4">
                        <input class="custom-control-input" type="checkbox" id="type-{{ $type->id }}" checked>
                        <label class="custom-control-label font-weight-normal cursor-pointer"
                            for="type-{{ $type->id }}">
                            {{ $type->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="filter-sidebar bg-white shadow-sm rounded p-3 mb-3">

                <div class="filter-group mb-4">
                    <x-admin.category-sidebar :categories="$categories" />
                </div>

                <div class="filter-group mb-4">
                    <x-admin.warehouse-sidebar :warehouses="[]" />
                </div>

                <div class="filter-group">
                    <x-admin.brand-sidebar :brands="$brands" />
                </div>

            </div>
        </div>
        <div class="col-lg-9">
            <div class="bg-white shadow-sm rounded">
                <div class="p-3 border-bottom">
                    <h6 class="m-0 font-weight-bold">Sản phẩm</h6>
                </div>

                <div class="p-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-success btn-flat dropdown-toggle shadow-sm"
                                data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-layer-group"></i> Thao tác
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="fas fa-trash-alt mr-2"></i> Xóa</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-file-excel mr-2"></i> Xuất
                                    Excel</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mt-2 mt-md-0">
                            <div class="input-group mr-2" style="width: 250px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0 rounded-left-pill">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-sm border-left-0 border-right-0"
                                    placeholder="Tìm kiếm...">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-white border-left-0 rounded-right-pill"></span>
                                </div>
                            </div>

                            <a class="btn btn-sm btn-outline-success btn-flat mr-2 shadow-sm" href="#"
                                title="Làm mới">
                                <i class="fas fa-sync"></i>
                            </a>

                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-success btn-flat dropdown-toggle shadow-sm"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-plus"></i> Thêm mới
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-box-open mr-2"></i> Thêm mới
                                        sản phẩm</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-boxes mr-2"></i> Thêm mới
                                        combo</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-usps mr-2"></i> Thêm mới
                                        dịch vụ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                </div>

                <div class="p-3 border-top">
                </div>
            </div>
        </div>
    </div>

    <x-admin.modal-add-brand />
    
    <x-admin.modal-add-category />

    @push('scripts')
        <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap4.min.js"></script>           
        <script>
        $(document).ready(function() {
            $('.filter-sidebar').on('change', '.custom-control-input', function() {
                let isChecked = $(this).is(':checked');
                
                let parentDiv = $(this).closest('.d-flex');
                let childrenContainer = parentDiv.next('.ml-3');

                if (childrenContainer.length > 0) {
                    childrenContainer.find('.custom-control-input').prop('checked', isChecked);
                }
            });
        });
    </script> 
    @endpush
@endsection
