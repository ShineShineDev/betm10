  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.twod_schedules.store')}}" method="POST"  id="my-form">
                @csrf
                <div class="mb-3">  
                    <label for="form-label">Type</label>
                    <select name="twod_type_id" id="" class="form-control">
                        @foreach ($types as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Opening Time</label>
                    <input type="time" name="opening_time" value="" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Closing Time ( Minutes )</label>
                    <input type="number" name="closing_time" value="" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Odd</label>
                    <input type="number" name="odd" value="" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">User Commission</label>
                    <input type="number" name="user_commission" value="" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Agent Commission</label>
                    <input type="number" name="agent_commission" value="" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Min Amount</label>
                    <input type="number" name="min_amount" value="" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Max Amount</label>
                    <input type="number" name="max_amount" value="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Block Numbers</label>
                    <input type="text" class="form-control" name="block_numbers" value="">
                </div>
                <div class="form-switch">
                  <input class="form-check-input form-check-input-lg" name="status" value="1" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                  <label for="flexSwitchCheckChecked">Status</label>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-success">Save</button>
        </div>
      </div>
    </div>
  </div>