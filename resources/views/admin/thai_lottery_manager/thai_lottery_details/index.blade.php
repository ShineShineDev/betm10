@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        {{-- table --}}
        <div class="px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-1 bg-transparent">
                    <li class="breadcrumb-item active" aria-current="page">Thai Lottery Manager</li>
                    <li class="breadcrumb-item active" aria-current="page">Thai Lottery Details</li>
                </ol>
            </nav>
            <div class="bg-white p-3 border">
                @include('admin.layout.partials.3d.3d_details')
            </div>
        </div>
    @endsection
