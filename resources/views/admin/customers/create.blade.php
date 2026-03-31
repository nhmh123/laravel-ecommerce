@extends('admin.layouts.app')

@section('title', 'Create Customer')
@section('page_title', 'Create Customer')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-4">
            <h2 class="text-xl font-medium">Create customer</h2>
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">
                Basic customer details.
            </p>
        </div>

        <form method="POST" action="{{ url('/admin/customers') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="text-sm font-medium">Name</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', '') }}"
                    class="mt-1 w-full rounded-sm border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] px-3 py-2"
                    required
                >
            </div>

            <div>
                <label for="phone" class="text-sm font-medium">Phone</label>
                <input
                    id="phone"
                    name="phone"
                    type="text"
                    value="{{ old('phone', '') }}"
                    class="mt-1 w-full rounded-sm border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] px-3 py-2"
                    required
                >
            </div>

            <div>
                <label for="email" class="text-sm font-medium">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', '') }}"
                    class="mt-1 w-full rounded-sm border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] px-3 py-2"
                >
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a
                    href="{{ url('/admin/customers') }}"
                    class="px-5 py-2 rounded-sm border border-[#19140035] hover:bg-[#FDFDFC] dark:hover:bg-[#161615] text-sm"
                >
                    Cancel
                </a>
                <button
                    type="submit"
                    class="px-5 py-2 rounded-sm border border-black bg-black text-white text-sm"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection

