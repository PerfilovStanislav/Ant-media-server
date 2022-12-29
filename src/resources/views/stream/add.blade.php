@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 offset-4">
            @include('layouts.message')

            <div class="card">
                <div class="card-header text-center font-weight-bold">
                    Add new stream
                </div>
                <div class="card-body">
                    <form id="add-stream-form" name="add-stream" method="post" action="{{ route('stream.add.post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="5" >{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group mt-3 d-flex flex-column">
                            <label for="image_preview">Select preview image</label>
                            <input type="file" id="image_preview" name="preview" class="form-control">
                        </div>
                        <div class="form-group mt-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
