@extends('admin.layout.app')
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush --}}
@section('content')
    <div class="row no-gutters">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb px-2 py-1">
                    <li class="breadcrumb-item active" aria-current="page">2D Manager</li>
                    <li class="breadcrumb-item active" aria-current="page">Number Detail</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="mx-3 card border-0 shadow-sm bg-white" style="border-radius: 15px">
                <div class="card-header">
                    Default Setting
                </div>
                <div class="card-body">
                    <form action="{{route('admin.twod_default_settings.update')}}" method="POST"  id="my-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="">Opening Time</label>
                            <input type="time" name="opening_time" value="{{$data?->opening_time}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Closing Time ( Minutes )</label>
                            <input type="number" name="closing_time" value="{{$data?->closing_time}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Odd</label>
                            <input type="number" name="odd" value="{{$data?->odd}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">User Commission</label>
                            <input type="number" name="user_commission" value="{{$data?->user_commission}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Agent Commission</label>
                            <input type="number" name="agent_commission" value="{{$data?->agent_commission}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Min Amount</label>
                            <input type="number" name="min_amount" value="{{$data?->min_amount}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Max Amount</label>
                            <input type="number" name="max_amount" value="{{$data?->max_amount}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Block Numbers</label>
                            <input type="text" class="form-control" name="block_numbers" value="{{$data?->block_numbers}}">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\TwodManager\TwodDefaultSettings\UpdateTwodDefaultSettingRequest','#my-form') !!}
@endpush