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
                    <li class="breadcrumb-item active" aria-current="page">2D Manager / 2D Number Setting</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12">
            <div class="mx-3 card border-0 shadow-sm " style="border-radius: 15px">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">Edit 2D Section</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.twod_sections.update',$data->id)}}" method="POST" id="editForm" class="d-flex gap-2 flex-wrap">
                        @csrf
                        @method('PUT')
                        <div class="mb-3" style="width: 18%">
                            <label for="">Type</label>
                            <select name="twod_type_id" class="form-control" id="" disabled>
                                @foreach ($types as $item)
                                  <option value="{{$item->id}}" {{$item->id == $data->twod_type_id ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" style="width: 18%">
                            <label for="">Opening Datetime</label>
                            <input type="datetime-local" class="form-control" readonly name="opening_datetime"  value="{{$data->opening_datetime}}">
                        </div>
                        <div class="mb-3" style="width: 18%">
                            <label for="">Closing Datetime</label>
                            <input type="datetime-local" class="form-control" name="closing_datetime" value="{{$data->closing_datetime}}">
                        </div>
                        <div class="mb-3" style="width: 18%">
                            <label for="">Odd</label>
                            <input type="numeric" class="form-control" name="odd" value="{{$data->odd}}">
                        </div>
                        <div class="mb-3" style="width: 18%">
                            <label for="">Min Amount</label>
                            <input type="numeric" class="form-control" name="min_amount" value="{{$data->min_amount}}">
                        </div>
                        <div class="mb-3" style="width: 18%">
                            <label for="">Max Amount</label>
                            <input type="numeric" class="form-control" name="max_amount" value="{{$data->max_amount}}">
                        </div>
                        <div class="mb-3" style="width: 18%">
                            <label for="">User Commission ( % )</label>
                            <input type="numeric" class="form-control" name="user_commission" value="{{$data->user_commission}}">
                        </div>
                        <div class="mb-3" style="width: 18%">
                            <label for="">Agent Commission ( % )</label>
                            <input type="numeric" class="form-control" name="agent_commission" value="{{$data->agent_commission}}">
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-transparent">
                    <button type="submit" class="btn btn-primary float-end" form="editForm">Save</button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mx-3 card border-0 shadow-sm" style="border-radius: 15px">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">2D Section Info</div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Number Limit
                        </button>
                        @include('admin.twod.sections.add-number-limit')
                    </div>
                </div>
                <div class="card-body">
                        @if (count($data->numbers))
                                <div class="mb-3 d-flex gap-4">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Number</th>
                                                <th>Min Amount</th>
                                                <th>Max Amount</th>
                                                <th>Control</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->numbers as $item)
                                                <tr>
                                                    <td>{{$item->number}}</td>
                                                    <td>{{$item->min_amount}}</td>
                                                    <td>{{$item->max_amount}}</td>
                                                    <td>
                                                        <a href="{{route('admin.numbers.store',['section_id'=>$data->id,'id'=>$item->id])}}" id="deleteBtn" onclick="return confirm('Are you sure you want to delete!')" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                    
                        @else
                            <div class="m-3 px-3 py-2 text-center text-secondary">
                                No Data Found !
                            </div>                                   
                        @endif
                    </div>
                </div>
            </div>
    </div>
    
@endsection
@push('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\Twod\StoreTwodNumberInfoRequest','#my-form') !!}
{!! JsValidator::formRequest('App\Http\Requests\Admin\Twod\UpdateTwodSectionRequest','#editForm') !!}

@endpush