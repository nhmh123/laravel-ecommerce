@props([
    'categories',
    'level' => 0
])

@foreach ($categories as $category)

    <option value="{{ $category->id }}">
        {{ str_repeat('|— ', $level) }}{{ $category->name }}
    </option>

    @if($category->childrenRecursive->isNotEmpty())
        <x-admin.category-option
            :categories="$category->childrenRecursive"
            :level="$level + 1"
        />
    @endif

@endforeach