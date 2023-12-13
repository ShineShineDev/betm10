@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="px-3 py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-1">
                <li class="breadcrumb-item active ml-1" aria-current="page">Thai Lottery Manager</li>
                <li class="breadcrumb-item active ml-1" aria-current="page">Thai Lottery Popup</li>
            </ol>
        </nav>
        <div class="bg-white p-3 border">
            {{-- 1s Prize --}}
            <div class="row">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-md-3">
                        <div class="card shadow-sm border">
                            <div class="card-header text-center">
                                <p> 1s Prize (1 Prize) <br> 600,000
                                <p>
                            </div>
                            <div class="card-footer text-center">
                                ...........
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            {{-- 2nd S Prize --}}
            <div class="row mt-md-4 mt-3">
                @for ($i = 0; $i < 2; $i++)
                    <div class="col-md-6">
                        <div class="card shadow-sm border">
                            <div class="card-header text-center">
                                <p> 1s Prize (1 Prize) <br> 600,000
                                <p>
                            </div>
                            <div class="card-footer text-center">
                                ...........
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            {{-- 3rd Prize --}}
            <div class="row mt-md-4 mt-3">
                <div class="col-md-12">
                    <div class="card shadow-sm border">
                        <div class="card-header text-center">
                            <p> 1s Prize (1 Prize) <br> 600,000
                            <p>
                        </div>
                        <div class="card-footer text-center">
                            ...........
                        </div>
                    </div>
                </div>
            </div>
            {{-- 4rd Prize --}}
            <div class="row mt-md-4 mt-3">
                <div class="col-md-12">
                    <div class="card shadow-sm border">
                        <div class="card-header text-center">
                            <p> 1s Prize (1 Prize) <br> 600,000
                            <p>
                        </div>
                        <div class="card-footer text-center">
                            ...........
                        </div>
                    </div>
                </div>
            </div>
            {{-- 5rd Prize --}}
            <div class="row mt-md-4 mt-3">
                <div class="col-md-12">
                    <div class="card shadow-sm border">
                        <div class="card-header text-center">
                            <p> 1s Prize (1 Prize) <br> 600,000
                            <p>
                        </div>
                        <div class="card-footer text-center">
                            ...........
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
