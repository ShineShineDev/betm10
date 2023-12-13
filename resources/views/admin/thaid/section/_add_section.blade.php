<!-- Add Section -->
<div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-labelledby="addSection" aria-hidden="true">
    <form method="post" action="{{ route('admin.thaid.section.store') }}">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content py-2">
                <div class="modal-header p-2 mx-2">
                    <i class="bi bi-calendar-month mr-1"></i> Add Bet Round
                </div>
                <div class="modal-body px-4">
                    <div class="form-group mt-2">
                        <label>Opening Date</label>
                        <input type="date" name="opening_date" required value="{{ date('Y-m-d') }}"
                            min="{{ date('Y-m-d') }}" class="form-control form-control-sm" />
                    </div>
                    <div class="form-group">
                        <label>Opening Time</label>
                        <input type="time" name="opening_time" value="16:00" required
                            class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label>Closing Time</label>
                        <input type="time" name="closing_time" value="15:00" required
                            class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label>Bet Amount(A Ticket)</label>
                        <input type="number" name="to_bet_amount" value="15:00" required
                            class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label>User Commission</label>
                        <input type="number" name="user_commission" value="15:00" required
                            class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label>Agent Commission</label>
                        <input type="number" name="agent_commission" value="15:00" required
                            class="form-control form-control-sm">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Is Maintenace ?</label>
                        <div class="form-check form-check-inline ml-2">
                            <input class="form-check-input" class="form-control form-control-sm" checked value="0"
                                type="radio" name="is_maintenace">
                            <label class="form-check-label">No</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" class="form-control form-control-sm"  value="1"
                                type="radio" name="is_maintenace">
                            <label class="form-check-label">Yes</label>
                        </div>
                    </div>
                </div>
                <div class="mx-3 mt-0 mb-3">
                    <button class="btn btn-sm btn-secondary">Submit</button>
                    <button type="button" class="btn btn-sm btn-primary float-right"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
