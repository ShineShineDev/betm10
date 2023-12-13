@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1">
                <li class="breadcrumb-item active ml-1" aria-current="page">Thai Lottery Manager</li>
            </ol>
        </nav>
        <div class="bg-white p-3 border mb-4 w-100">
            {{-- Search --}}
            <div class="mt-4">
                <div>
                    <h6 style="font-size:18px;font-weight:300">Odd - {{ $odd }}</h6>
                </div>
                <div>
                    <h6 style="font-size:18px;font-weight:300">Total Tickets - {{ count($data) }}</h6>
                </div>
                <div>
                    <h6 style="font-size:18px;font-weight:300">Reward Amount - {{ $ReturnBath }} Ks</h6>
                </div>

               @if(count($data) != 0)
                <form action="{{ route('admin.thaid.winner.comfirm') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button typ="submit" class="btn btn-success my-3">All Comfirm</button>
                </form>
               @endif
            </div>
        </div>
        {{-- table --}}
        <div class="">
            <div class="bg-white p-3 border">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">No</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Name</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Customer Bet Num</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Winning Number</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Customer Bet Amt</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Winning Amount</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td style="font-size:14px;font-weight:300">{{ $loop->iteration }}</td>
                                <td style="font-size:14px;font-weight:300">{{ $item['betslip'][0]['customer'][0]['name'] }}
                                </td>
                                <td style="font-size:14px;font-weight:300">{{ $item['bet_number'] }}</td>
                                <td style="font-size:14px;font-weight:300">{{ $item['thaidprice'][0]['winning_number'] }}
                                </td>
                                <td style="font-size:14px;font-weight:300">{{ $item['price'] }}</td>
                                <td style="font-size:14px;font-weight:300">
                                    {{ $item['thaidprice'][0]['thaidprice']['amount'] }} -Bath</td>
                                <td style="font-size:15px;font-weight:500" class="">
                                    <div
                                        class="border  {{ $item['reward'] !== 0 ? 'border-success' : 'border-primary' }} rounded-2">
                                        <h6 class="mb-0 text-center p-1 {{ $item['reward'] !== 0 ? 'text-success' : 'text-primary' }}"
                                            style="font-size: 14px; font-weight: 500">
                                            {{ $item['reward'] !== 0 ? 'success' : 'pending' }}
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
