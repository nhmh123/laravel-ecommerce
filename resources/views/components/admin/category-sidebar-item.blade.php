@props(['categories','level' => 0])

@foreach ($categories as $category)
    <div class="d-flex justify-content-between align-items-center mb-2 pr-1">
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="cat-{{ $category->id }}">
            <label class="custom-control-label font-weight-normal " for="cat-{{ $category->id }}">
                {{ $category->name }}
            </label>
        </div>
        <div class="action-icons text-muted text-nowrap">
            <ion-icon class="edit-category mr-1" data-id="{{ $category->id }}" name="pencil-outline"
                style="cursor:pointer"></ion-icon>
            <ion-icon class="delete-category" data-id="{{ $category->id }}" name="trash-outline"
                style="cursor:pointer"></ion-icon>
        </div>
    </div>
    @if ($category->children && $category->children->isNotEmpty())
        <div class="ml-3">
            <x-admin.category-sidebar-item :categories="$category->children" :level="$level + 1" />
        </div>
    @endif
@endforeach
