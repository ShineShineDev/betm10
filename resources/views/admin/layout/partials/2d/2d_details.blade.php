<div class="bg-light px-2 py-1">
    <p class="m-0"> Bet Slip : #1BsDSDR </p>
    <p> Date : {{now()}} </p>
</div>

<table class="table table-responsive-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>NO</th>
            <th>Amount</th>
            <th>Reward</th>
        </tr>
    </thead>
    <tbody>

        @for ($i = 0; $i < 20; $i++)
            <tr>
                <td> {{ $i }} </td>
                <td> {{ mt_rand(50, 100) }} </td>
                <td> {{ mt_rand(100, 900) }} </td>
                <td> {{ mt_rand(10000, 100000) }} </td>
            </tr>
        @endfor
    </tbody>
</table>
