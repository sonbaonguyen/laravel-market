<x-layout>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Shop</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by price</span></h5>
                <div class="bg-light px-4 py-3 mb-30">
                    <form>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>From: <span>$0</span></div>
                            <div>To: <span>$500</span></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <input class="w-100" type="range" max="500">
                        </div>

                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">

                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            {{-- <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div> --}}
                            @if (!empty($message))
                                @if (count($message) > 0)
                                    <div class="">
                                        <h2>
                                            @php
                                                $str = '';
                                                if (count($products) <= 0) {
                                                    $str = 'No result for \'';
                                                } else {
                                                    $str = 'Results for \'';
                                                }
                                                for ($index = 0; $index < count($message); $index++) {
                                                    if ($index == 0) {
                                                        $str = $str . $message[$index];
                                                    } elseif ($index == count($message) - 1) {
                                                        $str = $str . ' ' . $message[$index];
                                                    } else {
                                                        $str = $str . ' ' . $message[$index] . ' and';
                                                    }
                                                }
                                                $str = $str . '\'';
                                            @endphp
                                            {{ $str }}
                                        </h2>
                                    </div>
                                @endif
                            @else
                                <div>
                                    <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                    <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                                </div>
                            @endif
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty($favorites)
                        @foreach ($products as $item)
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
                                <x-product-card :product="$item">
                                    <a class="btn btn-outline-dark btn-square favorite-link-btn" href="#">
                                        <button class="w-100 h-100 border-0 " type="submit"><i
                                                class="far fa-heart"></i></button>
                                    </a>
                                </x-product-card>
                            </div>
                        @endforeach
                    @else
                        @foreach ($products as $item)
                            @if (in_array($item->id, $favorites))
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
                                    <x-product-card :product="$item">
                                        <a class="btn btn-outline-dark btn-square favorite-link-btn active" href="#">
                                            <button class="w-100 h-100 border-0 " type="submit"><i
                                                    class="far fa-heart active"></i></button>
                                        </a>
                                    </x-product-card>
                                </div>
                            @else
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
                                    <x-product-card :product="$item">
                                        <a class="btn btn-outline-dark btn-square favorite-link-btn" href="#">
                                            <button class="w-100 h-100 border-0 " type="submit"><i
                                                    class="far fa-heart"></i></button>
                                        </a>
                                    </x-product-card>
                                </div>
                            @endif
                        @endforeach
                    @endempty

                    @if (count($products) > 0)
                    <div class="col-12 pr-5 mt-4 d-flex justify-content-center">
                        {{$products->links()}}
                    </div>
                    @endif
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
</x-layout>
