@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Edit Color
                        <a href="{{ url('admin/colors') }}"class="btn btn-primary btn-sm text-white float-end">
                          Back
                          </a>
                    </h3>
                </div>
                <div class="card-body">
            <form action="{{url('admin/colors/'.$color->id)}}" method="post">
                @csrf
                @method('put')
                     <div class="mb-3">
                       <label for="">Color Name</label>
                       <input type="text" name="name" value="{{$color->name}}" class="form-control">
                     </div>
                     <div class="mb-3">
                       <label for="">Color Code</label>
                       <input type="text" name="code" {{$color->status ?'checked':''}} value="{{$color->name}}" class="form-control">
                     </div>
                     <div class="mb-3">
                       <label for="status">Status</label><br/>
                       <input type="checkbox" name="status" style="widht:40px; height:40px;"/>Checked==Hidden,UnChecked==visible
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
