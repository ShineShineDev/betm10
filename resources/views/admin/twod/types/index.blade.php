@extends('admin.layout.app')
@push('css')
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endpush
@section('content')
    <section class="content pt-3">
        <div class="container-fluid">
          <div class="row">

            <div class="col-md-6">
              <div class="card border-0 shadow-sm" style="border-radius: 15px">
                <div class="card-header">
                  <h1 class="card-title">Add New Type</h1>
                </div>
                <div class="card-body">
                  <form action="{{route('admin.twod_types.store')}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <div class="mr-1" style="flex-grow: 1">
                              <input required name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" value="{{old('name')}}">
                              @error('name')
                                  <span class="error invalid-feedback">
                                      {{$message}}
                                  </span>
                              @enderror
                            </div>
                        </div>
                      </div>
                      </div>
                      {{-- <div class="col-12">
                        <div class="icheck-success d-inline">
                          <input name="has_set_value" @if(old('has_set_value') == "1") checked @endif value="1" type="checkbox" id="hasSetValue">
                          <label for="hasSetValue">
                            Has Set Value
                          </label>
                        </div>
                      </div> --}}
                      <div class="col-12 d-flex">
                        <div class="form-group ml-auto">
                          <button class="btn btn-success px-4" type="submit">Submit</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card border-0 shadow-sm bg-white" style="border-radius: 15px">
                <div class="card-header">
                  <h1 class="card-title">2D Types</h1>
                </div>
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th style="min-width: 100px">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($types as $index=>$type)
                          <tr>
                              <td>{{$index+1}}</td>
                              <th>{{$type->name}}</th>
                              {{-- <th>
                                @if($type->has_set_value)
                                  <i class="fas text-success fa-check"></i>
                                @endif


                              </th> --}}
                              <th>{{$type->created_at->diffForHumans()}}</th>
                              <th>
                                  {{-- <a href="{{route('admin.twod_types.edit',$type->id)}}" class="btn btn-sm btn-info">
                                      <i class="fas fa-edit"></i>Edit
                                  </a> --}}
                                  <a 
                                    onclick="if(confirm('Are you sure you want to delete this?')){
                                        event.preventDefault();
                                        document.getElementById('type-delete-{{$type->id}}').submit();
                                      }"
                                  type="button" class="btn btn-sm btn-danger">
                                  <i class="bi bi-trash"></i>
                                  </a>

                                  <form id="type-delete-{{$type->id}}" action="{{route('admin.twod_types.destroy',$type->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                  </form>
                              </th>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-transparent">
                    {{ $types->links() }}
                </div>
              </div>
            </div>

            

            
          </div>
            
        </div>
    </section>
@endsection