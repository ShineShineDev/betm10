@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="row no-gutters">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-1">
                    <li class="breadcrumb-item active" aria-current="page">2D Manager / 2D Number Setting</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12">
            <div class="card mx-3 border-0 shadow-sm" style="border-radius: 15px">
                <div class="card-header">
                    <form action="{{route('admin.twod_section.confirm_winning_number')}}" method="POST" id="confirmSectionForm">
                        @csrf
                        <div class="mb-2">
                            <label >Sections</label>
                            <select name="section_id" class="form-control w-100 " id="sectionSelectBox">
                                <option value="">--- select section ---</option>
                                @foreach ($sections as $item)
                                    @if ($item->winning_number != null && $item->status != 1)
                                        <option value="{{$item->id}}" class="{{$item->ended ? 'text-danger' : 'text-success'}} "> 
                                            {{Carbon\Carbon::parse($item->opening_datetime)->format('d-m-Y h:i A')}}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                  <div class="d-flex mb-2">
                    <div class="fw-bold" style="width: 40%" >Winning Number :</div>
                     <div class="" id="winningNumberVal">--</div>
                  </div>
                  <div class="d-flex mb-2">
                    <div class="fw-bold" style="width: 40%" >Odd :</div>
                     <div class="" id="oddVal">--</div>
                  </div>
                  <div class="d-flex mb-2">
                    <div class="fw-bold" style="width: 40%" >Total Slips :</div>
                     <div class="" id="totBetSlipsVal">--</div>
                  </div>
                  <div class="d-flex mb-2">
                    <div class="fw-bold" style="width: 40%" >Reward Amount :</div>
                     <div class="" id="rewardAmountVal">------</div>
                  </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="float-end">
                        <a href="" class="btn btn-outline-dark">Cancel</a>
                        <button onclick="return confirm('A u sure')" class="btn btn-danger ms-2" form="confirmSectionForm">Confirm</button>
                    </div>
                </div>
              </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12">
            <div class="card border-0 shadow-sm mx-3">
                <div class="card-body">
                    <form action="" class="d-flex gap-2">
                        <div class="">
                            <label for="">Shift</label>
                            <select name="" id="" class="form-control">
                                <option value="">--select shift--</option>
                                <option value="">--select shift--</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="">From Date</label>
                            <input type="date" name="" class="form-control" id="">
                        </div>
                        <div class="">
                            <label for="">To Date</label>
                            <input type="date" name="" class="form-control" id="">
                        </div>
                        <div class="d-flex flex-column">
                            <label for=""> .</label>
                            <button type="submit" class="btn btn-info">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12">
            <div class="mx-3 card border-0 shadow-sm" style="border-radius: 15px">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">2D Section</div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-plus-circle mr-2"></i> Add Number
                        </button>
                        @include('admin.twod.sections.add-winning-number')
                        @include('admin.twod.bet_slips.detail')

                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="min-width: 200px">Bet Slip</th>
                                    <th>Name</th>
                                    <th style="min-width: 100px">Amount</th>
                                    <th>Reward</th>
                                    <th style="min-width: 200px">Draw Date</th>
                                    <th>Bet Date</th>
                                    <th>Status</th>
                                    <th>Control</th>
                                </tr>
                                </thead>
                            <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->slip_number}}</td>
                                    <td>{{$item->customer?->name}}</td>
                                    <td>{{number_format($item->total_amount) ?? 0}}</td>
                                    <td><div class="text-danger font-weight-bolder">{{number_format($item->bet_logs->sum('reward_amount')) ?? 0}}</div></td>
                                    <td>{{Carbon\Carbon::parse($item->bet_date)->format('d-m-Y H:i A')}}</td>
                                    <td>{{Carbon\Carbon::parse($item->bet_date)->format('d-m-Y H:i A')}}</td>
                                    <td>
                                        @if ($item->is_reject)
                                            <div class="btn btn-sm px-3 font-weight-bolder" style="border-radius: 0.8125rem;
                                            background: rgba(242, 78, 30, 0.30);color: #F24E1E;font-weight: 400;">Reject</div>
                                        @else
                                            @if ($item->section?->ended)
                                                <div class="btn btn-sm px-3 font-weight-bolder" style="border-radius: 0.8125rem;
                                                background:  rgba(242, 78, 30, 0.30);color: #F24E1E;font-weight: 400;">Finish</div>
                                            @else
                                                <div class="btn btn-sm px-3 font-weight-bolder" style="border-radius: 0.8125rem;
                                                background: #E0EBE5;color: #279958;font-weight: 400;">Active</div>
                                            @endif
                                        @endif
                                      
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                              <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square mr-2"></i>Edit</a></li>
                                              <li>
                                                <a class="dropdown-item" id="showBtn" data-id="{{$item->id}}">
                                                    <i class="bi bi-eye mr-2"></i> View
                                                </a>
                                                </li>
                                              <li><a class="dropdown-item" href="#"><i class="bi bi-trash mr-2"></i> Delete</a></li>
                                              <li><hr class="dropdown-divider"></li>
                                              @if ($item->is_reject)
                                              <form action="{{route('admin.twod_bet_slips.reject',$item->id)}}" method="POST">
                                                @csrf
                                                <li><button class="dropdown-item" type="submit"><i class="bi bi-check2 mr-2"></i> Accept</button></li>
                                                </form>
                                              @else
                                              <form action="{{route('admin.twod_bet_slips.reject',$item->id)}}" method="POST">
                                                @csrf
                                                <li><button class="dropdown-item" type="submit"><i class="bi bi-x-circle mr-2"></i> Reject</button></li>
                                                </form>
                                              @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer bg-transparent float-end py-0">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\Twod\StoreTwodSectionRequest','#my-form') !!}

<script>
    $('#sectionSelectBox').on('change',function(){
        const sectionId = $(this).val();
        $.ajax({
            url: `/admin/twod_sections/${sectionId}/ajax`,
            method: 'GET',
        }).done(function(res) {
            console.log(res.odd);  
            $('#winningNumberVal').text(res.winning_number);          
            $('#oddVal').text(res.odd);          
            $('#rewardAmountVal').text(res.reward_amount);          
            $('#totBetSlipsVal').text(res.tot_bet_slips);          

        })
    })

    $(document).on('click','#showBtn',function(){
        var $modalForm = $('#showForm');
        const id = $(this).attr('data-id');
        $('#showModal').modal('show');
        $.ajax({
            url: "/admin/twod_bet_slips/"+id,
            method: "GET",
            success: function(res){
                data = res.data;
                console.log(data);
                $('#betSlipNumber').text(res.betSlips.slip_number);
                $('#betSlipDate').text(res.betSlips.draw_date);
                
                let rowHtml = '';
                for(let i = 0;i< data.length;i++){
                    rowHtml += showTableRow(data[i],i+1);
                }
                $('#tbody').html(rowHtml);

            }
        });
    })

    function showTableRow(data,no){
        return `<tr>
                    <td>${no}</td>
                    <td>${data.bet_number}</td>
                    <td class="text-end">${data.bet_amount}</td>
                    <td class="text-end">${data.reward_amount}</td>
                </tr>`;
    }
</script>
@endpush