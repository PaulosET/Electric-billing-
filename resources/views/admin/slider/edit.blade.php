@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Edit Slider
                        <a href="{{ url('admin/sliders' . $slider->id) }}"class="btn btn-primary btn-sm text-white float-end">
                            Back
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/sliders/'. $slider->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT');
                        <div class="mb-3">
                            <label for="">Title</label>
                            <input type="text" value="{{ $slider->title }}"name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" row="3">{{ $slider->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="{{ asset("$slider->image") }}" style="width:50px; height:50px" alt="slider">
                        </div>

                        <div class="mb-3">
                            <label for="status" {{ $slider->status == '1' ? 'checked' : '' }}>Status</label><br />
                            <input type="checkbox" name="status"
                                style="widht:40px; height:40px;" />Checked==Hidden,UnChecked==visible
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
