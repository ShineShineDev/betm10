@extends('admin.layout.app')
@push('css')
<link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
<div class="px-3 pt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-1">
            <li class="breadcrumb-item active ml-1" aria-current="page">3 D/ Slip</li>
        </ol>
    </nav>
</div>

<div class="px-3">
    <div class="bg-white rounded-lg p-3">
        <a href="{{ url()->previous() }}" class="btn btn-sm py-0 pt-1 btn-secondary   mt-1"><i
                class="bi bi-arrow-left-square text-white"></i></a>
        <h5 class="mt-3">Bet Slip : </h5>
        <h5>Date : </h5>
        <table class="table table-responsive-sm table-striped table-hover p-5">
            <thead>
                <tr>
                    <th class="p-2 bg-light borde-0">#</th>
                    <th class="p-2 bg-light borde-0" style="min-width: 200px">Bet Number</th>
                    <th class="p-2 bg-light borde-0" style="min-width: 100px">Bet Amount</th>
                    <th class="p-2 bg-light borde-0">Reward</th>
                </tr>
            </thead>
            <tbody>
                @foreach($threed_bet_slip->threeDBettingLogs as $index => $three_d_betting_log)
                <tr>
                    <td> {{$index++}}</td>
                    <td> {{$three_d_betting_log->bet_number}}</td>
                    <td> {{$three_d_betting_log->bet_amount}}</td>
                    <td>
                        {{$three_d_betting_log->received_winning}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection