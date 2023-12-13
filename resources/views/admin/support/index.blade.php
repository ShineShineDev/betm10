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
                    <li class="breadcrumb-item active" aria-current="page">Bingo Manager</li>
                    <li class="breadcrumb-item active" aria-current="page">Random Number Create</li>
                </ol>

            </nav>
        </div>

        <div class="bg-white p-3 border mb-4">
            {{-- Search --}}
            <div class="w-100 d-flex ">
                <div class="bg-white py-2 px-3 w-100">
                    <h6 class="fs-14 mt-2">Create Support</h6>
                    <div class="d-flex  w-100">
                        <form action="{{ route('admin.support.create') }}" enctype="multipart/form-data" method="POST"
                            class="">
                            @csrf
                            <div class="d-flex">
                                <input name="phone" type="text" class="form-control w-100"
                                    placeholder="093252525..." />
                                <input type="file" name="image" class="form-control w-100 ms-4" />
                                <div class="w-100 ms-4">
                                </div>
                                <button id="btncreate" type="submit" class="btn btn-success px-4 ms-4">Create</button>
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
                        <th style="min-width: 150px;font-size:16px;font-weight:400">Image</th>
                        <th style="min-width: 150px;font-size:16px;font-weight:400">Phone</th>
                    </tr>
                </thead>
                <tbody>
                      @foreach ($data ?? '' as $d)
                        <tr>
                            <td style="font-size:14px;font-weight:300">{{ $loop->iteration }}</td>
                            <td>
                                @if ($d->image === null)
                                    <h6> - </h6>
                                @else
                                    <img style="width: 50px;height:50px;border-radius:50%;object-fit:cover"
                                        src="{{$d->image}}" />
                                @endif
                            </td>
                            <td style="font-size:14px;font-weight:300">{{ $d->phone ? $d->phone : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
    @push('scripts')
        <script></script>
    @endpush
