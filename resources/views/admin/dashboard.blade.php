@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <div class="max-w-4xl">
        @include('admin.dashboard.partials.overview_intro')
        @include('admin.dashboard.partials.overview_cards')
    </div>
@endsection

