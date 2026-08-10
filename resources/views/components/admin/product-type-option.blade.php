@props([
    'productTypes',
    'selected' => null,
])

@foreach ($productTypes as $productType)
    <option
        value="{{ $productType->id }}"
        @selected($productType->id == $selected)
    >
        {{ $productType->name }}
    </option>
@endforeach
