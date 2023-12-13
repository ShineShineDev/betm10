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
        <div class="bg-white p-3 border mb-4">
            {{-- Search --}}
            <div class="d-flex ">
                <div class="bg-white py-2 px-3 w-50">
                    <h6 class="fs-14 mt-2">Bet Date</h6>
                    <div class="d-flex">
                        <form action="{{ route('admin.thaidbetslip.search') }}" enctype="multipart/form-data" method="POST"
                            class="d-flex">
                            @csrf
                            <input name="searchDate" type="date" class="form-control w-100" />
                            <div class="" style="margin-left: 20px">
                                <button type="submit" class="btn btn-primary px-4">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4 mb-3">
                        <button type="button" class="btn  btn-success px-4" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add Lottery</button>
                    </div>
                </div>
                <div class="w-100 ms-5">
                    <div class="row w-100 bg-white justify-content-end">
                        <div class="col-3">
                            <div class="mt-5 pt-5 d-block">
                                <a href="{{ route('admin.thaid.comfirm') }}">
                                    <button class="btn btn-danger mt-4">ThaiD Comfirm</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- table --}}
        <div class="">
            <div class="bg-white p-3 border">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Bet Slip</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Name</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Amount</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Reward</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Draw Date</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Bet Date</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Status</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Details</th>
                            <th style="min-width: 150px;font-size:16px;font-weight:400">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finalArray as $key => $item)
                            <tr>
                                <td style="font-size:14px;font-weight:300">#{{ $item['slip_number'] }}</td>
                                <td style="font-size:14px;font-weight:300">Si Thu</td>
                                <td style="font-size:14px;font-weight:300">{{ $item['amount'] }}</td>
                                <td style="font-size:14px;font-weight:300;color:red">
                                    {{ $item['reward'] === null ? 0 : $item['reward'] }}</td>
                                <td style="font-size:14px;font-weight:300">
                                    {{ $item['draw_date'] === null ? 0 : $item['draw_date'] }}</td>
                                <td style="font-size:14px;font-weight:300">
                                    {{ \Carbon\Carbon::parse($item['bet_date'])->format('d/m/Y h:i:s A') }}</td>
                                <td style="font-size:15px;font-weight:500" class="">
                                    <div
                                        class="border  {{ $item['is_reject'] == 0 ? 'border-success' : 'border-danger' }} rounded-2">
                                        <h6 class="mb-0 text-center p-1 {{  $item['is_reject'] == 0 ? 'text-success' : 'text-danger' }}"
                                            style="font-size: 14px; font-weight: 500">
                                            {{ $item['is_reject'] == 0 ? 'success' : 'reject' }}
                                        </h6>
                                    </div>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="border-0 bg-white" data-toggle="modal"
                                        data-target="#_id{{ $item['id'] }}">
                                        <span style="font-size:14px;font-weight:300">
                                            Details:
                                        </span>
                                    </button>
                                </td>
                                <td style="font-size:15px;font-weight:500">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item text-danger" href="{{route('admin.thiadlist.reject',$item['id'])}}"><i
                                                 class="bi bi-pencil-square mr-2"></i>Reject</a></li>
                                        </ul>
                                    </div>
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
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" style="font-size: 18px;font-weight:300" id="exampleModalLabel">ThaiD
                                Winning Number</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.thaid.price') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 my-3">
                                        <div class="d-flex">
                                            <h6 class="fw-bold mt-2">Opening Date:</h6>
                                            <select name="sectiondate" class="form-control w-25 ms-3">
                                                <option>Choose Date</option>
                                                <option value={{ $sectionDate->last()->id }}>
                                                    {{ $sectionDate->last()->opening_date }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">1s Prize (1 prize)</h6>
                                                <h6 class="text-center">6,000,000 bath</h6>
                                            </div>
                                            <input name="first_price" type="string" class="py-3" class="winner-input"
                                                style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">First 3 digits (2 prize)</h6>
                                                <h6 class="text-center">4,000 baht</h6>
                                            </div>
                                            <input name="first_three_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">Last 3 digits (2 prize)</h6>
                                                <h6 class="text-center">4,000 baht</h6>
                                            </div>
                                            <input name="last_three_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">Last 2 digits (1 prize)</h6>
                                                <h6 class="text-center">2,000 baht</h6>
                                            </div>
                                            <input name="last_two_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">Side Prize - 1st Prize (2 prize)</h6>
                                                <h6 class="text-center">100,000 baht</h6>
                                            </div>
                                            <input name="side_first_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">2nd Prize (5 prize)</h6>
                                                <h6 class="text-center">200,000 baht</h6>
                                            </div>
                                            <input name="second_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">3rd Prize (10 prize)</h6>
                                                <h6 class="text-center">80,000 baht</h6>
                                            </div>
                                            <input name="third_price" type="string" class="py-3" class="winner-input"
                                                style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">4th Prize (50 prize)</h6>
                                                <h6 class="text-center">40,000 baht</h6>
                                            </div>
                                            <input name="fourth_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">5th Prize (100 prize)</h6>
                                                <h6 class="text-center">20,000 baht</h6>
                                            </div>
                                            <input name="fifth_price" type="string" class="py-3" class="winner-input"
                                                style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer  ">
                                    <div>
                                        <div class="">
                                            <input type="hidden" value="" id="hiddenvalues" name="hiddenvalue">
                                            <button id="createBtn" type="submit" class="btn btn-success  w-100">Create
                                                Now</button>
                                            <button type="submit" class="btn btn-success  w-100 mt-3">Update Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('select[name="option"]').change(function() {
                    var selectedOption = $(this).val();
                    console.log(selectedOption);

                    // Make the AJAX request
                    fetch('{{ route('admin.thaid.option') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include the CSRF token for Laravel security
                            },
                            body: JSON.stringify({
                                selectedOption: selectedOption
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Handle the response from the server
                            console.log(data);
                        })
                        .catch(error => {
                            // Handle any errors that occur during the request
                            console.error('Error:', error);
                        });
                });
                $('select[name="sectiondate"]').change(function() {
                    var selectedOption = $(this).val();
                    // Make the AJAX request
                    fetch('{{ route('admin.editthaidwinning.number') }}?selectedOption=' + selectedOption, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include the CSRF token for Laravel security
                            }
                        })
                        .then(response => response.json())
                        .then(data => {


                            let winningNumbers = [];
                            let lastthreeprice = [];
                            let lasttwoprice = [];
                            let sidefirstprice = [];
                            let secondprice = [];
                            let thirdprice = [];
                            let fourthprice = [];
                            let fifthprice = [];

                            data.forEach((element, index) => {

                                if (element.thaidprice.price === '1-st Prize') {
                                    $('input[name="first_price"]').val(element.winning_number);
                                }
                                if (element.thaidprice.price === 'First 3 Digits') {
                                    $('#createBtn').prop('disabled', true);
                                    $('#hiddenvalues').val(1);
                                    const winningNumber = element.winning_number;
                                    winningNumbers.push(winningNumber);
                                }
                                if (element.thaidprice.price === 'Last 3 Digits') {
                                    const lasthreeprices = element.winning_number;
                                    lastthreeprice.push(lasthreeprices);
                                }
                                if (element.thaidprice.price === 'Last 2 Digits') {
                                    const lasttwoprices = element.winning_number;
                                    lasttwoprice.push(lasttwoprices);
                                }
                                if (element.thaidprice.price === 'Side Prizes') {
                                    const sidefirstprices = element.winning_number;
                                    sidefirstprice.push(sidefirstprices);
                                }
                                if (element.thaidprice.price === '2-nd Prizes') {
                                    const secondprices = element.winning_number;
                                    secondprice.push(secondprices);
                                }
                                if (element.thaidprice.price === '3-rd Prizes') {
                                    const thirdprices = element.winning_number;
                                    thirdprice.push(thirdprices);
                                }
                                if (element.thaidprice.price === '4-th Prizes') {
                                    const fourthprices = element.winning_number;
                                    fourthprice.push(fourthprices);
                                }
                                if (element.thaidprice.price === '5-th Prizes') {
                                    const fifthprices = element.winning_number;
                                    fifthprice.push(fifthprices);
                                }

                            });

                            const formattedWinningNumbers = winningNumbers.join(',');
                            $('input[name="first_three_price"]').val(formattedWinningNumbers);
                            const formattedlastthreeprice = lastthreeprice.join(',');
                            $('input[name="last_three_price"]').val(formattedlastthreeprice);
                            const formattedlasttwoprice = lasttwoprice.join(',');
                            $('input[name="last_two_price"]').val(formattedlasttwoprice);
                            const formattedsidefirstprice = sidefirstprice.join(',');
                            $('input[name="side_first_price"]').val(formattedsidefirstprice);
                            const formattedsecondprice = secondprice.join(',');
                            $('input[name="second_price"]').val(formattedsecondprice);
                            const formattedthirdprice = thirdprice.join(',');
                            $('input[name="third_price"]').val(formattedthirdprice);
                            const formattedfourthprice = fourthprice.join(',');
                            $('input[name="fourth_price"]').val(formattedfourthprice);
                            const formattedfifthprice = fifthprice.join(',');
                            $('input[name="fifth_price"]').val(formattedfifthprice);

                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });

            });
        </script>
    @endpush
