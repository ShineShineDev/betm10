@extends('admin.layout.app')
@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h6 class="m-0">3D Betting Lists /{{$customer->name}}'s Details</h6>
          </div><!-- /.col --><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content pt-3">
        <div class="container-fluid">
              @include('admin.customers._statistics')

            <div class="card">
              <div class="card-header">
                  <div class="card-title"><b>Transactions</b></div>
              </div>
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Bet Number</th>
                      <th>Amount</th>
                      <th>Winning Amount</th>
                      <th>Date Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @foreach ($betting_lists as $index=>$list)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$list->title}}</td>
                            <td>{{$list->bet_number}}</td>
                            <th>{{number_format($list->amount)}} Unit</th>
                            <td>
                              @if ($list->bet_number == $list->section->winning_number)
                                  <b>{{number_format($list->section->multiply * $list->amount)}} Unit</b>
                                  <span class="badge badge-success">Win</span>
                              @endif
                            </td>
                            <td>{{$list->created_at->format('Y-m-d h:i A')}}</td>
                        </tr>
                    @endforeach --}}
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-left">
                  {{-- Total  {{$betting_lists->total()}}  Items --}}
                </div>
                <div class="float-right">
                  {{-- {{$betting_lists->appends(request()->all())->links()}} --}}
                </div>
              </div>
            </div>
        </div>
    </section>

@endsection