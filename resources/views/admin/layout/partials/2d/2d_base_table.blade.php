<table class="table table-responsive">
    <thead>
        <tr>
            <th style="min-width: 200px">Bet Slip</th>
            <th style="min-width: 200px">Name</th>
            <th style="min-width: 200px">Amount</th>
            <th>Reward</th>
            <th style="min-width: 200px">Draw Date</th>
            <th style="min-width: 200px">Bet Date</th>
            <th>Status</th>
            <th style="min-width: 200px">Action</th>
        </tr>
    </thead>
    <tbody>

        @for ($i = 0; $i < 20; $i++) <tr>
            <td> {{ mt_rand() }} </td>
            <td> {{ mt_rand() }} </td>
            <td> {{ mt_rand(1000, 2000) }} </td>
            <td> 0 </td>
            <td> {{ now() }} </td>
            <td> {{ now() }} </td>
            <td> <button class="btn btn-sm">Active</button> </td>
            <td> Detail :</td>
            </tr>
            @endfor
    </tbody>
</table>