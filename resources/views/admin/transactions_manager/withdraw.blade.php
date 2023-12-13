@extends('admin.layout.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-3">
            <li class="breadcrumb-item active" aria-current="page">Payment / Deposit</li>
        </ol>
    </nav>

    {{-- customers Table --}}
    <section class="container-fluid p-md-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th style="font-size:16px;font-weight:500">No</th>
                                    <th style="font-size:16px;font-weight:500">Name</th>
                                    <th style="font-size:16px;font-weight:500">Phone</th>
                                    <th style="font-size:16px;font-weight:500">Payment Type</th>
                                    <th style="font-size:16px;font-weight:500">Amount</th>
                                    <th style="font-size:16px;font-weight:500">Withdraw Date</th>
                                    <th style="font-size:16px;font-weight:500">Status</th>
                                    <th style="font-size:16px;font-weight:500">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdraw as $p)
                                    <tr>
                                        <td style="font-size:15px;font-weight:500">{{ $loop->iteration }}</td>
                                        <td style="font-size:15px;font-weight:500">{{ $p->customer_name }}</td>
                                        <td style="font-size:15px;font-weight:500">{{ $p->customer_phone }}</td>
                                        <td style="font-size:15px;font-weight:500">{{ $p->payment_type[0]->payment_type }}
                                        </td>
                                        <td style="font-size:15px;font-weight:500">{{ $p->customer_amount }}</td>
                                        <td style="font-size:15px;font-weight:500">{{ $p->withdraw_date }}</td>
                                        <td style="font-size:15px;font-weight:500" class="">
                                            <div
                                                class="border  {{ $p->status === 'comfirm' ? 'border-success' : 'border-primary' }} rounded-2">
                                                <h6 class="mb-0 text-center p-1 {{ $p->status === 'comfirm' ? 'text-success' : 'text-primary' }}"
                                                    style="font-size: 14px; font-weight: 500">
                                                    {{ $p->status }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td style="font-size:15px;font-weight:500">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item text-success"
                                                            href="{{ route('admin.withdraw.payment.status', $p->id) }}"><i
                                                                class="bi bi-pencil-square mr-2"></i>Approve</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
