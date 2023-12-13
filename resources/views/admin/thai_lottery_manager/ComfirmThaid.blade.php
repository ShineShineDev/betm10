@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    @if ($groupedData)
        <div class="px-3 py-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-1">
                    <li class="breadcrumb-item active ml-1" aria-current="page">Thai Lottery Manager/ThaiD Comfirm</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-5">
                    <form enctype="multipart/form-data" method="POST"
                        action="{{ route('admin.thaid.winningnumber.section') }}">
                        @csrf
                        <div class="d-flex my-3">
                            <h6 class="mt-2" style="font-size:20px">Choose Date:</h6>
                            <select name="selectedOption" class="form-control w-50 ms-3">
                                <option>Choose Date</option>
                                <option value="{{ $sectionDate->last()->id }}">{{ $sectionDate->last()->opening_date }}
                                </option>
                            </select>
                            <button type="submit" class="btn btn-primary ms-3 btn-sm">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach ($groupedData as $item)
                    @foreach ($item as $i)
                        <div class="col-4 my-3 ">
                            <div class="border-bottom">
                                <h1 class="text-center text-uppercase" style="font-size: 20px;font-weight:bold">
                                    {{ $i['thaidprice']['price'] }}
                                </h1>
                                <h6 class="text-center text-capitalize my-3" style="font-size: 16px">
                                    {{ $i['winning_number'] }}
                                </h6>
                            </div>
                        </div>
                    @endforeach
                @endforeach

                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.thaidcomfirm.list') }}">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <input type="hidden" value="{{$sectionDate->last()->id}}" name="id" id="">
                        <button class="btn btn-success w-25 d-block">
                            All Comfirm
                        </button>
                </form>
                <button id="handleback" class="btn btn-danger w-25 ms-3">
                    Cancel
                </button>
            </div>
        </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="mt-5 pt-5 col-10">
                <h1 class="fw-bold fs-18 text-center text-danger mt-5 pt-5">You Need to Add Winning Number!</h1>
                <button id="handleback" class="btn btn-danger w-25 ms-3 mt-5 d-block mx-auto">
                    Back
                </button>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#handleback').click(function() {
                history.back();
            });
        });
    </script>
@endpush
