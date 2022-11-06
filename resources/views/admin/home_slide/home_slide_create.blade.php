@extends('admin.admin_master')
@section('bodySection')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Home Slide Page </h4>
                            <form method="post" action="{{ route('home.slide.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="title" class="form-control" type="text" required
                                            value="{{ old('title') }}" id="title">
                                    </div>
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="short_title" class="col-sm-2 col-form-label">Short Title </label>
                                    <div class="col-sm-10">
                                        <input name="short_title" class="form-control" type="text"
                                        value="{{ old('short_title') }}" id="short_title">
                                    </div>
                                    <x-input-error :messages="$errors->get('short_title')" class="mt-2" />
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="video_url" class="col-sm-2 col-form-label">Video URL </label>
                                    <div class="col-sm-10">
                                        <input name="video_url" class="form-control" type="text"
                                            value="{{ old('video_url') }}" id="video_url">
                                    </div>
                                    <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="home_slide" class="col-sm-2 col-form-label">Slider Image </label>
                                    <div class="col-sm-10">
                                        <input name="home_slide" 
                                            class="form-control" 
                                            type="file" id="image">
                                    </div>
                                    <x-input-error :messages="$errors->get('home_slide')" class="mt-2" />
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="showImage" class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg"
                                            src="{{ url('upload/no_image.jpg') }}"
                                            alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Slide">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
