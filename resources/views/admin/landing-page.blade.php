@extends('layouts.admin')

@section('admin')
    @include('inc.admin.action-navbar')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="form">
                    <div class="form-group">
                        <label for="title" class=" font-weight-bold">Title</label>
                        <input type="email" name="title" class="form-control form-control-sm" id="title" placeholder="Tile">
                    </div>

                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Description</label>
                        <textarea rows="6" name="description" class="form-control form-control-sm" id="description" placeholder="Description"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-check-label font-weight-bold" for="upload">Upload image/video</label>

                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="image" name="file" class="custom-control-input" checked>
                                <label class="custom-control-label" for="image">Upload image</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="video" name="file" class="custom-control-input">
                                <label class="custom-control-label" for="video">Upload video</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <button type="submit" name="landing" class="btn btn-primary btn-sm">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
