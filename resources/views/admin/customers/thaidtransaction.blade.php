@extends('admin.layout.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0">ThaiD Betting Lists /{{ $customer->name }}'s Details</h6>
                </div><!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content pt-3">
        <div class="container-fluid">
            @include('admin.customers._statistics')

            <div class="card">
                <div class="card-header">
                    <div class="card-title"><b>Thaid Transactions</b></div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;font-size:16px;font-weight:500">No</th>
                                <th style="font-size:16px;font-weight:500">BetSlip</th>
                                <th style="font-size:16px;font-weight:500">Name</th>
                                <th style="font-size:16px;font-weight:500">Amount</th>
                                <th style="font-size:16px;font-weight:500">Reward</th>
                                <th style="font-size:16px;font-weight:500">Draw Date</th>
                                <th style="font-size:16px;font-weight:500">Bet Date</th>
                                <th style="font-size:16px;font-weight:500">Bet Number</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            @php
                                $totalAmount = 0;
                            @endphp
                            @foreach ($finalArray as $key => $item)
                                @php
                                    $totalAmount += $item['amount'];
                                @endphp
                                <tr>
                                    <td style="font-size:14px;font-weight:500">{{ $loop->iteration }}</td>
                                    <td style="font-size:14px;font-weight:500">#{{ $item['slip_number'] }}</td>
                                    <td style="font-size:14px;font-weight:500">{{ $item['name'] }}</td>
                                    <td style="font-size:14px;font-weight:500">{{ $item['amount'] }}</td>
                                    <td style="font-size:14px;font-weight:500;color:red">
                                        {{ $item['reward'] === null ? 0 : $item['reward'] }}</td>
                                    <td style="font-size:14px;font-weight:500">
                                        {{ $item['draw_date'] === null ? 0 : $item['draw_date'] }}</td>
                                    <td style="font-size:14px;font-weight:500">
                                        {{ \Carbon\Carbon::parse($item['bet_date'])->format('d/m/Y h:i:s A') }}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="border-0 bg-white" data-toggle="modal"
                                            data-target="#_id{{ $item['id'] }}">
                                            <span style="font-size:14px;font-weight:500">
                                                Details:
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" style="margin-top: 150px" id="_id{{ $item['id'] }}" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="">
                                                    <h1 class="modal-title  " id="staticBackdropLabel"
                                                        style="font-size: 18px;font-weight:300">
                                                        Bet Slip :#{{ $item['slip_number'] }}</h1>
                                                    @php
                                                        $betDate = \Carbon\Carbon::parse($item['bet_date']);
                                                    @endphp
                                                    <h1 class="modal-title " id="staticBackdropLabel"
                                                        style="font-size: 18px;font-weight:300">
                                                        Date:{{ $betDate->format('d F A') }}</h1>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row my-3 py-2"
                                                    style="border:1px solid #0000006a;border-left:0;border-right:0">
                                                    <div class="col-3 text-center" style="font-size:15px;font-weight:400">#
                                                    </div>
                                                    <div class="col-3  text-center" style="font-size:15;font-weight:400">
                                                        Number
                                                    </div>
                                                    <div class="col-3  text-center" style="font-size:15px;font-weight:400">
                                                        Amount</div>
                                                    <div class="col-3  text-center" style="font-size:15px;font-weight:400">
                                                        Reward</div>
                                                </div>

                                                @foreach ($item['data'] as $ind_s)
                                                    <div class="row my-2">
                                                        <div class="col-3  text-center"
                                                            style="font-size:14px;font-weight:300">
                                                            {{ $loop->iteration }}</div>
                                                        <div class="col-3  text-center"
                                                            style="font-size:14px;font-weight:300">
                                                            {{ $ind_s['bet_number'] }}</div>
                                                        <div class="col-3  text-center"
                                                            style="font-size:14px;font-weight:300">
                                                            {{ $ind_s['price'] }}</div>
                                                        <div class="col-3  text-center"
                                                            style="font-size:14px;font-weight:300">
                                                            {{ $ind_s['reward'] }}</div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <td colspan="3" style="font-size:14px;font-weight:500;width:150px">Total Amount</td>
                            <td style="font-size:14px;font-weight:500;width:150px">
                                @php
                                    echo $totalAmount;
                                @endphp
                            </td>
                        </tbody>
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
