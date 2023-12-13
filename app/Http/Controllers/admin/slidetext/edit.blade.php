@extends('admin.layout.app')
@section('title')
    Add new Slide
@endsection
@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css" integrity="sha512-C4k/QrN4udgZnXStNFS5osxdhVECWyhMsK1pnlk+LkC7yJGCqoYxW4mH3/ZXLweODyzolwdWSqmmadudSHMRLA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .preview {
            overflow: hidden;
        }
    </style>
@endpush
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-4 mx-auto pt-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Edit  SlideText</h1>
                    </div>
                    <form action="{{route('admin.slidetext.update')}}" id="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$slidetext->id}}"/>
                            <div class="form-group p-3">
                                <label for="name">Text</label>
                                <input type="text" name="text" class="form-control" value="{{$slidetext->text}}">
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <a href="" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection