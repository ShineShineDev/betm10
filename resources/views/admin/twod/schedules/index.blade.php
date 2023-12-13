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
                    <li class="breadcrumb-item active" aria-current="page">2D Schedule</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-12">
            <div class="mx-3 card border-0 shadow-sm" style="border-radius: 15px">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">2D Schedule</div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add New Schedule
                        </button>
                        @include('admin.twod.schedules.create')
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">No</th>
                                    <th class="text-nowrap">Type</th>
                                    <th class="text-nowrap">Opening Time</th>
                                    <th class="text-nowrap">Closing Time</th>
                                    <th class="text-nowrap">Odd</th>
                                    <th class="text-nowrap">Min Amount</th>
                                    <th class="text-nowrap">Max Amount</th>
                                    <th class="text-nowrap">User Commission</th>
                                    <th class="text-nowrap">Agent Commission</th>
                                    <th class="text-nowrap">Block Numbers</th>
                                    <th class="text-nowrap">Status</th>
                                    <th class="text-nowrap">Control</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->twodType->name}}</td>
                                    <td>{{Carbon\Carbon::parse($item->opening_time)->format('h:i A')}}</td>
                                    <td>{{$item->closing_time}} Min</td>
                                    <td>{{$item->odd}}</td>
                                    <td>{{$item->min_amount}}</td>
                                    <td>{{$item->max_amount}}</td>
                                    <td>{{$item->user_commission}}</td>
                                    <td>{{$item->agent_commission}}</td>
                                    <td>{{$item->block_numbers}}</td>
                                    <td>
                                        @if (!$item->status)
                                            <div class="btn btn-sm px-3 font-weight-bolder" style="border-radius: 0.8125rem;
                                            background:  rgba(242, 78, 30, 0.30);color: #F24E1E;font-weight: 400;">Inactive</div>
                                        @else
                                            <div class="btn btn-sm px-3 font-weight-bolder" style="border-radius: 0.8125rem;
                                            background: #E0EBE5;color: #279958;font-weight: 400;">Active</div>
                                        @endif
                                    </td>
                                    <td>    
                                        <div class="dropdown">
                                            <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                              {{-- <li><button class="dropdown-item" id="editBtn" data-id="{{$item->id}}"><i class="bi bi-pencil-square mr-2"></i>Edit</button></li> --}}
                                              <li><a class="dropdown-item" href="{{route('admin.twod_schedules.edit',$item->id)}}"><i class="bi bi-pencil-square mr-2"></i> Edit</a></li>
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
    {{-- @include('admin.twod.schedules.edit') --}}
    
@endsection
@push('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\Twod\StoreTwodScheduleRequest','#my-form') !!}
{!! JsValidator::formRequest('App\Http\Requests\Admin\Twod\StoreTwodScheduleRequest','#editForm') !!}

<script>
    let data = {};
    $(document).on('click','#editBtn',function(){
        var $modalForm = $('#editForm');
        var $inputs = $modalForm.find('input, select'); 

        const id = $(this).attr('data-id');
        $('#editForm').attr('action',"/admin/twod_schedules/"+id+"/edit");
        $.ajax({
            url: "/admin/twod_schedules/"+id+"/edit",
            method: "GET",
            success: function(res){
                data = res.data;
                console.log(data.odd);
                $inputs.each(function() {
                    var inputName = $(this).attr('name');
                    var inputValue = data[inputName]; // Assuming the keys in 'data' match the input names
                    if(inputName === 'status'){
                        const checked = data[inputName] == 1 ? true : false;
                        $('#status').prop('checked', checked);
                    }else{
                        $(this).val(inputValue);
                    }
                });
                $('#editModal').modal('show');
            }
        });
    })

    // $('#editModalSubmit').on('click',function(){
    //     $.ajax({
    //         url: "/admin/twod_schedules/"+id+"/edit",
    //         method: "POST",
    //         success: function(res){
    //             data = res.data;
    //             console.log(data.odd);
    //             $inputs.each(function() {
    //                 var inputName = $(this).attr('name');
    //                 var inputValue = data[inputName]; // Assuming the keys in 'data' match the input names
    //                 if(inputName === 'status'){
    //                     const checked = data[inputName] == 1 ? true : false;
    //                     $('#status').prop('checked', checked);
    //                 }else{
    //                     $(this).val(inputValue);
    //                 }
    //             });
    //             $('#editModal').modal('show');
    //         }
    //     });
    // })

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
                                    url: `/admin/twod_schedules/${id}`,
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