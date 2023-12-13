@extends('admin.layout.app')
@section('content')
    <nav aria-label="breadcrumb" class="px-md-3 pt-2 p-1 mt-1 ">
        <ol class="breadcrumb p-1 ">
            {{-- <li class="breadcrumb-item active" aria-current="page">Customres / Tom Holland / Transactions</li> --}}
            <h6 class="m-0">2D Betting Lists/{{ $customer->name }}'s Details</h6>
        </ol>
    </nav>
    <section class="content pt-2">
        <div class="container-fluid">
            @include('admin.customers._statistics')

            <div class="card">
                <div class="card-header">
                    <div class="card-title"><b>Transactions</b></div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;font-size:16px;font-weight:500">No</th>
                                <th style="font-size:16px;font-weight:500">BetSlips</th>
                                <th style="font-size:16px;font-weight:500">Bet Number</th>
                                <th style="font-size:16px;font-weight:500">Amount</th>
                                <th style="font-size:16px;font-weight:500">Winning Amount</th>
                                <th style="font-size:16px;font-weight:500">Date Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalAmount = 0;
                            @endphp
                            @foreach ($customerTran as $index => $c)
                            @php
                            $totalAmount += $c->total_amount;
                            @endphp
                                <tr>
                                    <td style="font-size:14px;font-weight:500">{{ $loop->iteration }}</td>
                                    <td style="font-size:14px;font-weight:500">{{ $c->slip_number }}</td>
                                    <td style="font-size:14px;font-weight:500">
                                        {{-- @php
                                            $valuesString = '';
                                            foreach ($c->bet_logs as $key => $value) {
                                                $valuesString .= $value->bet_number . ',';
                                            }
                                            $valuesString = rtrim($valuesString, ',');
                                            echo $valuesString;
                                        @endphp --}}
                                    </td>
                                    <td style="font-size:14px;font-weight:500">{{ $c->total_amount }}</td>
                                    <td style="font-size:14px;font-weight:500">{{ 0 }}</td>
                                    <td style="font-size:14px;font-weight:500">{{ $c->created_at->format('Y-m-d h:i A') }}
                                    </td>
                                </tr>
                            @endforeach
                            <td colspan="3" style="font-size:14px;font-weight:500;width:150px">Total Amount</td>
                            <td  style="font-size:14px;font-weight:500;width:150px">
                            @php
                            echo $totalAmount
                            @endphp
                            </td>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-left">
                        {{-- Total  {{$betting_lists->total()}}  Items --}}
                    </div>
                    <div class="float-right">
                        {{-- {{$betting_lists->appends(request()->all())->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
