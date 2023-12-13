@extends('admin.layout.app')
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
                <div class="card p-1">
                    <div class="card-body text-center" style="background: #B7E5CD">
                        Total Bet Amounts<br>
                        <b>123,444</b>
                    </div>
                </div>
            </div>
            <div class="col-md-2 ">
                <a href="{{ route('admin.threed.section.show',$lateset_section->id) }}">
                    <div class="card p-1">
                        <div class="card-body text-center" style="background: #B7E5CD">
                            {{$lateset_section->opening_date }}<br>
                            {{ date('g:i a', strtotime($lateset_section->opening_time)) }}
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>


    @include('admin.threed.bet_logs._bet_log_card')

    @endsection