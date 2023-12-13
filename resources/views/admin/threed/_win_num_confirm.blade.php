@if(isset($win_info))
<div class="bg-white mx-3 mb-2 rounded">
    <div class="row p-3">
        <div class="col-md-6">
            <p>Winnig Number : {{$win_info['winning_number']}}</p>
            <p>Odd : {{$win_info['multiply']}}(R- {{$win_info['reverse_multiply']}} )</p>
            <p>Total Slip : {{$win_info['total_slip']}}</p>
        </div>
        <div class="col-md-6">
            <p>Reward Amount : {{$win_info['reward_amount']}}</p>
            <p>R-Reward : 120,150</p>
            <p>Section Date : {{ date('d/M/Y h:i a', strtotime($win_info['date']))}} </p>
        </div>
        <div class="col-md-12 pb-2">
            <button class="btn btn-success btn-sm">All Confirm</button>
            <button class="btn btn-info btn-sm">Cancel</button>
        </div>

    </div>
</div>
@endif