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
    {{-- <div class="row no-gutters">
        <div class="col-12">
            <div class="mx-3 card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2 d-flex flex-column">
                            <h5 class="fw-bold">2D Bet Setting</h5>
                        </div>
                        <div class="col-10">
                            <form action="" method="">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3 d-flex gap-2">
                                            <label for="" class="mb-0 text-nowrap">Odd</label>
                                            <input type="number" class="form-control">
                                        </div>
                                        <div class="mb-3 d-flex gap-2">
                                            <label for="" class="mb-0 text-nowrap">User Comission</label>
                                            <input type="number" class="form-control">
                                        </div>
                                        <div class="mb-3 d-flex gap-2 text-nowrap">
                                            <label for="" class="mb-0">Agent Comission</label>
                                            <input type="number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3 d-flex gap-2">
                                            <label for="" class="mb-0 text-nowrap">Limit Per Number</label>
                                            <input type="number" class="form-control">
                                        </div>
                                        <div class="mb-3 d-flex gap-2">
                                            <label for="" class="mb-0 text-nowrap">Blocked Number</label>
                                            <input type="number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="flexRadioDefault1" class=" text-nowrap">Maintanance</label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                      No
                                                    </label>
                                                  </div>
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                      Yes
                                                    </label>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <button class="btn btn-primary px-3 float-end">Save</button>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row no-gutters">
        <div class="col-12">
            <div class="card border-0 shadow-sm mx-3" style="border-radius: 10px">
                <div class="card-body">
                    <form action="" class="d-flex gap-2 justify-content-center">
                        <div class="">
                            <label for="">Type</label>
                            <select name="" id="" class="form-control">
                                <option value="">All</option>
                                @foreach ($types as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="">From Date</label>
                            <input type="date" name="" class="form-control" id="">
                        </div>
                        <div class="">
                            <label for="">To Date</label>
                            <input type="date" name="" class="form-control" id="">
                        </div>
                        <div class="d-flex flex-column">
                            <label for=""> .</label>
                            <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12">
            <div class="mx-3 card border-0 shadow-sm" style="border-radius: 15px">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">2D Section</div>
                        {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Bet Round
                        </button>
                        @include('admin.twod.sections.create') --}}
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th style="min-width: 200px">Draw Date</th>
                                    <th>Shit</th>
                                    <th style="min-width: 100px">Total Bets</th>
                                    <th>Commission</th>
                                    <th style="min-width: 200px">Total Rewards</th>
                                    <th>Revenue</th>
                                    <th>Status</th>
                                    <th>Control</th>
                                </tr>
                                </thead>
                            <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->type?->name ?? '---'}}</td>
                                    <td>{{Carbon\Carbon::parse($item->opening_datetime)->format('d-m-Y')}}</td>
                                    <td>{{Carbon\Carbon::parse($item->opening_datetime)->format('h:i A') }} - {{Carbon\Carbon::parse($item->opening_datetime)->format('A') == "AM" ? 'Morning' : 'Evening'}}</td>
                                    <td><div class="text-primary font-weight-bolder">{{number_format($item->bet_slips_sum_total_amount) ?? 0}}</div></td>
                                    <td><div class="text-danger font-weight-bolder">0</div></td>
                                    <td><div class="text-danger font-weight-bolder">{{number_format($item->total_reward_amount) ?? 0}}</div></td>
                                    @php
                                        $revenue = $item->bet_slips_sum_total_amount - ( $item->total_reward_amount );
                                    @endphp
                                    <td>
                                        <div class="{{ $revenue > 0 ? 'text-success' : 'text-danger'}} font-weight-bolder">{{number_format($revenue)}}</div>
                                    </td>
                                    <td>
                                        @if ($item->ended)
                                            <div class="text-danger font-weight-bolder">Closing</div>                                            
                                        @else
                                            <div class="text-success font-weight-bolder">Opening</div>                                            
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                              <li><a class="dropdown-item" href="{{route('admin.twod_sections.edit',$item->id)}}"><i class="bi bi-pencil-square mr-2"></i>Edit</a></li>
                                              <li><a class="dropdown-item" href="{{route('admin.twod_sections.show',$item->id)}}"><i class="bi bi-eye mr-2"></i> View</a></li>
                                              <li><a class="dropdown-item" href="#"><i class="bi bi-trash mr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer bg-transparent float-end py-0">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\Twod\StoreTwodSectionRequest','#my-form') !!}
@endpush