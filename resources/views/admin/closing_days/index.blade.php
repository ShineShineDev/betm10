@extends('admin.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="row no-gutters">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-1">
                    <li class="breadcrumb-item active" aria-current="page">Closing Days</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12">
            <div class="mx-3 card border-0 shadow-sm" style="border-radius: 15px">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">Closing Day</div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Closing Day
                        </button>
                        @include('admin.closing_days.create')
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">No</th>
                                    <th class="text-nowrap">Date</th>
                                    <th class="text-nowrap">Title</th>
                                    <th class="text-nowrap">Description</th>
                                    <th class="text-nowrap">Control</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{Carbon\Carbon::parse($item->date)->format('d-m-Y')}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>    
                                        <div class="dropdown">
                                            <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                              {{-- <li><button class="dropdown-item" id="editBtn" data-id="{{$item->id}}"><i class="bi bi-pencil-square mr-2"></i>Edit</button></li> --}}
                                            <li>
                                                <button class="dropdown-item" id="deleteBtn" data-id="{{$item->id}}"><i class="bi bi-trash mr-2"></i> Delete</button>
                                            </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer bg-transparent float-end py-0">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')

{{-- {!! JsValidator::formRequest('App\Http\Requests\Admin\Twod\StoreTwodScheduleRequest','#my-form') !!} --}}

<script>
    let data = {};

                // delete btn
                $(document).on('click', '#deleteBtn', function(e) {
                    e.preventDefault();
                    Swal.fire({
                            text: "Are you sure you want to delete!",
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                let id = $(this).data('id');
                                $.ajax({
                                    url: `/admin/closing-days/${id}`,
                                    method: 'DELETE',
                                }).done(function(res) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    window.location.reload();
                                })
                            }
                        });
                })


</script>
@endpush