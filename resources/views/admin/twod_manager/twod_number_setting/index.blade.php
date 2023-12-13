@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1">
                <li class="breadcrumb-item active" aria-current="page">2D Manager / 2D Number Setting</li>
            </ol>
        </nav>
        <div class="bg-white p-3 border">
            <form>
                <div class="row no-gutters">
                    <div class="col-md-3  px-2">
                        <div class="form-group row">
                            <label for="odd" class="col-sm-6 col-form-label mt-1">Odd</label>
                            <div class="col-sm-6">
                                <input type="number"
                                       class="form-control form-control-sm border-bottom border-left-0 border-right-0 border-top-0"
                                       id="odd" placeholder="Enter Odd Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="odd" class="col-sm-6 col-form-label mt-1">User Commission</label>
                            <div class="col-sm-6">
                                <input type="number"
                                       class="form-control form-control-sm border-bottom border-left-0 border-right-0 border-top-0"
                                       id="odd" placeholder="Enter User Commission">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="odd" class="col-sm-6 col-form-label mt-1">Agent Commission</label>
                            <div class="col-sm-6">
                                <input type="number"
                                       class="form-control form-control-sm border-bottom border-left-0 border-right-0 border-top-0"
                                       id="odd" placeholder="Enter Agent Commission">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3  pl-md-5 px-2">
                        <div class="form-group row">
                            <label for="odd" class="col-sm-6 col-form-label mt-1">Limit Per Number</label>
                            <div class="col-sm-6">
                                <input type="number"
                                       class="form-control form-control-sm border-bottom border-left-0 border-right-0 border-top-0"
                                       id="odd" placeholder="Limit Per Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="odd" class="col-sm-6 col-form-label mt-1">Blocked Number</label>
                            <div class="col-sm-6">
                                <input type="number"
                                       class="form-control form-control-sm border-bottom border-left-0 border-right-0 border-top-0"
                                       id="odd" placeholder="Enter Blocked Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <button type="submit" class="btn btn-sm btn-success"> Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <form>
                <div class="row no-gutters">
                    <div class="col-md-3  px-2">
                        <div class="form-group row">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenter">
                                Add Bet Round
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content py-2">
                    <div class="modal-body">
                        <div class="form-group ">
                            <input class="form-control" type="date" placeholder=""/>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="formGroupExampleInput">Morning</label>
                                <input type="time" class="form-control" id="formGroupExampleInput"
                                       placeholder="Example input">
                            </div>
                            <div class="col-6">
                                <label for="formGroupExampleInput">Evening</label>
                                <input type="time" class="form-control" id="formGroupExampleInput"
                                       placeholder="Example input">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Add Round</button>
                        <button type="button" class="btn btn-primary">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="bg-white p-3 border">

                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th style="min-width: 200px">Draw Date</th>
                        <th>Shit</th>
                        <th style="min-width: 100px">Total Bets</th>
                        <th>Commission</th>
                        <th style="min-width: 200px">Total Rewards</th>
                        <th>Revenue</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>

                    @for ($i = 0; $i < 20; $i++)
                        <tr>
                            <td> {{ $i+1 }} </td>
                            <td> {{ now() }} </td>
                            <td> @if($i%2) <span class="badge badge-info"> Evening </span> @else <span class="badge badge-primary">Morning </span> @endif</td>
                            <td> {{ mt_rand(200000, 1000000) }} </td>
                            <td> {{ mt_rand(2000, 3000) }} </td>
                            <td> {{ mt_rand(100000, 200000) }}  </td>
                            <td> {{ mt_rand(100000, 200000) }} </td>
                            <td> @if($i%2) <span class="badge badge-primary"> Opening </span> @else <span class="badge badge-danger">Closed</span> @endif</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
@endsection
