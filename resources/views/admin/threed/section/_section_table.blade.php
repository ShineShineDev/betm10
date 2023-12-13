<div class="mt-3">
    <div class="bg-white rounded-lg">
        <div class="p-2">
            <table class="table table-responsive-sm table-striped table-hover p-5">
                <thead>
                    <tr>
                        <th class="p-2 bg-light borde-0">No</th>
                        <th class="p-2 bg-light borde-0" style="min-width: 200px">Draw Date</th>
                        <th class="p-2 bg-light borde-0" style="min-width: 100px">Total Bets</th>
                        <th class="p-2 bg-light borde-0">Commission</th>
                        <th class="p-2 bg-light borde-0" style="min-width: 200px">Total Rewards</th>
                        <th class="p-2 bg-light borde-0">Revenue</th>
                        <th class="p-2 bg-light borde-0">Status</th>
                        <th class="p-2 bg-light borde-0">Detail</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($threed_sections as $key => $threed_section)
                    <tr>
                        <td class="p-2"> {{ $threed_section->id }} </td>
                        <td class="p-2"> {{ $threed_section->opening_date }} </td>
                        <td class="p-2"> {{ $threed_section->threedBettingLogs->count()}} </td>
                        <td class="p-2"> {{$threed_section->agent_commission}}(Agent) |
                            {{$threed_section->user_commission}} (User) %
                        </td>
                        <td class="p-2">
                            {{number_format($threed_section->threedBettingLogs->sum(function ($log) {
                            return (float)$log->reward_amount;
                            }), 0, '', ',')}}
                        </td>
                        <td class="p-2">
                            @php
                            $not_rewrad = $threed_section->threedBettingLogs->filter(function($log){
                            if($log->rewrad_status == 0){
                            return $log;
                            }
                            });
                            @endphp
                            {{number_format($not_rewrad->sum(function ($log) {
                            return (float)$log->bet_amount;
                            }), 0, '', ',')}}
                        </td>
                        <td class="p-2">
                            @if($threed_section->status == 1)
                            <span class="badge bg-info">Opening</span>
                            @else
                            <span class="badge bg-secondary">Close</span>
                            @endif
                        </td>
                        <td class="p-2">
                            <a href="{{ route('admin.threed.section.show',$threed_section->id) }}"
                                class="btn btn-sm btn-info py-0 ml-2"><i class="bi bi-arrow-return-right pt-1"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>