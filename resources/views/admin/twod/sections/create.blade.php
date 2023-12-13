  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Bet Round</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.twod_sections.store')}}" method="POST" id="my-form">
            @csrf
                <div class="mb-3">
                    <label >Opening Date</label>
                    <input type="date" name="opening_date" id="" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label >Opening Time</label>
                    <input type="time" name="opening_time" id="" class="form-control" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-success">Add Bet Round</button>
        </div>
      </div>
    </div>
  </div>