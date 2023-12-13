  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Winning Number</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.twod_section.add_winning_number')}}" method="POST" id="my-form">
            @csrf
                <div class="mb-3">
                    <label >Sections</label>
                    <select name="section_id" class="form-select" id="">
                          @foreach ($sections as $item)
                          @if (!$item->winning_number)
                               <option value="{{$item->id}}" class="{{$item->ended ? 'text-danger' : 'text-success'}} "> 
                                  {{Carbon\Carbon::parse($item->opening_datetime)->format('d-m-Y h:i A')}}
                              </option>
                              @endif
                          @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label >Number</label>
                    <input type="number" name="winning_number" id="" class="form-control" required>
                </div>
                <hr>
               
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="my-form" class="btn btn-success"> Save </button>
        </div>
      </div>
    </div>
  </div>