@props(['brands'])

@foreach ($brands as $brand)
    <option value="{{ $brand->id }}">
        {{ $brand->name }}
    </option>
@endforeach
