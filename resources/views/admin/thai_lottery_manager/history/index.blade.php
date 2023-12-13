@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ml-md-3 p-1">
                <li class="breadcrumb-item active" aria-current="page">Thai Lottery Manager / History</li>
            </ol>
        </nav>


        {{-- table --}}
        <div class="px-md-3 ">
            <a href="{{ route('admin.thai_lottery_history.create') }}" class="btn btn-sm btn-info">Add Number</a>
            <div class="bg-white  border mt-3">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th style="min-width: 200px">Date</th>
                        <th> Actions</th>
                    </tr>
                    </thead>
                    <tbody style="height:500px;">

                    @for ($i = 0; $i < 20; $i++)
                        <tr>
                            <td> {{ now() }} </td>
                            <td>
                                <i class="bi bi-pencil-square"></i>
                                <i class="bi bi-trash"></i>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
