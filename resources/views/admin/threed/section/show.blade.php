@extends('admin.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
<div class="px-3 py-3">

    {{-- {{$threed_section}} --}}

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-1 bg-transparent">
            <li class="breadcrumb-item active" aria-current="page">3D Manager / Section</li>
        </ol>
    </nav>

    @foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
    @endforeach

    <div class="mt-3">
        <div class="bg-white rounded-lg">
            <div class="p-2 pt-4">
                <a href="{{ url()->previous() }}" class="btn btn-sm py-0 pt-1 btn-info ml-4 mt-1"><i
                        class="bi bi-arrow-left-square"></i>
                </a>
                <ul class="list-group list-group-flush">
                    <div class="row pt-3">
                        <div class="col-md-6 px-4">
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Opening Date :
                                {{$threed_section->opening_date}} </li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Opening Time :
                                {{$threed_section->opening_time}} </li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Closing Time :
                                {{$threed_section->closing_time}} </li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Odd(Multiply) :
                                {{$threed_section->odd}}</li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">R-odd :
                                {{$threed_section->r_odd}} </li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Min Amount :
                                {{$threed_section->min_amount}} </li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Max amount :
                                {{$threed_section->max_amount}} </li>
                        </div>
                        <div class="col-md-6 px-4">
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">User Commission :
                                {{$threed_section->user_commission}}</li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Agent Commission :
                                {{$threed_section->agent_commission}} </li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Winning Number :
                                {{$threed_section->winning_number}}</li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Reward Users :
                                {{$threed_section->reward_users}}</li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Status :
                                @if($threed_section->status == 1)
                                <span class="badge bg-info">Opening</span>
                                @else
                                <span class="badge bg-secondary">Close</span>
                                @endif
                            </li>
                            <li class="list-group-item border-top-0 border-left-0 border-right-0 p-2">Created at : {{
                                date('d/M/Y h:i a', strtotime($threed_section['created_at'])) }} </li>
                        </div>
                    </div>
                </ul>

                <div class="pt-5 pb-5">
                    <div class="row">
                        {{-- Block Number --}}
                        <div class="col-md-6 pl-md-3">
                            <h5 class="pl-md-3 border-bottom pb-3">
                                Block Number
                                <button class="btn btn-sm bg-info float-right" data-toggle="modal"
                                    data-target="#addBlockNumberToSection">
                                    <i class="bi bi-plus"></i>Add
                                </button>
                            </h5>
                            <ul class="list-group list-group-flush">
                                @foreach($threed_section->threedBlockNumbers as $block_number )
                                <li class="list-group-item p-2 pl-3 d-flex justify-content-between align-items-center">
                                    {{$block_number->number}}
                                    <form
                                        action="{{ route('admin.threed.section.block_number.delete',$block_number->id) }}"
                                        method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('Are you sure to delete?')"
                                            class="btn btn-sm p-0 m-0"><i class="bi bi-trash"></i></button>
                                    </form>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- Number limitation --}}
                        <div class="col-md-6 pl-md-4">
                            <h5>
                                Number Limitation
                                <button class="btn btn-sm bg-info float-right" data-toggle="modal"
                                    data-target="#addNumberLimitToSection">
                                    <i class="bi bi-plus"></i>Add
                                </button>
                            </h5>
                            <table class="table table-responsive-sm table-hover pt-2">
                                <thead>
                                    <tr>
                                        <th class="p-2 bg-light borde-0">Number</th>
                                        <th class="p-2 bg-light borde-0" style="min-width: atuo">Min Amount</th>
                                        <th class="p-2 bg-light borde-0" style="min-width: atuo">Max Amount</th>
                                        <th class="p-2 bg-light borde-0" style="min-width: atuo">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($threed_section->threedNumberLimits as $number_limit )
                                    <tr>
                                        <td class="p-2"> {{$number_limit->number}} </td>
                                        <td class="p-2"> {{$number_limit->min_amount}} </td>
                                        <td class="p-2"> {{$number_limit->max_amount}} </td>
                                        <td class="p-2">
                                            <form
                                                action="{{ route('admin.threed.section.number_limit.delete',$number_limit->id) }}"
                                                method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Are you sure to delete?')"
                                                    class="btn btn-sm p-0 m-0"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.threed.section._add_block_number')
    @include('admin.threed.section._add_number_limit')
    @endsection