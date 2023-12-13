@extends('admin.layout.app')
@section('content')
    <nav aria-label="breadcrumb" class="px-md-3 pt-2 p-1 mt-1 ">
        <ol class="breadcrumb p-1 ">
            <li class="breadcrumb-item active" aria-current="page">{{$customer->type}}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $customer->name }}</li>
        </ol>
    </nav>
    <div class="px-md-3 p-1">
        <div class="bg-white">
            {{-- head  --}}
            <div class="content-header">
                <div class="container-fluid">
                    @include('admin.customers._statistics')
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-6">
                    <p class="border-bottom border-primary pb-2 mx-md-5 mx-3 text-center">Profile</p>
                </div>
                <div class="col-6">
                    <p class="border-bottom mx-md-5 mx-3 text-center pb-2">
                        <a href="{{ route('admin.customers.transactions', 2) }}">Transaction</a>
                    </p>
                </div> --}}
                {{-- <div class="col-md-8">
                    <form method="POST" action="{{ route('admin.customers.update',$customer->id) }}">
                        @csrf
                        @method('PUT')
                        <ul class="list-group border-0 ml-md-4 ml-2 list-group-flush ">
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Name </p>
                                    <p class="col-6"><b> : {{$customer->name}}</b></p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Phone </p>
                                    <p class="col-6"><b> : {{$customer->phone}}</b></p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Password </p>
                                    <p class="col-6"><b> : <input
                                                    class="border-bottom border-top-0 border-left-0 border-right-0"
                                                    type="text" value="" name="password"/></b></p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Ref Code </p>
                                    <p class="col-6"><b> : {{$customer->referral_code}}</b></p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Friend Code </p>
                                    <p class="col-6"><b> : {{$customer->friend_code}}</b></p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Suspended </p>
                                    <p class="col-6 font-weight-bold">
                                        : <input name="is_suspended" type="radio"
                                                 @if ($customer->is_suspended == '1') checked @endif value="1"/> Yes
                                        : <input name="is_suspended" type="radio"
                                                 @if ($customer->is_suspended == '0') checked @endif  value="0"/> No
                                    </p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Account Type </p>
                                    <p class="col-4 font-weight-bold">
                                        <select class="form-control form-control-sm" name="type">
                                            <option value="{{$customer->type}}">
                                                {{$customer->type}}
                                            </option>
                                            @if ($customer->type === 'Customer')
                                                <option value="Agent">Agent</option>
                                            @endif
                                            @if ($customer->type === 'Agent')
                                                <option value="Customer">Customer</option>
                                            @endif
                                        </select>
                                    </p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-6 font-weight-bold">
                                        <input type="submit" value="Save" class="btn btn-sm btn-success px-3">
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div> --}}

                @if ($customer->type === 'Agent')
                 <div class="card">
                <div class="card-header">
                    <div class="card-title"><b>Information</b></div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-around">
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="{{asset($customer->image)}}" style="object-fit: cover;aspect-ratio:1/1" class="w-50 rounded-circle" alt="">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input readonly type="text" value="{{$customer->name}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input readonly type="text" value="{{$customer->phone}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input readonly type="text" value="{{$customer->display_password}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Has Level 2 Account</label>
                                <input readonly type="text" value="{{$customer->has_level2_account ? 'Yes' : 'No'}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row justify-content-between">
                                <div class="col-6">
                                    <label for="">Nrc Front</label>
                                    <div class=" border rounded">
                                        <img class="w-100" src="{{asset($customer->nrc_front)}}" alt="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="">Nrc Back</label>
                                    <div class="border rounded">
                                        <img  class="w-100"  src="{{asset($customer->nrc_back)}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="">Approved At - </label>
                                {{$customer->created_at ? Carbon\Carbon::parse($customer->created_at)->format('Y-m-d h:i A') : ''}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <p class="mb-0">Current Mode</p>
                                <label for="current_mode">
                                    @if ($customer->current_mode == 1)
                                        Buying 
                                        @if ($customer->current_mode_approved)
                                            <i class="fas fa-check text-success"></i>
                                        @endif
                                    @elseif($customer->current_mode == 2)
                                        Selling
                                        @if ($customer->current_mode_approved)
                                            <i class="fas fa-check text-success"></i>
                                        @endif
                                    @endif
                                </label>
                            </div>

                            <div class="mb-3">
                                <p class="mb-0">Minimum Amount</p>
                                <label for="current_mode">
                                    {{$customer->minimum_amount}}
                                </label>
                            </div>

                            <div class="mb-3">
                                <p class="mb-0">Maximum Amount</p>
                                <label for="current_mode">
                                    {{$customer->maximum_amount}}
                                </label>
                            </div>
                            <div>
                                <p class="mb-2">Payment Methods</p>
                                @foreach ($customer->paymentMethods as $payment)
                                    <div class="d-flex align-items-center">
                                        <img src="{{$payment->image}}" style="width:50px" class="mr-2" alt="">
                                        <div>
                                            <b>{{$payment->pivot->receiver_account_phone}}</b>
                                            <p class="mb-0">{{$payment->pivot->receiver_account_name}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endif

                @if ($customer->type === 'Customer')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"><b>Information</b></div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-around">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <img src="https://c4.wallpaperflare.com/wallpaper/932/645/179/soccer-manchester-united-f-c-logo-wallpaper-preview.jpg"
                                            style="object-fit: cover;aspect-ratio:1/1" class="w-50 rounded-circle"
                                            alt="">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input readonly value="{{ $customer->name }}" type="text" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input readonly value="{{ $customer->phone }}" type="text" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Referal Code</label>
                                        <input readonly value="{{ $customer->referral_code }}" type="text" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Friend Referal Code</label>
                                        <input readonly value="{{ $customer->friend_code }}" type="text" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="Customer" {{ $customer->type == "Customer" ? 'selected' : ''}}>Customer</option>
                                            <option value="Agent" {{ $customer->type == "Agent" ? 'selected' : ''}}>Agent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
