@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div id="carouselExampleDark" class="carousel carousel-dark slide">

        <div class="carousel-inner">

            @foreach ($slider as $key => $sliderItem)
                <div class="carousel-item {{ $key == '0' ? 'active' : '' }}">
                    @if ($sliderItem->image)
                        <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100" alt="...">
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1>

                                {!! $sliderItem->title !!}

                            </h1>
                            <p>
                                {!! $sliderItem->description !!}
                            </p>
                            <div>
                                <a href="#" class="btn btn-slider">
                                    Get Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>{{ $setting->page_title }}</h4>
                    <div class="underline mx-auto"></div>

                    <p>
                        {{ $setting->meta_description }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Products </h4>

                    <div class="underline"></div>
                </div>
                @if ($trendingProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($trendingProducts as $productsItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">


                                            <label class="stock bg-danger">New</label>

                                            @if ($productsItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}">
                                                    <img src="{{ asset($productsItem->productImages[0]->image) }}"
                                                        alt="{{ $productsItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productsItem->brand }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}">
                                                    {{ $productsItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">${{ $productsItem->selling_price }}</span>
                                                <span class="original-price">${{ $productsItem->original_price }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Product Available</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>New Arrivals <a href="{{ url('/new-arrivals') }}" class="btn btn-warning float-end">View More</a>
                    </h4>

                    <div class="underline"></div>
                </div>
                @if ($newArrivalsProduct)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($newArrivalsProduct as $productsItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">


                                            <label class="stock bg-danger">New</label>

                                            @if ($productsItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}">
                                                    <img src="{{ asset($productsItem->productImages[0]->image) }}"
                                                        alt="{{ $productsItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productsItem->brand }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}">
                                                    {{ $productsItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">${{ $productsItem->selling_price }}</span>
                                                <span class="original-price">${{ $productsItem->original_price }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No New Arrivlas Available</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Featured Products <a href="{{ url('/featured-products') }}" class="btn btn-warning float-end">View
                            More</a></h4>

                    <div class="underline"></div>
                </div>
                @if ($featuredProduct)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($featuredProduct as $productsItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">


                                            <label class="stock bg-danger">New</label>

                                            @if ($productsItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}">
                                                    <img src="{{ asset($productsItem->productImages[0]->image) }}"
                                                        alt="{{ $productsItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $productsItem->brand }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}">
                                                    {{ $productsItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">${{ $productsItem->selling_price }}</span>
                                                <span class="original-price">${{ $productsItem->original_price }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Featured Product Available</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('.four-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
@endsection
