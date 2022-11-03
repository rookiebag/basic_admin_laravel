@extends('admin.admin_master')
@section('bodySection')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Profile Page </h4>
                            <form method="post" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" class="form-control" type="text"
                                            value="{{ $editData->name }}" id="name">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">User Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" class="form-control" type="text"
                                            value="{{ $editData->email }}" id="email">
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">UserName</label>
                                    <div class="col-sm-10">
                                        <input name="username" class="form-control" type="text"
                                            value="{{ $editData->username }}" id="username">
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="image" class="col-sm-2 col-form-label">Profile Image </label>
                                    <div class="col-sm-10">
                                        <input name="profile_image" class="form-control" type="file" id="image">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="showImage" class="col-sm-2 col-form-label"> </label>
                                    <div class="col-sm-10">
                                        @if ($editData->profile_pic)
                                        <img id="showImage" class="rounded avatar-lg"
                                            src="{{ asset('adminProfiles/'.$editData->profile_pic ) }}" 
                                            alt="Card image cap">
                                        @else
                                            <img id="showImage" class="rounded avatar-lg"
                                            src="{{ asset('backend/assets/images/small/img-5.jpg') }}" 
                                            alt="Card image cap">
                                        @endif
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
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
