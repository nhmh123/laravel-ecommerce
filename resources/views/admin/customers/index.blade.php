@extends('admin.layouts.app')

@section('title', 'Customers')
@section('page_title', 'Customers')

@section('content')
    <div class="max-w-6xl">
        <div class="flex items-center justify-between gap-4 mb-4">
            <div>
                <h2 class="text-xl font-medium">Customers</h2>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">
                    List customers in the admin panel.
                </p>
            </div>

            <a
                href="{{ url('/admin/customers/create') }}"
                class="inline-flex items-center justify-center px-5 py-2 rounded-sm border border-black bg-black text-white"
            >
                + New customer
            </a>
        </div>

        <div class="rounded-sm border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-[#FDFDFC] dark:bg-[#161615] border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <tr class="text-left">
                        <th class="p-4 font-medium">Name</th>
                        <th class="p-4 font-medium">Phone</th>
                        <th class="p-4 font-medium">Email</th>
                        <th class="p-4 font-medium w-32">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @isset($customers)
                        @forelse ($customers as $customer)
                            <tr class="border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                                <td class="p-4">{{ $customer->name }}</td>
                                <td class="p-4">{{ $customer->phone }}</td>
                                <td class="p-4">
                                    @if (!empty($customer->email))
                                        {{ $customer->email }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex gap-2">
                                        <a
                                            href="{{ url('/admin/customers/' . $customer->id . '/edit') }}"
                                            class="px-3 py-1 border border-[#19140035] rounded-sm hover:bg-[#FDFDFC] dark:hover:bg-[#161615]"
                                        >
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-6" colspan="4">
                                    No customers found.
                                </td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td class="p-6" colspan="4">
                                No data loaded yet. Add a controller and pass a `$customers` collection.
                            </td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
@endsection

