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

    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <img id="image" style="width: 100%" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancel">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="col-md-4 mx-auto pt-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Add new Slide</h1>
                    </div>
                    <form action="{{route('admin.slide.store')}}" id="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="imageData" name="image">
                        <div class="card-body">
                            <div class="text-center preview" style="min-height:200px">
                            </div>
                            <label for="image">Image</label>
                            <div class="input-group form-group">
                                <input required type="file" id="input" class="form-control image @error('image') is-invalid  @enderror"
                                    aria-label="Image" aria-describedby="file-manager">
                                @error('image')
                                    <span class="error invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            </div>

                            <div class="form-group">
                                <label for="name">Insert Link</label>
                                <input type="text" name="link" class="form-control" value="{{old('link')}}">
                            </div>

                            <div class="form-group">
                                <label for="sort">Sort</label>
                                <input type="number" name="sort" value="{{old('sort')}}" class="form-control">
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <a href="{{route('admin.dashboard')}}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
   <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;
        var form = {};

        $("body").on("change", ".image", function(e){
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('show');

            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            if(cropper){
                cropper.destroy();
            }
            cropper = new Cropper(image, {
                aspectRatio: 16/9,
                preview: '.preview',
                viewMode:3
            });
        })

        $('#cancel').click(function(){
            cropper.destroy();
            cropper = null
            $modal.modal('hide')
        })

        $("#crop").click(function(){
            canvas = cropper.getCroppedCanvas();

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    $('#imageData').val(reader.result); 
                    $modal.modal('hide')
                }
            });
        });

    </script>
@endpush