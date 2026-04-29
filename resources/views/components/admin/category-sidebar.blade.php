@props(['categories', 'level' => 0])

<div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-1">
    <h6 class="font-weight-bold m-0"><i class="fas fa-sitemap mr-1"></i> Danh mục</h6>

    <a href="#" class="add-category text-dark"
        data-toggle="modal" 
        data-target="#modal-add-category">
        <i class="fas fa-plus"></i>
    </a>
</div>
<div class="filter-scroll scroll-custom" style="max-height: 200px; overflow-y: auto;">
    <x-admin.category-sidebar-item :categories="$categories" :level="$level" />
</div>
