@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1 bg-transparent">
                <li class="breadcrumb-item active" aria-current="page">Thaid / Section</li>
            </ol>
        </nav>
        {{-- Validation Error Alert --}}
        @include('admin.validation-error-alert')
        <div class="d-md-flex justify-content-between align-items-sm-center">
            <div>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#addSection">
                    <i class="bi bi-calendar-month mr-1"></i> Add Section
                </button>
                <button class="btn btn-sm ml-2 btn-secondary" data-toggle="modal" data-target="#addWinningNumber">
                    <i class="bi bi-trophy"></i> Add Winning Number
                </button>
            </div>
            <div class="row">
                <form class="form-inline" method="GET" action="">
                    @include('admin.layout.partials.date_search')
                </form>
            </div>
        </div>

        {{-- @include('admin.threed._add_win_num_to_section') --}}
        @include('admin.thaid.section._add_section')
        @include('admin.thaid.section._section_table')
    @endsection
