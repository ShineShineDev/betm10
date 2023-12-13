<!-- Add Section -->
<div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-labelledby="addSection" aria-hidden="true">
    <form method="post" action="{{ route('admin.threed.section.store')}}">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content py-2">
                <div class="modal-header p-2 mx-2">
                    <i class="bi bi-calendar-month mr-1"></i> Add Bet Round
                </div>
                <div class="modal-body px-4">
                    {{-- <div class="alert alert-info p-1" role="alert">
                        <small class=" alert my-2"><i class="bi bi-exclamation-triangle"></i> Before add Bet
                            Round,please check default section(setting) </small>
                    </div> --}}

                    <div class="form-group mt-2">
                        <label>Date</label>
                        <input type="date" name="opening_date" required value="{{date('Y-m-d')}}"
                            min="{{ date('Y-m-d') }}" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="opening_time" value="16:00" required class="form-control">
                    </div>
                </div>
                <div class="mx-3 mt-0 mb-3">
                    <button class="btn btn-sm btn-secondary">Submit</button>
                    <button type="button" class="btn btn-sm btn-primary float-right" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>