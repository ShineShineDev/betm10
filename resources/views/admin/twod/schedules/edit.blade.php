@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="row no-gutters">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-1">
                    <li class="breadcrumb-item active" aria-current="page">2D Schedule</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="mx-3 card border-0 shadow-sm" style="border-radius: 15px">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">Edit 2D Schedule</div>
                       
                    </div>
                </div>
                <div class="card-body">
                  <form action="{{route('admin.twod_schedules.update',$data->id)}}" method="POST"  id="editForm">
                    @csrf
                    <div class="mb-3">  
                        <label for="form-label">Type</label>
                        <select name="twod_type_id" id="type_id" class="form-control">
                            @foreach ($types as $item)
                              <option value="{{$item->id}}" {{$data->twod_type_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Opening Time</label>
                        <input type="time" name="opening_time" id="opening_time" value="{{$data->opening_time}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Closing Time ( Minutes )</label>
                        <input type="number" name="closing_time" id="closing_time" value="{{$data->closing_time}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Odd</label>
                        <input type="number" name="odd" value="{{$data->odd}}" id="odd" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">User Commission</label>
                        <input type="number" name="user_commission" value="{{$data->user_commission}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Agent Commission</label>
                        <input type="number" name="agent_commission" value="{{$data->agent_commission}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Min Amount</label>
                        <input type="number" name="min_amount" value="{{$data->min_amount}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">Max Amount</label>
                        <input type="number" name="max_amount" value="{{$data->max_amount}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Block Numbers</label>
                        <input type="text" class="form-control" name="block_numbers" value="{{$data->block_numbers}}">
                    </div>
                    <div class="form-switch">
                      <input class="form-check-input form-check-input-lg" name="status" value="1" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{$data->status ? 'checked' : ''}}>
                      <label for="flexSwitchCheckChecked">Status</label>
                    </div>
                </form>
                </div>
                <div class="card-footer bg-transparent">
                  <div class="float-end">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="editForm" class="ms-2 btn btn-success">Save</button>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\Twod\StoreTwodScheduleRequest','#editForm') !!}
@endpush