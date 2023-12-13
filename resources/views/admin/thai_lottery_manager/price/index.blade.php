@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        {{-- table --}}
        <div class="px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-1 bg-transparent">
                    <li class="breadcrumb-item active" aria-current="page">Thai Lottery Manager</li>
                    <li class="breadcrumb-item active" aria-current="page">Thai Price Create</li>
                </ol>

            </nav>
        </div>

        <div class="bg-white p-3 border mb-4">
            {{-- Search --}}
            <div class="d-flex ">
                <div class="bg-white py-2 px-3 w-50">
                    <h6 class="fs-14 mt-2">Create Price</h6>
                    <div class="d-flex">
                        <form action="{{ route('admin.thaidprice.create') }}" enctype="multipart/form-data" method="POST"
                            class="d-flex">
                            @csrf
                            <div class="d-flex">
                                <div>
                                    <label for="" class="fw-light">Price</label>
                                    <input name="price" type="text" class="form-control w-100" required />
                                </div>

                                <div class="ms-3">
                                    <label for="" class="fw-light">Amount</label>
                                    <input name="amount" type="text" class="form-control w-100" required />
                                </div>
                            </div>

                            <div class="" style="margin-left: 20px;margin-top:32px">
                                <button id="btncreate" type="submit" class="btn btn-success px-4">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-3 border">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th style="min-width: 150px;font-size:16px;font-weight:400">No</th>
                        <th style="min-width: 150px;font-size:16px;font-weight:400">Price</th>
                        <th style="min-width: 150px;font-size:16px;font-weight:400">Amount</th>
                        <th style="min-width: 150px;font-size:16px;font-weight:400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td style="font-size:14px;font-weight:300">{{ $loop->iteration }}</td>
                            <td style="font-size:14px;font-weight:300">{{ $d->price }}</td>
                            <td style="font-size:14px;font-weight:300">{{ $d->amount }}</td>
                            <td>
                                <div class="d-flex">
                                        <button disabled id="btndelete" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-trash"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg></button>
                                    <a>
                                        <button disabled class="btn btn-success btn-sm ms-3"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-pencil-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg></button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#btndelete').click(function() {
               alert('Note - You can`t delete')
            });
        });
    </script>
@endpush
