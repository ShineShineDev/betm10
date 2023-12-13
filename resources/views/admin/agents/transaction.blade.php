@extends('admin.layout.app')
@section('content')
    <nav aria-label="breadcrumb" class="px-md-3 pt-2 p-1 mt-1 ">
        <ol class="breadcrumb p-1 ">
            <li class="breadcrumb-item active" aria-current="page">Agents / Tom Holland / Transactions</li>
        </ol>
    </nav>
    <section class="content pt-2">
        <div class="container-fluid">
            {{-- @include('admin.customers._statistics') --}}

            <div class="card">
                <div class="card-header">
                    <div class="card-title"><b>Transactions</b></div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th style="min-width: 200px">Acc Name</th>
                                <th>Phone</th>
                                <th>Transaction No</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th style="min-width:100px">Payment</th>
                                <th style="min-width:100px">Status</th>
                                <th style="min-width:100px">Date /Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 20; $i++)
                                <tr>
                                    <td> {{ $i + 1 }} </td>
                                    <td> Bwet </td>
                                    <td> +959,7912,7912 </td>
                                    <td> {{ $i + 1000 }}</td>
                                    <td> {{ rand(10000, 100000) }}</td>
                                    <td><span class="badge  {{ $i % 2 ? 'badge-success' : 'badge-info' }} "> {{ $i % 2 ? 'Deposit' : 'Withdraw' }} </span></td>
                                    <td>  {{ $i % 2 ? 'K-Pay' : 'Wave' }}</td>
                                    <td> <span class="badge  {{ $i % 2 ? 'badge-success' : 'badge-danger' }} "> {{ $i % 2 ? 'Approved' : 'Rejected' }} </span></td>
                                    <td> {{ now() }}</td>

                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer">
                <div class="float-left">
                  Total  {{$transactions->total()}}  Items
                </div>
                <div class="float-right">
                  {{$transactions->appends(request()->all())->links()}}
                </div>
              </div> --}}
            </div>
        </div>
    </section>
@endsection
