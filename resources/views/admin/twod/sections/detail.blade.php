@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1 bg-transparent">
                <li class="breadcrumb-item active" aria-current="page">3D Manager</li>
                <li class="breadcrumb-item active" aria-current="page">Number Detail</li>
            </ol>
        </nav>
        <div class="bg-white p-3 border">
            <div class="row no-gutters">
                <div class="col-md-3  px-2">
                    <div class="text-center rounded d-flex justify-content-around" style="background: #B7E5CD">
                        <div>
                            <p class="mt-3 mb-0">Total Bet Amounts</p>
                            <p><b>{{number_format($data->bet_slips_sum_total_amount)}}</b></p>
                        </div>
                        <div class="d-flex text-align-center">
                            <button class="btn btn-sm"><i style="font-size: 20px"
                                    class="bi bi-sort-alpha-down"></i></button>
                            <button class="btn btn-sm"><i style="font-size: 20px"
                                    class="bi bi-clipboard-check"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="bg-white p-3 border">
                <div class="row no-gutters">
                    @foreach ($totalsByNumber as $key => $item)
                        <div class="col-md-2 text-center col-6 rounded ">
                            <div class="card px-1 py-3 m-2 shadow-sm " style="background: #E4E4FC">
                                 <div class="text-primary">{{ $key }}</div>
                                <b class="text-danger">{{ $item }}</b>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
