<div class="mt-3">
    <div class="bg-white p-3 border">
        <div class="row no-gutters">
            @foreach($threed_betting_logs as $number => $bet_logs)
            <div class="col-md-2 text-center col-6 rounded  ">
                <div class="card px-1 py-3 m-2 shadow-sm " style="background: #E4E4FC">
                    <b>{{$number}}</b>
                    <?php
                    $amount_array = [];
                    foreach($bet_logs as $bet_log){
                        array_push($amount_array,$bet_log->bet_amount);
                    }
                    ?>
                    {{number_format(array_sum($amount_array))}}
                    <br>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>