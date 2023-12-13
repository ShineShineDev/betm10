@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1 bg-transparent">
                <li class="breadcrumb-item active" aria-current="page">Thai Lottery Manager</li>
                <li class="breadcrumb-item active" aria-current="page">Number Detail</li>
            </ol>
        </nav>
        <div class="bg-white p-3 border">
            <div class="row no-gutters">
                <div class="  px-2 d-flex " style="width: 100%">
                    <div class="text-center col-3 rounded d-flex justify-content-around" style="background: #B7E5CD">
                        <div>
                            <p class="mt-3 mb-0">Total Bet Amounts</p>
                            <p><b>{{ $Obj['total_price'] }}</b></p>
                        </div>
                    </div>
                    <div class="text-center col-3  rounded d-flex justify-content-around ms-5" style="background: #FEC9DF">
                        <div>
                            <p class="mt-3 mb-0">Total Tickets</p>
                            <p><b>{{ count($Obj['data']) }}</b></p>
                        </div>
                    </div>
                    <div class="mt-4 ms-5">
                        <span class=""><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                fill="currentColor" class="bi bi-clipboard2-fill" viewBox="0 0 16 16">
                                <path
                                    d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z" />
                                <path
                                    d="M3.5 1h.585A1.498 1.498 0 0 0 4 1.5V2a1.5 1.5 0 0 0 1.5 1.5h5A1.5 1.5 0 0 0 12 2v-.5c0-.175-.03-.344-.085-.5h.585A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1Z" />
                            </svg></span>
                    </div>
                    <div class="text-center col-3 ms-5  rounded d-flex justify-content-left">
                        <div class="mt-3 d-flex">
                            <form enctype="multipart/form-data" method="POST" action="{{ route('admin.thaidsearch.list') }}"
                                class="d-flex">
                                @csrf
                                <input name="searchnumber"
                                    class="form-control w-100 border-top-0 border-left-0 border-right-0"
                                    placeholder="search number" />
                                <button type="submit" class="bg-white border-0">
                                    <svg class="ms-3" xmlns="http://www.w3.org/2000/svg"
                                        style="position: relative;top:-10px" width="22" height="22"
                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="bg-white p-3 border">
                <div class="row no-gutters">
                    @foreach ($Obj['data'] as $item)
                        <div class="col-md-2 text-center col-6 rounded ">
                            <div class="card px-1 py-3 m-2 shadow-sm  text-primary rounded-4" style="background: #E4E4FC">
                                {{ $item->bet_number }} <br>
                                <b><span class="text-danger">{{ $item->price }}</span></b>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
