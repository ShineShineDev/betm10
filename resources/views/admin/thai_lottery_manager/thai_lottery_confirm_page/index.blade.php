@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1">
                <li class="breadcrumb-item active ml-1" aria-current="page">Thai Lottery Manager</li>
                <li class="breadcrumb-item active ml-1" aria-current="page">Thai Lottery Confirm page</li>
            </ol>
        </nav>
     <div class="bg-white py-2 px-3">
        <h6 class="fs-14 mt-2">Draw Date</h6>
       <div class="d-flex">
         <select class="form-control w-25">
            <option>
                Choose Draw Date
            </option>
        </select>
       <div class="" style="margin-left: 20px"> 
         <button class="btn btn-primary px-4">Search</button>
       </div>
       </div>
       <div class="mt-4 mb-3">
        <button class="btn btn-success px-4">Add Lottery</button>
       </div>
     </div>
    </div>

    {{-- table --}}
    <div class="px-3">
        <div class="bg-white p-3 border">
            @include('admin.layout.partials.3d.3d_base_table')
        </div>
    </div>
@endsection
