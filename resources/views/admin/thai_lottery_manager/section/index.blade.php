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
                    <li class="breadcrumb-item active" aria-current="page">Thai Section Create</li>
                </ol>

            </nav>
        </div>

        <div class="bg-white p-3 border mb-4">
            {{-- Search --}}
            <div class="d-flex ">
                <div class="bg-white py-2 px-3 w-50">
                    <h6 class="fs-14 mt-2">Create Section</h6>
                    <div class="d-flex">
                        <form action="{{ route('admin.thaidsection.create') }}" enctype="multipart/form-data" method="POST"
                            class="d-flex">
                            @csrf
                            <input name="sectiondate" type="date" class="form-control w-100" required />
                            <input name="rate" type="number" class="form-control w-100 ms-3" required placeholder="75" />
                            <input name="price" type="number" class="form-control w-100 ms-3" required placeholder="7000" />
                            <div class="" style="margin-left: 20px">
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
                        <th style="min-width: 150px;font-size:16px;font-weight:400">Opening Date</th>
                        <th style="min-width: 150px;font-size:16px;font-weight:400">Rate</th>
                        <th style="min-width: 150px;font-size:16px;font-weight:400">Ticket Price</th>
                        <th style="min-width: 150px;font-size:16px;font-weight:400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td style="font-size:14px;font-weight:300">{{ $loop->iteration }}</td>
                            <td style="font-size:14px;font-weight:300">{{ $d->opening_date }}</td>
                            <td style="font-size:14px;font-weight:300">{{ $d->rate }}</td>
                            <td style="font-size:14px;font-weight:300">{{ $d->price }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.thaidsection.delete', $d->id) }}">
                                        <button class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-trash"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
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
            $('#btncreate').click(function() {
               alert('Note - Dont Create For Next Month!,Create for current month!')
            });
        });
    </script>
@endpush