@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1">
                <li class="breadcrumb-item active" aria-current="page">2D Manager</li>
            </ol>
        </nav>
        <div class="bg-white p-3 border">
            {{-- Search  --}}
            <div class="row no-gutters">
                <div class="col-md-3 px-2">
                    <div class="form-group">
                        <label for="shift">Shift</label>
                        <select class="form-control form-control-sm" id="shift">
                            <option value="all"> All </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 px-2">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control form-control-sm" id='status'>
                            <option value="all"> All </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 px-2">
                    <div class="form-group">
                        <label for="from_date">From Date</label>
                        <input type="date" id="from_date" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3 px-2">
                    <div class="form-group">
                        <label for="from_date">To Date</label>
                        <input type="date" id="to_date" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3 px-2">
                    <div class="form-group">
                        <button class="btn btn-sm btn-info shadow-sm">Search</button>
                    </div>
                </div>
            </div>
            {{-- Add Number --}}
            <div class="row no-gutters ">
                <div class="col-md-3 px-2">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="add_number"
                            placeholder="Enter Number" required>
                    </div>
                </div>
                <div class="col-md-3 px-2">
                    <div class="form-group">
                        <button class="btn btn-sm btn-info shadow-sm">Add Number</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- table --}}
    <div class="px-3">
        <div class="bg-white p-3 border">
            @include('admin.layout.partials.2d.2d_base_table')
        </div>
    </div>
@endsection
