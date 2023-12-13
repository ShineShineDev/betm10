<!-- Add Winning Number -->
<div class="modal fade" id="addWinningNumber" tabindex="-1" role="dialog" aria-labelledby="addSection"
    aria-hidden="true">
    <form method="post" action="{{ route('admin.threed.section.winning_number.before_confirm')}}">

        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content py-2">
                <div class="modal-header p-2 mx-2">
                    <i class="bi bi-trophy mr-1"></i> Add Winning Number
                </div>
                <div class="modal-body px-4">
                    <div class="form-group">
                        <label>Number</label>
                        <input type="tel" name="winning_number" placeholder="Enter Winning Number" required max="999"
                            maxlength="3" minlength="3" class="form-control">
                        @error('winning_number')
                        <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label>Section Date</label>
                        <select class="form-control" required name="section_id" readonly>
                            <option value="{{$latest_threed_sections->id}}">
                                {{substr($latest_threed_sections->opening_date,0,10)}} |
                                {{ date('g: a', strtotime($latest_threed_sections->opening_time)) }}</option>
                        </select>
                        @error('section_id')
                        <span>{{$message}}</span>
                        @enderror
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