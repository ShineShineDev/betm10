  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Number Limit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.numbers.store',$data->id)}}" method="POST" id="my-form">
            @csrf
                <div class="mb-3">
                    <input type="hidden" name="section_id" value="{{$data->id}}">
                </div>
                <div class="mb-3">
                    <label >Number</label>
                    <input type="text" name="number" value="" class="form-control" minlength="2" maxlength="2" placeholder="00 to 99 ">
                </div>
                <div class="mb-3">
                    <label >Min Amount</label>
                    <input type="number" name="min_amount" id="" value="{{$data->min_amount}}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="">Max Amount</label>
                    <input type="number" name="max_amount" value="{{$data->max_amount}}" id="" class="form-control" required>
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