<!-- Add Section -->
<div class="modal fade" id="addNumberLimitToSection" tabindex="-1" role="dialog" aria-labelledby="addSection"
    aria-hidden="true">
    <form method="post" action="{{ route('admin.threed.section.number_limit.store')}}">
        @csrf
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content py-2">
                <div class="modal-header p-2 mx-2">
                    <i class="bi bi-clipboard2-x"></i> Add Number Limit
                </div>
                <div class="modal-body px-4">
                    <div class="form-group mt-2">
                        <label>Number</label>
                        <input type="tel" name="number" placeholder="123" required minlength="3" maxlength="3"
                            class="form-control" />
                    </div>
                    <div class="form-group mt-2">
                        <label>Min Price</label>
                        <input type="number" name="min_amount" placeholder="500 MMK" required minlength="3" maxlength="3"
                            class="form-control" />
                    </div>
                    <div class="form-group mt-2">
                        <label>Total Available Bet Max Price</label>
                        <input type="number" name="max_amount" placeholder="20,000 MMK" required minlength="3"
                            maxlength="3" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Section</label>
                        <select class="form-control" name="threed_section_id" required readonly>
                            <option value="{{$threed_section->id}}" checked> {{$threed_section->opening_date .
                                ' ('. date('g:i a',
                                strtotime($threed_section->opening_time)) }} )</option>
                        </select>
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