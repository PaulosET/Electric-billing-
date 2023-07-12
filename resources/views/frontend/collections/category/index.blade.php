@extends('layouts.app')
@section('title', 'All Categories')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Our Categories</h4>
                    <div class="underline"></div>
                </div>

                @forelse ($catagories as $catagoryItem)
                    <div class="col-6 col-md-3">
                        <div class="category-card">
                            <a href="{{ url('/collections/'.$catagoryItem->slug) }}">
                                <div class="category-card-img">
                                    <img src="{{ asset($catagoryItem->image) }}" class="w-100" alt="{{$catagoryItem->name}}">
                                </div>
                                <div class="category-card-body">
                                    <h5>{{ $catagoryItem->name }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <h5>No Category Available</h5>
                    </div>
                @endforelse


            </div>
        </div>
    </div>

@endsection
