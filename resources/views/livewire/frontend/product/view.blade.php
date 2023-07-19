<div>
    <div class="py-3 py-md-5 ">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                            {{-- <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img"> --}}
                            <div class="exzoom" id="exzoom">
                                <!-- Images -->
                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        @foreach ($product->productImages as $item)
                                            <li><img src="{{ asset($item->image) }}" /></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                                <div class="exzoom_nav"></div>
                                <!-- Nav Buttons -->
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn">
                                        < </a>
                                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            No Image Added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}
                        </h4>
                        <hr>
                        <p class="product-path">
                            <a href="{{ url('/collections/') }}" class="text-decoration-none"> Home</a> /
                            <a href="{{ url('/collections/' . $product->category->slug) }}"
                                class="text-decoration-none">{{ $product->category->name }}</a> /
                            <a href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}"
                                class="text-decoration-none"> {{ $product->name }}</a>
                        </p>
                        <p class="product-path">Origin:{{ $product->brand }}</p>
                        <div>
                            @if ($product->weight)
                                <span class="selling-price">${{ $product->selling_price }}
                                    <sup style="color: #B2B6B1">per carat</sup></span>
                                <span class="original-price"
                                    style="text-decoration: line-through;">${{ $product->original_price }} </span>
                            @else
                                <span class="selling-price">${{ $product->selling_price }}</span>
                                <span class="original-price"
                                    style="text-decoration: line-through;">${{ $product->original_price }}</span>
                            @endif

                        </div>
                        <div>
                            @if ($product->productColors->count() > 0)
                                @if ($product->productColors)
                                    @foreach ($product->productColors as $colorItem)
                                        {{--  <input type="radio" name="colorSelection"
                                            value="{{ $colorItem->id }}" />{{ $colorItem->color->name }} --}}
                                        <label class="colorSelectionLable"
                                            style="background-color:{{ $colorItem->color->code }}"
                                            wire:click="colorSelected({{ $colorItem->id }})">
                                            {{ $colorItem->color->name }}</label>
                                    @endforeach
                                @endif
                                <div>
                                    @if ($this->productColorSelectedQuantity == 'outofstock')
                                        <label class="btn-sm py-1 mt-2 text-white bg-danger">out of Stock</label>
                                    @elseif($this->productColorSelectedQuantity > 0)
                                        <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                    @endif
                                </div>
                            @else
                                @if ($product->quantity)
                                    <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                @else
                                    <label class="btn-sm py-1 mt-2 text-white bg-danger">out of Stock</label>
                                @endif
                            @endif
                        </div>
                        <div class="mt-2">
                            @if (!$product->weight || !$product->quantity == 0)
                                <div class="input-group">
                                    <span class="btn btn1" wire:click="decrementQuantity"><i
                                            class="fa fa-minus"></i></span>
                                    <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}"
                                        readonly value="1" class="input-quantity" />
                                    <span class="btn btn1" wire:click="incrementQuantity"><i
                                            class="fa fa-plus"></i></span>
                                </div>
                            @else
                                <div class="input-group">
                                    <input type="text" value="{{ $product->weight }} carat"
                                        class="input-quantity" />
                                </div>
                            @endif
                            <div class="mt-2">
                                <button href="" wire:click="addToCart({{ $product->id }})" type="button"
                                    class="btn btn1"> <i class="fa fa-shopping-cart"></i> Add To Cart</button>
                                <button wire:click="addToWishList({{ $product->id }})" href="button"
                                    class="btn btn1">
                                    <span wire:loading.remove wire:target="addToWishList">
                                        <i class="fa fa-heart"></i> Add To Wishlist
                                    </span>
                                    <span wire:loading wire:target="addToWishList">Adding...</span>
                                </button>
                            </div>
                            <div class="mt-3">
                                <h5 class="mb-0"></h5>
                                <p>
                                    {!! $product->small_description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- start comment --}}


                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                {{-- Tabs --}}
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab"
                                            aria-controls="description" aria-selected="true">Description</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                            aria-selected="false">Detail Data</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="comment-tab" data-bs-toggle="tab"
                                            data-bs-target="#comment" type="button" role="tab"
                                            aria-controls="comment" aria-selected="false">Comment</button>
                                    </li>
                                </ul>

                                {{-- Tab content --}}
                                <div class="tab-content mt-3" id="myTabContent">
                                    {{-- Description tab --}}
                                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <p>{!! $product->description !!}</p>
                                    </div>

                                    {{-- Detail Data tab --}}
                                    <div class="tab-pane fade" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Gemstone</td>
                                                    <td>Ruby</td>
                                                </tr>
                                                <tr>
                                                    <td>Treatment</td>
                                                    <td>Unheated and Untreated (No Indications Observed)</td>
                                                </tr>
                                                <tr>
                                                    <td>Cut</td>
                                                    <td>Faceted</td>
                                                </tr>
                                                <tr>
                                                    <td>Certification</td>
                                                    <td>Free Lab Certificate</td>
                                                </tr>
                                                <tr>
                                                    <td>Shape</td>
                                                    <td>Oval</td>
                                                </tr>
                                                <tr>
                                                    <td>Composition</td>
                                                    <td>Natural</td>
                                                </tr>
                                                <tr>
                                                    <td>Return Policy</td>
                                                    <td>10 Day Money-Back Returns*</td>
                                                </tr>
                                                <tr>
                                                    <td>Origin</td>
                                                    <td>Myanmar (Burma)</td>
                                                </tr>
                                                <tr>
                                                    <td>Colour</td>
                                                    <td>Red</td>
                                                </tr>
                                                <tr>
                                                    <td>Exact Dimensions</td>
                                                    <td>10.1x8.2x5.00 mm</td>
                                                </tr>
                                                <tr>
                                                    <td>Dimension Type</td>
                                                    <td>Calibrated</td>
                                                </tr>
                                                <tr>
                                                    <td>Specific Gravity</td>
                                                    <td>4</td>
                                                </tr>
                                                <tr>
                                                    <td>Refractive Index</td>
                                                    <td>1.760 - 1.770</td>
                                                </tr>
                                                <tr>
                                                    <td>Weight (carat)</td>
                                                    <td>4.16</td>
                                                </tr>
                                                <tr>
                                                    <td>Weight (ratti)</td>
                                                    <td>4.62</td>
                                                </tr>
                                                <tr>
                                                    <td>Weight (grams)</td>
                                                    <td>0.83</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Comment tab --}}
                                    <div class="tab-pane fade" id="comment" role="tabpanel"
                                        aria-labelledby="comment-tab">
                                        {{-- Comment area --}}
                                        <div class="comment-area mt-4">
                                            @if (session('message'))
                                                <h6 class="alert alert-warning mb-3">{{ session('message') }}</h6>
                                            @endif
                                            <div class="card card-body">
                                                <h6 class="card-title">Leave a comment (note that this comments is for
                                                    all
                                                    {{ $product->category->name }} Products)</h6>
                                                <form action="{{ url('comments') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="category_id"
                                                        value="{{ $product->category->id }}">
                                                    <textarea name="comment_body" id="" class="form-control" rows="3" required></textarea>
                                                    <button type="submit"
                                                        class="btn btn-primary mt-3">Submit</button>
                                                </form>
                                            </div>

                                            {{-- Comment cards --}}
                                            @php
                                                $perPage = 5; // Number of comments to display per page
                                                $comments = $product->category->comment->chunk($perPage); // Chunk comments into groups of $perPage
                                                $currentPage = request()->get('page', 1); // Get the current page number
                                                $totalPages = $comments->count(); // Get the total number of comment pages
                                            @endphp

                                            @if ($comments->isEmpty())
                                                <div class="card card-body shadow-sm mt-3">
                                                    <h6>No comments yet.</h6>
                                                </div>
                                            @else
                                                @php
                                                    $currentComments = $comments->get($currentPage - 1); // Get comments for the current page
                                                @endphp

                                                @foreach ($currentComments as $comment)
                                                    <div class="comment-container card card-body shadow-sm mt-3">
                                                        <div class="detail-area">
                                                            <h6 class="user-name mb-1">
                                                                @if ($comment->user)
                                                                    {{ $comment->user->name }}
                                                                @endif
                                                                <small class="ms-3 text-primary">Commented on:
                                                                    {{ $comment->created_at->format('d-m-y') }}</small>
                                                            </h6>
                                                            <p class="user-comment mb-1">
                                                                {!! $comment->comment_body !!}
                                                            </p>
                                                        </div>

                                                        @if (Auth::check() && Auth::id() == $comment->user_id)
                                                            <div>
                                                                <button type="button" value="{{ $comment->id }}"
                                                                    class="deleteComment btn btn-danger btn-sm me-2">Delete</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach

                                                <div class="pagination-buttons mt-3">
                                                    @if ($currentPage > 1)
                                                        <a href="?page={{ $currentPage - 1 }}"
                                                            class="btn btn-primary mr-2">Load Previous</a>
                                                    @endif

                                                    @if ($currentPage < $totalPages)
                                                        <a href="?page={{ $currentPage + 1 }}"
                                                            class="btn btn-primary">Load More</a>
                                                    @endif
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>




                            {{-- end comment --}}
                        </div>
                    </div>
                </div>

                <div class="py-3 py-md-5 bg-white ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Related
                                    @if ($category)
                                        {{ $category->name }}
                                    @endif
                                    Products
                                </h3>
                                <div class="underline"></div>
                            </div>
                            <div class="col-md-12">
                                @if ($category)
                                    <div class="owl-carousel owl-theme four-carousel">
                                        @foreach ($category->relatedproducts->take(16) as $relatedProductItem)
                                            <div class="item mb-3">
                                                <div class="product-card">
                                                    <div class="product-card-img">
                                                        @if ($relatedProductItem->productImages->count() > 0)
                                                            <a
                                                                href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                                <img src="{{ asset($relatedProductItem->productImages[0]->image) }}"
                                                                    alt="{{ $relatedProductItem->name }}">
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="product-card-body">
                                                        <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                                        <h5 class="product-name">
                                                            <a
                                                                href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                                {{ $relatedProductItem->name }}
                                                            </a>
                                                        </h5>
                                                        <div>
                                                            <span
                                                                class="selling-price">${{ $relatedProductItem->selling_price }}</span>
                                                            <span
                                                                class="original-price">${{ $relatedProductItem->original_price }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="p-2">
                                        <h4>No Related Product Available</h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-3 py-md-5 bg-light ">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Related
                                    @if ($category)
                                        {{ $product->brand }}
                                    @endif
                                    Products
                                </h3>
                                <div class="underline"></div>
                            </div>
                            <div class="col-md-12">
                                @if ($category)
                                    <div class="owl-carousel owl-theme four-carousel">
                                        @foreach ($category->relatedproducts->take(16) as $relatedProductItem)
                                            @if ($relatedProductItem->brand == "$product->brand")
                                                <div class="item mb-3">
                                                    <div class="product-card">
                                                        <div class="product-card-img">
                                                            @if ($relatedProductItem->productImages->count() > 0)
                                                                <a
                                                                    href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                                    <img src="{{ asset($relatedProductItem->productImages[0]->image) }}"
                                                                        alt="{{ $relatedProductItem->name }}">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="product-card-body">
                                                            <p class="product-brand">{{ $relatedProductItem->brand }}
                                                            </p>
                                                            <h5 class="product-name">
                                                                <a
                                                                    href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                                    {{ $relatedProductItem->name }}
                                                                </a>
                                                            </h5>
                                                            <div>
                                                                <span
                                                                    class="selling-price">${{ $relatedProductItem->selling_price }}</span>
                                                                <span
                                                                    class="original-price">${{ $relatedProductItem->original_price }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="p-2">
                                        <h4>No Related Product Available</h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @push('scripts')
                <script>
                    $(function() {

                        $("#exzoom").exzoom({


                            "navWidth": 60,
                            "navHeight": 60,
                            "navItemNum": 5,
                            "navItemMargin": 7,
                            "navBorder": 1,
                            "autoPlay": false,
                            "autoPlayTimeout": 2000

                        });

                    });
                </script>
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
                <script>
                    $(document).ready(function() {
                        // Switch tabs on click
                        $('.switch-tab').click(function(e) {
                            e.preventDefault();
                            $('.switch-tab').removeClass('active');
                            $(this).addClass('active');
                            $('.tab-content').removeClass('active');
                            $($(this).attr('href')).addClass('active');
                        });
                    });
                </script>
                <script>
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $(document).ready(function() {
                        $(document).on('click', '.deleteComment', function() {

                            if (confirm('Are you sure you want to delete your comment?')) {
                                var thisClicked = $(this);
                                var comment_id = thisClicked.val();

                                $.ajax({
                                    type: "POST",
                                    url: "/delete_comment",
                                    data: {
                                        'comment_id': comment_id
                                    },
                                    success: function(res) {
                                        if (res.status == 200) {
                                            thisClicked.closest('.comment-container').remove();
                                            alert(res.message);
                                        } else {
                                            alert(res.message);
                                        }
                                    }
                                });
                            }
                        });
                    })
                </script>
            @endpush
