@extends('admin.layout.app')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0">{{$customer->name}}'s Details</h1>
          </div><!-- /.col --><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content pt-3">
        <div class="container-fluid">
            @include('admin.customer._statistics',[
                'customer' => $customer
            ])

            <div class="card">
                <div class="card-header">
                    <div class="card-title"><b>Manage Balance</b></div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="col-12 col-md-3">
                            <form method="POST" action="{{route('admin.customer.balance.add',$customer->id)}}">
                                @csrf
                                <div class="form-group">
                                    <div class="label">Add Amount</div>
                                    <input type="number" name="add_amount" class="form-control @error('add_amount') is-invalid @enderror " value="{{old('add_amount')}}">
                                    @error('add_amount')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success w-100">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-3">
                            <form method="POST" action="{{route('admin.customer.balance.substract',$customer->id)}}">
                                @csrf
                                <div class="form-group">
                                    <div class="label">Substract Amount</div>
                                    <input type="number" name="substract_amount" class="form-control @error('substract_amount') is-invalid @enderror" value="{{old('substract_amount')}}">
                                    @error('substract_amount')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
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