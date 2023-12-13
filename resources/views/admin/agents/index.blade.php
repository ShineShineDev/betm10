@extends('admin.layout.app')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="content-header">
        {{-- head  --}}
    </div>
    {{-- Agents Table --}}
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row card">
                <div class="col-12">
                    <form action="{{ route('admin.tran.filter') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="shadow-lg d-flex my-4" style="width:35%;margin-left:200px">
                                    <div class="w-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            viewBox="0 0 40 40" class="mt-2 ms-3" fill="none">
                                            <g clip-path="url(#clip0_758_353)">
                                                <path
                                                    d="M20 40L15 32.5H17.5V27.5H22.5V32.5H25L20 40ZM37.5 2.5V22.5H2.5V2.5H37.5ZM40 0H0V25H40V0Z"
                                                    fill="#43A547" />
                                                <path
                                                    d="M20 5C21.9891 5 23.8968 5.79018 25.3033 7.1967C26.7098 8.60322 27.5 10.5109 27.5 12.5C27.5 14.4891 26.7098 16.3968 25.3033 17.8033C23.8968 19.2098 21.9891 20 20 20H32.5V17.5H35V7.5H32.5V5H20ZM12.5 12.5C12.5 10.5109 13.2902 8.60322 14.6967 7.1967C16.1032 5.79018 18.0109 5 20 5H7.5V7.5H5V17.5H7.5V20H20C18.0109 20 16.1032 19.2098 14.6967 17.8033C13.2902 16.3968 12.5 14.4891 12.5 12.5Z"
                                                    fill="#43A547" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_758_353">
                                                    <rect width="40" height="40" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="w-100 py-3 px-2" style="background: #43A547">
                                        <h6 class="text-white mb-0" style="font-weight: 600">135,841</h6>
                                        <h6 class="text-white mb-0" style="font-weight: 200;font-size:10px">Total Deposit
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="shadow-lg d-flex my-4" style="width:35%;margin-left:200px">
                                    <div class="w-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            class="mt-2 ms-3" viewBox="0 0 40 40" fill="none">
                                            <g clip-path="url(#clip0_758_361)">
                                                <path
                                                    d="M20 0L25 7.5H22.5V12.5H17.5V7.5H15L20 0ZM37.5 17.5V37.5H2.5V17.5H37.5ZM40 15H0V40H40V15Z"
                                                    fill="#FA8101" />
                                                <path
                                                    d="M20 20C20.9849 20 21.9602 20.194 22.8701 20.5709C23.7801 20.9478 24.6069 21.5003 25.3033 22.1967C25.9997 22.8931 26.5522 23.7199 26.9291 24.6299C27.306 25.5398 27.5 26.5151 27.5 27.5C27.5 28.4849 27.306 29.4602 26.9291 30.3701C26.5522 31.2801 25.9997 32.1069 25.3033 32.8033C24.6069 33.4997 23.7801 34.0522 22.8701 34.4291C21.9602 34.806 20.9849 35 20 35H32.5V32.5H35V22.5H32.5V20H20ZM12.5 27.5C12.5 25.5109 13.2902 23.6032 14.6967 22.1967C16.1032 20.7902 18.0109 20 20 20H7.5V22.5H5V32.5H7.5V35H20C18.0109 35 16.1032 34.2098 14.6967 32.8033C13.2902 31.3968 12.5 29.4891 12.5 27.5Z"
                                                    fill="#FA8101" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_758_361">
                                                    <rect width="40" height="40" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="w-100 py-3 px-2" style="background: #FA8101">
                                        <h6 class="text-white mb-0" style="font-weight: 600">135,841</h6>
                                        <h6 class="text-white mb-0" style="font-weight: 200;font-size:10px">Total Withdraw
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mb-4">
                                <div style="width: 60%;margin: 0 auto;">
                                    <label for="" style="font-weight: 300" class="d-block">Status</label>
                                    <select name="status" class="form-control" style="border-radius: 10px" id="">
                                        <option value="deposit">Deposit</option>
                                        <option value="pending">Pending</option>
                                        <option value="comfirm">Comfirm</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="width: 60%; margin: 0 auto;">
                                    <label for="" style="font-weight: 300" class="d-block">From Date</label>
                                    <input name="from_date" type="date" class="form-control rounded-2">
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="width: 60%;margin: 0 auto">
                                    <label for="" style="font-weight: 300" class="d-block">To Date</label>
                                    <input type="date" name="to_Date" class="form-control rounded-2">
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="width: 60%;margin: 0 auto;margin-top:35px">
                                    <button class="border-0" style="background: #D5B7FF;border-radius:10px">
                                        <h6 class="mb-0 text-white py-2 px-4" style="font-weight: 400;font-size:15px">Search
                                        </h6>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;font-weight:300">NO</th>
                                        <th style="font-weight: 300">Acc Name</th>
                                        <th style="font-weight: 300">Phone/acc No</th>
                                        <th style="font-weight: 300">Transaction No/Time</th>
                                        <th style="font-weight: 300">Amount</th>
                                        <th style="font-weight: 300">Type</th>
                                        <th style="font-weight: 300">Bank</th>
                                        <th style="font-weight: 300">Date/Time</th>
                                        <th style="font-weight: 300">Status</th>
                                        <th style="font-weight: 300">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalAmount = 0;
                                    @endphp
                                   
                                    @foreach ($data as $item)
                                        <tr>
                                            <td style="font-weight: 300">{{ $loop->iteration }}</td>
                                            <td style="font-weight: 300">{{ $item->payer_account_name }}</td>
                                            <td style="font-weight: 300">{{ $item->payer_account_phone }}</td>
                                            <td style="font-weight: 300">{{ Str::limit($item->transaction_id, 10) }}</td>
                                            <td style="font-weight: 500;color:red">{{ $item->amount }}
                                            @php
                                            $totalAmount += $item->amount;
                                            @endphp
                                            </td>
                                            <td style="font-weight: 300;color:blue;text-transform:capitalize">
                                                {{ $item->type }}</td>
                                            <td style="font-weight: 300">KBZ</td>
                                            <td style="font-weight: 300">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/y H:s:i A') }}
                                            </td>
                                            <td>
                                                <h6 class="mb-0"
                                                    style="font-weight: 500;color:blue;background-color:rgba(0, 0, 255, 0.374);border-radius:20px;padding:10px 20px;text-align:center;text-transform:capitalize">
                                                    {{ $item->status }}</h6>
                                            </td>
                                            <td>
                                                <button class="bg-white border-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                        fill="currentColor" class="bi bi-pencil-square"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4"></td>
                                        <td style="font-weight: 500;color:red">@php echo $totalAmount @endphp</td>
                                        <td colspan="5"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
