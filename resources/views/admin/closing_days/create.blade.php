  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Closing Day</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('admin.closing-days.store')}}" method="POST"  id="my-form">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="">Date</label>
                    <input type="date" name="date" value="" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Title</label>
                    <input type="text" name="title" value="" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Description</label>
                    <textarea name="description" id="" class="form-control" cols="3" rows="3"></textarea>
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