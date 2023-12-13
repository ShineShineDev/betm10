@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1">
                <li class="breadcrumb-item active ml-1" aria-current="page">Calendar</li>
            </ol>
        </nav>
        <div class="bg-white p-3 border mb-4">

            <div class="row">
                <div class="col-4">
                    <button class="bg-white border-0 d-block mx-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <h6 class="text-center" style="font-size: 18px; font-weight: 300">2D History</h6>
                    </button>

                    <div class=" d-block mx-auto"
                        style="width: 60%;height:1px;background-color:rgba(0, 0, 0, 0.554);margin-top:8px"></div>
                </div>
                <div class="col-4">
                    <button class="bg-white border-0 d-block mx-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExampleOne" aria-expanded="false" aria-controls="collapseExampleOne">
                        <h6 class="text-center" style="font-size: 18px; font-weight: 300">3D History</h6>
                    </button>
                    <div class=" d-block mx-auto"
                        style="width: 60%;height:1px;background-color:rgba(0, 0, 0, 0.554);margin-top:8px"></div>
                </div>
                <div class="col-4">
                    <button class="bg-white border-0 d-block mx-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExampletwo" aria-expanded="false" aria-controls="collapseExampletwo">
                        <h6 class="text-center" style="font-size: 18px;font-weight:300">Thai Lottery History</h6>
                    </button>
                    <div class=" d-block mx-auto"
                        style="width: 60%;height:1px;background-color:rgba(0, 0, 0, 0.554);margin-top:8px"></div>
                </div>
            </div>

            {{-- TwoD --}}

            <div class="row mt-4" class="collapse" id="collapseExample">
                <div class="col-md-12">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="font-size:16px;font-weight:300">Date</th>
                                <th style="font-size:16px;font-weight:300">9:30 (Modern)</th>
                                <th style="font-size:16px;font-weight:300">9:30 (Internet)</th>
                                <th style="font-size:16px;font-weight:300">12:01 PM</th>
                                <th style="font-size:16px;font-weight:300">2:00 (Modern)</th>
                                <th style="font-size:16px;font-weight:300">2:00 (Internet)</th>
                                <th style="font-size:16px;font-weight:300">4:30 PM</th>
                                <th style="font-size:16px;font-weight:300"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size:16px;font-weight:300">DD/MM/YY</td>
                                <td style="font-size:16px;font-weight:300">--</td>
                                <td style="font-size:16px;font-weight:300">--</td>
                                <td style="font-size:16px;font-weight:300">--</td>
                                <td style="font-size:16px;font-weight:300">--</td>
                                <td style="font-size:16px;font-weight:300">--</td>
                                <td style="font-size:16px;font-weight:300">--</td>
                                <td style="font-size:16px;font-weight:300"><button class="btn btn-sm btn-success px-3"
                                        type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button>
                                </td>
                            </tr>
                            @foreach ($data as $item)
                                <tr>
                                    <td style="font-size:16px;font-weight:300">{{ $item->date }}</td>
                                    <td style="font-size:16px;font-weight:300">{{ $item->morning_modern }}</td>
                                    <td style="font-size:16px;font-weight:300">{{ $item->morning_internet }}</td>
                                    <td style="font-size:16px;font-weight:300">{{ $item->morning_number }}</td>
                                    <td style="font-size:16px;font-weight:300">{{ $item->evening_modern }}</td>
                                    <td style="font-size:16px;font-weight:300">{{ $item->evening_internet }}</td>
                                    <td style="font-size:16px;font-weight:300">{{ $item->evening_number }}</td>
                                    <td style="font-size:16px;font-weight:300">
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-pencil-square text-success"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.twodcalendar.delete', $item->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-trash text-danger ms-2"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form method="POST" action="{{ route('admin.twodcalendar.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Create 2D Calendar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label style="font-size:16px;font-weight:300">Date</label>
                                        <input name="date" type="date" required class="form-control w-100" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label style="font-size:16px;font-weight:300">9:30(Modern)</label>
                                        <input name="morning_modern" type="number" required
                                            class="form-control w-100" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label style="font-size:16px;font-weight:300">9:30(Internet)</label>
                                        <input name="morning_internet" type="number" required
                                            class="form-control w-100" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label style="font-size:16px;font-weight:300">12:01 PM</label>
                                        <input name="morning_number" type="number" required
                                            class="form-control w-100" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label style="font-size:16px;font-weight:300">2:00(Modern)</label>
                                        <input name="evening_modern" type="number" required
                                            class="form-control w-100" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label style="font-size:16px;font-weight:300">2:00(Internet)</label>
                                        <input name="evening_internet" type="number" required
                                            class="form-control w-100" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label style="font-size:16px;font-weight:300">4:30 PM</label>
                                        <input name="evening_number" type="number" required
                                            class="form-control w-100" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary px-4"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success px-4">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- ThreeD --}}


            <div class="row mt-4" class="collapse" id="collapseExampleOne">
                <div class="col-md-12">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="font-size:16px;font-weight:300">Date</th>
                                <th style="font-size:16px;font-weight:300">Round 1</th>
                                <th style="font-size:16px;font-weight:300">Round 2</th>
                                <th style="font-size:16px;font-weight:300">Round 3</th>
                                <th style="font-size:16px;font-weight:300"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size:16px;font-weight:300">DD/MM/YY</td>
                                <td style="font-size:16px;font-weight:300">--</td>
                                <td style="font-size:16px;font-weight:300">--</td>
                                <td style="font-size:16px;font-weight:300">--</td>
                                <td style="font-size:16px;font-weight:300"><button class="btn btn-sm btn-success px-3"
                                        type="button" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalone">Add</button>
                                </td>
                            </tr>
                            @foreach ($threed as $item)
                                <tr>
                                    <td style="font-size:16px;font-weight:300">{{ $item->date }}</td>
                                    <td style="font-size:16px;font-weight:300">{{ $item->roundone }}</td>
                                    <td style="font-size:16px;font-weight:300">{{ $item->roundtwo }}</td>
                                    <td style="font-size:16px;font-weight:300">{{ $item->roundthree }}</td>
                                    <td style="font-size:16px;font-weight:300">
                                        <a href="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-pencil-square text-success"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.threedcalendar.delete', $item->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-trash text-danger ms-2"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="exampleModalone" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <form method="POST" action="{{ route('admin.threedcalendar.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Create 2D Calendar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label style="font-size:16px;font-weight:300">Date</label>
                                        <input name="date" type="date" required class="form-control w-100" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label style="font-size:16px;font-weight:300">Round 1</label>
                                        <input name="roundone" type="number" required class="form-control w-100" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label style="font-size:16px;font-weight:300">Round 2</label>
                                        <input name="roundtwo" type="number" required class="form-control w-100" />
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label style="font-size:16px;font-weight:300">Round 3 (*optional)</label>
                                        <input name="roundthree" type="number" class="form-control w-100" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary px-4"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success px-4">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- ThaiD --}}

            <div class="row mt-4" class="collapse" id="collapseExampletwo">
                <div class="col-md-12">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="font-size:16px;font-weight:300">Date</th>
                                <th style="font-size:16px;font-weight:300"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" style="font-size:16px;font-weight:300">DD/MM/YY</td>
                                <td style="font-size:16px;font-weight:300">
                                    <button type="button" class="btn  btn-success px-4" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalfour">Add</button>
                                </td>
                            </tr>
                            @foreach ($thaid as $item)
                                <tr>
                                    <td colspan="7" style="font-size:16px;font-weight:300">
                                        {{ $item->thaidsection->opening_date }}</td>
                                    <td style="font-size:16px;font-weight:300">
                                        <button type="button" class="bg-white border-0"  data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{$item->id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-pencil-square text-success"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                        <a href="{{ route('admin.thaidcalendar.delete', $item->thaidsection->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                fill="currentColor" class="bi bi-trash text-danger ms-2"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title" style="font-size: 18px;font-weight:300"
                                                    id="exampleModalLabel">ThaiD 
                                                    Winning Number / Edit</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.thaidcalendar.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12 my-3">
                                                            <div class="d-flex">
                                                                <h6 class="fw-bold mt-2">Opening Date:</h6>
                                                                <select name="sectiondate" class="form-control w-25 ms-3">
                                                                    <option>Choose Date</option>
                                                                    <option value={{ $item->thaidsection->id}}>
                                                                        {{ $item->thaidsection->opening_date }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="">
                                                                <div class="mb-0 py-2"
                                                                    style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                                    <h6 class="mb-0 text-center ">1s Prize (1 prize)</h6>
                                                                    <h6 class="text-center">6,000,000 bath</h6>
                                                                </div>
                                                                <input name="first_price" type="string" class="py-3"
                                                                    class="winner-input" style="width: 100%;border">
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="">
                                                                <div class="mb-0 py-2"
                                                                    style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                                    <h6 class="mb-0 text-center ">First 3 digits (2 prize)
                                                                    </h6>
                                                                    <h6 class="text-center">4,000 baht</h6>
                                                                </div>
                                                                <input name="first_three_price" type="string"
                                                                    class="py-3" class="winner-input"
                                                                    style="width: 100%;border">
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="">
                                                                <div class="mb-0 py-2"
                                                                    style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                                    <h6 class="mb-0 text-center ">Last 3 digits (2 prize)
                                                                    </h6>
                                                                    <h6 class="text-center">4,000 baht</h6>
                                                                </div>
                                                                <input name="last_three_price" type="string"
                                                                    class="py-3" class="winner-input"
                                                                    style="width: 100%;border">
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="">
                                                                <div class="mb-0 py-2"
                                                                    style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                                    <h6 class="mb-0 text-center ">Last 2 digits (1 prize)
                                                                    </h6>
                                                                    <h6 class="text-center">2,000 baht</h6>
                                                                </div>
                                                                <input name="last_two_price" type="string"
                                                                    class="py-3" class="winner-input"
                                                                    style="width: 100%;border">
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 mt-3">
                                                            <div class="">
                                                                <div class="mb-0 py-2"
                                                                    style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                                    <h6 class="mb-0 text-center ">Side Prize - 1st Prize (2
                                                                        prize)</h6>
                                                                    <h6 class="text-center">100,000 baht</h6>
                                                                </div>
                                                                <input name="side_first_price" type="string"
                                                                    class="py-3" class="winner-input"
                                                                    style="width: 100%;border">
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 mt-3">
                                                            <div class="">
                                                                <div class="mb-0 py-2"
                                                                    style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                                    <h6 class="mb-0 text-center ">2nd Prize (5 prize)</h6>
                                                                    <h6 class="text-center">200,000 baht</h6>
                                                                </div>
                                                                <input name="second_price" type="string" class="py-3"
                                                                    class="winner-input" style="width: 100%;border">
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="">
                                                                <div class="mb-0 py-2"
                                                                    style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                                    <h6 class="mb-0 text-center ">3rd Prize (10 prize)</h6>
                                                                    <h6 class="text-center">80,000 baht</h6>
                                                                </div>
                                                                <input name="third_price" type="string" class="py-3"
                                                                    class="winner-input" style="width: 100%;border">
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="">
                                                                <div class="mb-0 py-2"
                                                                    style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                                    <h6 class="mb-0 text-center ">4th Prize (50 prize)</h6>
                                                                    <h6 class="text-center">40,000 baht</h6>
                                                                </div>
                                                                <input name="fourth_price" type="string" class="py-3"
                                                                    class="winner-input" style="width: 100%;border">
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="">
                                                                <div class="mb-0 py-2"
                                                                    style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                                    <h6 class="mb-0 text-center ">5th Prize (100 prize)
                                                                    </h6>
                                                                    <h6 class="text-center">20,000 baht</h6>
                                                                </div>
                                                                <input name="fifth_price" type="string" class="py-3"
                                                                    class="winner-input" style="width: 100%;border">
                                                                <div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer  ">
                                                        <div>
                                                            <div class="">
                                                                <input type="hidden" value="" id="hiddenvalues"
                                                                    name="hiddenvalue">
                                                                <button id="createBtn" type="submit"
                                                                    class="btn btn-success  w-100">Create
                                                                    Now</button>
                                                                <button type="submit"
                                                                    class="btn btn-success  w-100 mt-3">Update Now</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="exampleModalfour" tabindex="1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" style="font-size: 18px;font-weight:300" id="exampleModalLabel">ThaiD
                                Winning Number</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.thaidcalendar.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 my-3">
                                        <div class="d-flex">
                                            <h6 class="fw-bold mt-2">Opening Date:</h6>
                                            <select name="sectiondate" class="form-control w-25 ms-3">
                                                <option>Choose Date</option>
                                                <option value={{ $section->last()->id }}>
                                                    {{ $section->last()->opening_date }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">1s Prize (1 prize)</h6>
                                                <h6 class="text-center">6,000,000 bath</h6>
                                            </div>
                                            <input name="first_price" type="string" class="py-3" class="winner-input"
                                                style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">First 3 digits (2 prize)</h6>
                                                <h6 class="text-center">4,000 baht</h6>
                                            </div>
                                            <input name="first_three_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">Last 3 digits (2 prize)</h6>
                                                <h6 class="text-center">4,000 baht</h6>
                                            </div>
                                            <input name="last_three_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">Last 2 digits (1 prize)</h6>
                                                <h6 class="text-center">2,000 baht</h6>
                                            </div>
                                            <input name="last_two_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">Side Prize - 1st Prize (2 prize)</h6>
                                                <h6 class="text-center">100,000 baht</h6>
                                            </div>
                                            <input name="side_first_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">2nd Prize (5 prize)</h6>
                                                <h6 class="text-center">200,000 baht</h6>
                                            </div>
                                            <input name="second_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">3rd Prize (10 prize)</h6>
                                                <h6 class="text-center">80,000 baht</h6>
                                            </div>
                                            <input name="third_price" type="string" class="py-3" class="winner-input"
                                                style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">4th Prize (50 prize)</h6>
                                                <h6 class="text-center">40,000 baht</h6>
                                            </div>
                                            <input name="fourth_price" type="string" class="py-3"
                                                class="winner-input" style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="">
                                            <div class="mb-0 py-2"
                                                style="background: #D5B7FF;width:100%,height:100%;border:1px solid black;border-bottom:0">
                                                <h6 class="mb-0 text-center ">5th Prize (100 prize)</h6>
                                                <h6 class="text-center">20,000 baht</h6>
                                            </div>
                                            <input name="fifth_price" type="string" class="py-3" class="winner-input"
                                                style="width: 100%;border">
                                            <div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer  ">
                                    <div>
                                        <div class="">
                                            <input type="hidden" value="" id="hiddenvalues" name="hiddenvalue">
                                            <button id="createBtn" type="submit" class="btn btn-success  w-100">Create
                                                Now</button>
                                            <button type="submit" class="btn btn-success  w-100 mt-3">Update Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>



        </div>
    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#collapseExampleOne').collapse('hide'); // Hide the 3D History collapse container by default

                $('#collapseButton2D').click(function() {
                    $('#collapseExampleOne').collapse('hide'); // Hide the 3D History collapse container
                });

                $('#collapseButton3D').click(function() {
                    $('#collapseExample').collapse('hide'); // Hide the 2D History collapse container
                });
                   $('select[name="sectiondate"]').change(function() {
                    var selectedOption = $(this).val();
                    // Make the AJAX request
                    fetch('{{ route('admin.editthaidwinningcalendar.number') }}?selectedOption=' + selectedOption, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include the CSRF token for Laravel security
                            }
                        })
                        .then(response => response.json())
                        .then(data => {


                            let winningNumbers = [];
                            let lastthreeprice = [];
                            let lasttwoprice = [];
                            let sidefirstprice = [];
                            let secondprice = [];
                            let thirdprice = [];
                            let fourthprice = [];
                            let fifthprice = [];

                            data.forEach((element, index) => {

                                if (element.thaidprice.price === '1-st Prize') {
                                    $('input[name="first_price"]').val(element.winning_number);
                                }
                                if (element.thaidprice.price === 'First 3 Digits') {
                                    $('#createBtn').prop('disabled', true);
                                    $('#hiddenvalues').val(1);
                                    const winningNumber = element.winning_number;
                                    winningNumbers.push(winningNumber);
                                }
                                if (element.thaidprice.price === 'Last 3 Digits') {
                                    const lasthreeprices = element.winning_number;
                                    lastthreeprice.push(lasthreeprices);
                                }
                                if (element.thaidprice.price === 'Last 2 Digits') {
                                    const lasttwoprices = element.winning_number;
                                    lasttwoprice.push(lasttwoprices);
                                }
                                if (element.thaidprice.price === 'Side Prizes') {
                                    const sidefirstprices = element.winning_number;
                                    sidefirstprice.push(sidefirstprices);
                                }
                                if (element.thaidprice.price === '2-nd Prizes') {
                                    const secondprices = element.winning_number;
                                    secondprice.push(secondprices);
                                }
                                if (element.thaidprice.price === '3-rd Prizes') {
                                    const thirdprices = element.winning_number;
                                    thirdprice.push(thirdprices);
                                }
                                if (element.thaidprice.price === '4-th Prizes') {
                                    const fourthprices = element.winning_number;
                                    fourthprice.push(fourthprices);
                                }
                                if (element.thaidprice.price === '5-th Prizes') {
                                    const fifthprices = element.winning_number;
                                    fifthprice.push(fifthprices);
                                }

                            });

                            const formattedWinningNumbers = winningNumbers.join(',');
                            $('input[name="first_three_price"]').val(formattedWinningNumbers);
                            const formattedlastthreeprice = lastthreeprice.join(',');
                            $('input[name="last_three_price"]').val(formattedlastthreeprice);
                            const formattedlasttwoprice = lasttwoprice.join(',');
                            $('input[name="last_two_price"]').val(formattedlasttwoprice);
                            const formattedsidefirstprice = sidefirstprice.join(',');
                            $('input[name="side_first_price"]').val(formattedsidefirstprice);
                            const formattedsecondprice = secondprice.join(',');
                            $('input[name="second_price"]').val(formattedsecondprice);
                            const formattedthirdprice = thirdprice.join(',');
                            $('input[name="third_price"]').val(formattedthirdprice);
                            const formattedfourthprice = fourthprice.join(',');
                            $('input[name="fourth_price"]').val(formattedfourthprice);
                            const formattedfifthprice = fifthprice.join(',');
                            $('input[name="fifth_price"]').val(formattedfifthprice);

                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        </script>
    @endpush
