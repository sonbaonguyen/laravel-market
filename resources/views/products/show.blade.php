<x-layout>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">{{ $product->name }}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    @php
        $path = substr($product->image_path, 1);
        $images = explode('@', $path);
    @endphp
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">

            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light img-bg-container-custom-size d-flex justify-content-center align-items-center">
                        <div>
                            @if ($images)
                                @for ($index = 0; $index < count($images); $index++)
                                    @if ($index == 0)
                                        <div class="carousel-item active">
                                            <img class="w-100 img-slide-custom-size"
                                                src="{{ URL::to('/') }}/uploads/{{ $images[$index] }}"
                                                alt="Image not found">
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img class="w-100 img-slide-custom-size"
                                                src="{{ URL::to('/') }}/uploads/{{ $images[$index] }}"
                                                alt="Image not found">
                                        </div>
                                    @endif
                                @endfor
                            @else
                                <div class="carousel-item active">
                                    <img class="w-100 img-slide-custom-size"
                                        src="{{ URL::to('/') }}/img/no-imagezzz.jpg" alt="Image not found">
                                </div>
                            @endif
                        </div>
                    </div>
                    @if (count($images) > 1)
                        <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30 px-5 py-5">
                    <h3>{{ $product->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">({{ $product->total_review }} Reviews)</small>
                    </div>

                    <h3 class="font-weight-semi-bold mb-4">${{ $product->price }}</h3>
                    <p class="mb-4">
                        {{ $product->short_description }}
                    </p>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Sizes:</strong>
                        @php
                            $str = substr($product->sizes, 1);
                            $itemSizes = explode('@', $str);
                        @endphp
                        <form>
                            @foreach ($itemSizes as $item)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="size-{{ $item }}"
                                        name="size-{{ $item }}">
                                    <label class="custom-control-label"
                                        for="size-{{ $item }}">{{ $item }}</label>
                                </div>
                            @endforeach
                        </form>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Colors:</strong>
                        @php
                            $str = substr($product->colors, 1);
                            $itemColors = explode('@', $str);
                        @endphp
                        <form>
                            @foreach ($itemColors as $item)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="color-{{ $item }}"
                                        name="color-{{ $item }}">
                                    <label class="custom-control-label"
                                        for="color-{{ $item }}">{{ $item }}</label>
                                </div>
                            @endforeach
                        </form>
                    </div>
                    <div class="d-flex align-items-center mb-3 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3 mr-3"><i class="fa fa-shopping-cart mr-1"></i>
                            Add to cart
                        </button>
                    </div>
                    <div class="mb-4 pt-2">
                        <button class="btn btn-primary px-3 mr-3"><i class="fa fa-heart mr-1"></i>
                            Add favourite
                        </button>
                    </div>

                    @php
                        $length = Str::length($product->categories);
                        $str = Str::substr($product->categories, 1, $length - 2);
                        // $path = substr($product->categories, 1);
                        $items = explode('@', $str);
                    @endphp

                    @if ($items)
                        <div class="mb-3">
                            @foreach ($items as $item)
                                <a class="bg-dark text-decoration-none text-secondary border d-inline-block px-2"
                                    href="/products/?category={{ $item }}">{{ $item }}</a>
                            @endforeach
                        </div>
                    @endif

                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $isAuthorized = false;
            if (Auth::check()) {
                if (Auth::user()->id == $product->user_id) {
                    $isAuthorized = true;
                }
            }
        @endphp
        @if ($isAuthorized)
            <div class="col px-xl-5 pb-3 d-flex justify-content-end">
                <a class="btn btn-primary px-3 ml-3" href="/products/{{ $product->id }}/edit"><i
                        class="fa fa-shopping-cart mr-1"></i>
                    Edit product
                </a>

                <form method="POST" action="/products/{{ $product->id }}/delete">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger px-3 ml-3"><i class="fa fa-shopping-cart mr-1"></i>
                        Delete product
                    </button>
                </form>
            </div>
        @endif

        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab"
                            href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews
                            ({{ $product->total_review }})</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>
                                {{ $product->long_description }}
                            </p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">{{ $product->total_review }} review for "{{ $product->name }}"
                                    </h4>
                                    <div class="media mb-4">
                                        <img src="{{ URL::to('/') }}/img/user.jpg" alt="Image not found"
                                            class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam
                                                ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod
                                                ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked
                                        *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review"
                                                class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You
                May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($lastests as $item)
                        <x-product-card :product="$item" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
</x-layout>
