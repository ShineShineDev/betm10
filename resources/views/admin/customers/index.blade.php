@extends('admin.layout.app')
@section('content')
    <div class="content-header">
        {{-- head  --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-1 ">
                            <li class="breadcrumb-item active" aria-current="page">Customres</li>
                            <li class="breadcrumb-item active" aria-current="page">All</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-3 ml-auto">
                    <form action="" class="d-flex">
                        <input placeholder="search" type="text" name="search" value="{{ $_GET['search'] ?? '' }}"
                               class="form-control">
                        <button class="btn btn-success ml-1">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- customers Table --}}
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body font-weight-normal">
                            <table class="table table-responsive-sm">
                                <thead>
                                <tr>
                                    <th style="width: 10px">NO</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Balance</th>
                                    <th>Commission</th>
                                    <th>Registered</th>
                                    <th>Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($customers as $index=>$customer)
                                    <tr class="p-0">
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $customer->name}}</td>
                                        <td>{{ $customer->phone}}</td>
                                        <td><span class="badge @if($customer->type === 'Customer' ) badge-info @else badge-warning  @endif">{{ $customer->type}} </span> </td>
                                        <td>{{$customer->balance}}</td>
                                        <td>{{0}}</td>
                                        <td> {{ $customer->created_at->diffForHumans() }} </td>
                                        <td><a href="{{ route('admin.customers.show', $customer->id) }}"> Details</a></td>
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
        </div>
    </section>
@endsection
