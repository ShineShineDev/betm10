@extends('admin.layout.app')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h6 class="m-0">Manage Balance /{{$customer->name}}'s Details</h6>
          </div><!-- /.col --><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content pt-3">
        <div class="container-fluid">
          <div class="content-header">
                <div class="container-fluid">
                    @include('admin.customers._statistics')
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title"><b>Manage Balance</b></div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="col-12 col-md-3">
                            <form method="POST" enctype="multipart/form-data" action="{{route('admin.customer.addbalance')}}">
                                @csrf
                                <div class="form-group">
                                    <div class="label">Add Amount</div>
                                    <input type="number" name="add_amount" class="form-control @error('add_amount') is-invalid @enderror " value="{{old('add_amount')}}">
                                </div>
                                <input name="customer_id" type="hidden" value="{{$customer->id}}"/>
                                <div class="form-group">
                                    <button class="btn btn-success w-100">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-3">
                            <form method="POST" action="{{route('admin.customer.minusAmount')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="label">Substract Amount</div>
                                    <input type="number" name="substract_amount" class="form-control @error('substract_amount') is-invalid @enderror" value="{{old('substract_amount')}}">
                                </div>
                                <input name="customer_id" type="hidden" value="{{$customer->id}}"/>
                                <div class="form-group">
                                    <button class="btn btn-warning w-100">Substract</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection