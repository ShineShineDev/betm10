<table class="table table-responsive-sm table-striped table-hover p-5">
    <thead>
        <tr>
            <th class="p-2 bg-light borde-0">Slip Number</th>
            <th class="p-2 bg-light borde-0" style="min-width: 200px">Name</th>
            <th class="p-2 bg-light borde-0" style="min-width: 100px">Bet Amount</th>
            <th class="p-2 bg-light borde-0">Reward Amount</th>
            <th class="p-2 bg-light borde-0">Bet Date </th>
            <th class="p-2 bg-light borde-0" style="min-width: 200px">Draw Date</th>
            <th class="p-2 bg-light borde-0">Status</th>
            <th class="p-2 bg-light borde-0">Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach($threed_bet_slips as $key => $threed_bet_slip)
        <tr>
            <td class="p-2">{{ substr($threed_bet_slip->slip_number,0,10) }}
                <span class="badge bg-warning" style="position: relative;top:-10px;">
                    {{count($threed_bet_slip->threeDBettingLogs)}}
                </span>
            </td>
            <td class="p-2"> {{$threed_bet_slip->customer->name}}</td>
            <td class="p-2">
                {{$threed_bet_slip->total_amount}}
            </td>
            <td class="p-2">
                @php
                $rewrad = $threed_bet_slip->threedBettingLogs->filter(function($log){
                if($log->rewrad_status == 1){
                return $log;
                }
                });
                @endphp
                {{number_format($rewrad->sum(function ($log) {
                return (float)$log->reward_amount;
                }), 0, '', ',')}}
            </td>
            <td class="p-2"> {{substr($threed_bet_slip->bet_date,0,10)}} </td>
            <td class="p-2"> {{substr($threed_bet_slip->threeDSection->opening_date,0,10)}}</td>
            <td class="p-2">
                @if ($threed_bet_slip->is_reject)
                <div class="btn btn-sm px-3 font-weight-bolder" style="border-radius: 0.8125rem;
                background: rgba(242, 78, 30, 0.30);color: #F24E1E;font-weight: 400;">Reject</div>
                @else
                @if ($threed_bet_slip->section?->ended)
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
                    <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item"
                                href="{{route('admin.threed.bet_slip.show',$threed_bet_slip->id)}}">
                                <i class="bi bi-eye mr-2"></i> View
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @if ($threed_bet_slip->is_reject)
                        <form action="{{route('admin.threed.bet_slip.reject',$threed_bet_slip->id)}}" method="post">
                            @method('put')
                            @csrf
                            <li><button class="dropdown-item" type="submit"><i class="bi bi-check2 mr-2"></i>
                                    Accept</button></li>
                        </form>
                        @else
                        <form action="{{route('admin.threed.bet_slip.reject',$threed_bet_slip->id)}}" method="post">
                            @method('put')
                            @csrf
                            <li><button class="dropdown-item" type="submit"><i class="bi bi-x-circle mr-2"></i>
                                    Reject</button></li>
                        </form>
                        @endif
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>