@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb ml-md-3 p-1">
                <li class="breadcrumb-item active" aria-current="page">2D Manager / History</li>
            </ol>
        </nav>


        {{-- table --}}
        <div class="px-md-3 ">
            <div class="bg-white  border">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th style="min-width: 200px">Date</th>
                        <th>9:30(Modern)</th>
                        <th>9:30(Internet)</th>
                        <th>12:01 PM</th>
                        <th>2:00(Modern)</th>
                        <th>2:00(Internet)</th>
                        <th>4:30 PM</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody style="height:500px;">

                    @for ($i = 0; $i < 20; $i++)
                        <tr>
                            <td> {{ now() }} </td>
                            <td> {{ mt_rand(00,99) }} </td>
                            <td> {{ mt_rand(00,99) }} </td>
                            <td> {{ mt_rand(00,99) }} </td>
                            <td> {{ mt_rand(00,99) }} </td>
                            <td> {{ mt_rand(00,99) }} </td>
                            <td> {{ mt_rand(00,99) }} </td>
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
