@extends('admin.layout.app')
@section('content')
<style>
  /* Paste the CSS styles here */
  .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 23px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 15px;
    width: 15px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2196F3;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pl-3">
            <li class="breadcrumb-item active" aria-current="page">Payment / All</li>
        </ol>
    </nav>

    <div class="container-fluid p-md-3">
        <div class="bg-white p-md-3 p-2">
            <form method="POST" action="{{ route('admin.payment.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="row my-md-3 ">
                    <div class="col-3">
                        <label style="font-weight: 500" for="">Payment Type</label>
                        <input name="payment_type" class="form-control w-100" placeholder="kBZ,Wave...." />
                    </div>
                    <div class="col-3">
                        <label style="font-weight: 500" for="">Payment Account Name</label>
                        <input name="payment_name" class="form-control w-100" placeholder="Si Thu Kyaw Tint" />
                    </div>
                    <div class="col-3">
                        <label style="font-weight: 500" for="">Payment Account Phone</label>
                        <input type="number" name="payment_phone" class="form-control w-100" placeholder="091111222" />
                    </div>
                    <div class="col-3">
                        <label style="font-weight: 500" for="">Payment Rate(*Optional)</label>
                        <input type="number" name="rate" class="form-control w-100" placeholder="75" />
                    </div>
                    <div class="col-3">
                        <label style="font-weight: 500" for="">Avatar</label>
                        <input type="file" name="image" class="form-control w-100" />
                    </div>
                    <div class="col-3 mt-2">
                        <button class="btn btn-primary w-50 mt-4">
                            <h6 class="mb-0 mx-4 py-1">Add</h6>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- customers Table --}}
    <section class="container-fluid p-md-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th style="font-size:16px;font-weight:500">No</th>
                                    <th style="font-size:16px;font-weight:500">Avatar</th>
                                    <th style="font-size:16px;font-weight:500">Rate</th>
                                    <th style="font-size:16px;font-weight:500">Payment Type</th>
                                    <th style="font-size:16px;font-weight:500">Payment Account Name</th>
                                    <th style="font-size:16px;font-weight:500">Payment Account Phone</th>
                                    <th style="font-size:16px;font-weight:500">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment as $p)
                                    <tr>
                                        <td style="font-size:15px;font-weight:500">{{ $loop->iteration }}</td>
                                        <td><img style="width: 50px;height:50px;border-radius:50%;object-fit:cover"
                                                src="{{$p->avatar}}" /></td>
                                        <td style="font-size:15px;font-weight:500">{{ $p->rate }}</td>
                                        <td style="font-size:15px;font-weight:500">{{ $p->payment_type }}</td>
                                        <td style="font-size:15px;font-weight:500">{{ $p->payment_name }}</td>
                                        <td style="font-size:15px;font-weight:500">{{ $p->payment_phone }}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" {{ $p->status === "on" ? "checked" : "" }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
