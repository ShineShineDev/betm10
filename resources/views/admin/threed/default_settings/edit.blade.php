@extends('admin.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
{{-- breadcrumb--}}
<div class="row no-gutters">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb px-2 py-1">
                <li class="breadcrumb-item active" aria-current="page">3D Manager</li>
                <li class="breadcrumb-item active" aria-current="page">Default Setting</li>
            </ol>
        </nav>
    </div>
</div>

{{-- Form --}}
<div class="row no-gutters">
    <div class="col-12 col-md-6 offset-md-3 px-2">
        <div class="mx-3 card border-0 shadow-sm bg-white rounded">
            <h4 class="card-header">
                3D Default Setting
            </h4>
            <div class="card-body">
                <form action="{{route('admin.threed.default_settings.update',1)}}" method="post" id="my-form">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Odd(Multiply)</label>
                        <input type="number" name="odd" value="{{$threed_default_setting->odd}}" required
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">R-Odd (R-Multiply)</label>
                        <input type="number" name="r_odd" value="{{$threed_default_setting->r_odd}}" required
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Min Amount</label>
                        <input type="number" name="min_amount" value="{{$threed_default_setting->min_amount}}" required
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Max Amount</label>
                        <input type="number" name="max_amount" value="{{$threed_default_setting->max_amount}}" required
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User Commission</label>
                        <input type="number" name="user_commission" value="{{$threed_default_setting->user_commission}}"
                            required class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Agent Commission</label>
                        <input type="number" name="agent_commission"
                            value="{{$threed_default_setting->agent_commission}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Closing Time(နောက်ဆုံးထိုးနိုင်မည့်အချိန်)</label>
                        <input type="time" name="closing_time" value="{{$threed_default_setting->closing_time}}"
                            required class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Block Numbers</label>
                        <textarea type="number" name="block_numbers" class="form-control"
                            placeholder="791,123,234">{{$threed_default_setting->block_numbers}}</textarea>
                        <small class="form-text text-warning">Separate by comma</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Is Maintenace ?</label>
                        <div class="form-check form-check-inline ml-2">
                            <input class="form-check-input" @if($threed_default_setting->is_maintenace == 0)
                            checked
                            @endif
                            class="form-control" value="0"
                            type="radio" name="is_maintenace" >
                            <label class="form-check-label">No</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" @if($threed_default_setting->is_maintenace == 1)
                            checked
                            @endif
                            class="form-control" value="1"
                            type="radio" name="is_maintenace">
                            <label class="form-check-label">Yes</label>
                        </div>
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
{!!
JsValidator::formRequest('App\Http\Requests\Admin\Threed\UpdateThreedDefaultSettingRequest','#my-form')
!!}
@endpush