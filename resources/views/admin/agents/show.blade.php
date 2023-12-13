@extends('admin.layout.app')
@section('content')
    <nav aria-label="breadcrumb" class="px-md-3 pt-2 p-1 mt-1 ">
        <ol class="breadcrumb p-1 ">
            <li class="breadcrumb-item active" aria-current="page">Agents</li>
            <li class="breadcrumb-item active" aria-current="page">Tom Holland</li>
        </ol>
    </nav>
    <div class="px-md-3 p-1">
        <div class="bg-white">
            {{-- head  --}}
            <div class="content-header">
                <div class="container-fluid">
                    @include('admin.agents._statistics')
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="border-bottom border-primary pb-2 mx-md-5 mx-3 text-center">Profile</p>
                </div>
                <div class="col-6">
                    <p class="border-bottom mx-md-5 mx-3 text-center pb-2">
                        <a href="{{ route('admin.agents.transactions', 1) }}">Transaction</a>
                    </p>
                </div>
                <div class="col-md-8">
                    <form>
                        <ul class="list-group border-0 ml-md-4 ml-2 list-group-flush ">
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Name </p>
                                    <p class="col-6"><b> : Spidey</b> </p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Phone </p>
                                    <p class="col-6"><b> : +959,7912,7912</b> </p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Password </p>
                                    <p class="col-6"><b> : <input
                                                class="border-bottom border-top-0 border-left-0 border-right-0"
                                                type="text" value="....." /></b> </p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Ref Code </p>
                                    <p class="col-6"><b> : 1011</b> </p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Friend Code </p>
                                    <p class="col-6"><b> : 11001</b> </p>
                                </div>
                            </li>
                            <li class="list-group-item border-0 ">
                                <div class="row">
                                    <p class="col-md-2 col-4">Supsended </p>
                                    <p class="col-6 font-weight-bold">
                                        : <input type="radio" /> Yes
                                        <input type="radio" class="ml-3" /> No
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
                </div>
            </div>
        </div>
    </div>
@endsection
