@extends('admin.layout.app')

@section('content')
<div class="px-3 pt-2">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb p-1 bg-white">
            <li class="breadcrumb-item active ml-1" aria-current="page">3D / Bet Slips</li>
        </ol>
    </nav>
</div>

@include('admin.threed._win_num_confirm')
@include('admin.threed._add_win_num_to_section')

<div class="ml-2">
    <button class="btn btn-sm ml-2 btn-secondary" data-toggle="modal" data-target="#addWinningNumber">
        <i class="bi bi-trophy"></i> Add Winning Number
    </button>
    <a href="{{ route('admin.threed.bet_logs.index') }}" class="btn btn-sm ml-2 btn-secondary">
        <i class="bi bi-boxes"></i> Numbers Detail
    </a>
</div>


<div class="px-3 mt-3">
    <div class="bg-white rounded-lg">
        <div class="p-2">
            @include('admin.threed.bet_slip._bet_slip_table')
        </div>
    </div>
</div>

@endsection