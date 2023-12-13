@extends('admin.layout.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h6 class="m-0">Transaction /{{ $customer->name }}'s Details</h6>
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
                    <div class="card-title"><b>Transactions</b></div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;font-weight:400">No</th>
                                <th style="font-weight:400">Transaction ID</th>
                                <th style="font-weight:400">Provider</th>
                                <th style="font-weight:400">Type</th>
                                <th style="font-weight:400">Amount</th>
                                <th style="font-weight:400">Status</th>
                                <th style="font-weight:400">Transaction_Model</th>
                                <th style="font-weight:400">Transaction_Type</th>
                                <th style="font-weight:400">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customerTran as $index => $t)
                                <tr>
                                    <td style="font-weight:400;font-size:15px">{{ $loop->iteration }}</td>
                                    <td style="font-weight:400;font-size:15px">{{ $t->transaction_id }}</td>
                                    <td style="font-weight:400;font-size:15px">{{ $t->payer_account_name }}</td>
                                    <td style="font-weight:400;font-size:15px">
                                        {{ $t->type === 'addition' ? 'ငွေသွင်း' : 'ငွေထုတ်' }}</td>
                                    <td style="font-weight:400;font-size:15px">{{ $t->amount }}</td>
                                    <td style="font-weight:400;font-size:15px"><span
                                            class="badge badge-success">{{ $t->status }}</span></td>
                                     <td style="font-weight:400;font-size:15px;text-transform:capitalize"> {{ $t->transaction_model }}</td>
                                     <td style="font-weight:400;font-size:15px;text-transform:capitalize"> {{ $t->transaction_type }}</td>
                                    <td style="font-weight:400;font-size:15px"> {{ $t->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-left">
                        {{-- Total  {{$transactions->total()}}  Items --}}
                    </div>
                    <div class="float-right">
                        {{-- {{$transactions->appends(request()->all())->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
