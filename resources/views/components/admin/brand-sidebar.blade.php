@props(['brands'])

<div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-1">
    <h6 class="font-weight-bold m-0"><i class="fas fa-industry mr-1"></i> Hãng sản xuất</h6>
    <a href="#" class="text-dark "><i class="fas fa-plus"></i></a>
</div>
<div class="input-group input-group-sm mb-2 mt-2">
    <input type="text" id="search-brand" class="form-control border-right-0" placeholder="Tìm hãng...">
    <div class="input-group-append">
        <span class="input-group-text bg-white border-left-0"><i class="fas fa-search fa-xs text-muted"></i></span>
    </div>
</div>
<div class="filter-scroll scroll-custom" id="brand-list" style="max-height: 200px; overflow-y: auto;">
    @foreach ($brands as $brand)
        <div class="brand-item d-flex justify-content-between align-items-center mb-2 pr-1">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="brand-{{ $brand->id }}">
                <label class="custom-control-label font-weight-normal " for="brand-{{ $brand->id }}">
                    {{ $brand->name }}
                </label>
            </div>
            <div class="action-icons text-muted text-nowrap">
                <ion-icon name="pencil-outline" style="cursor:pointer" class="mr-1"></ion-icon>
                <ion-icon name="trash-outline" style="cursor:pointer"></ion-icon>
            </div>
        </div>
    @endforeach
</div>
