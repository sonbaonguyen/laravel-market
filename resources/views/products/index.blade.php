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
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">
                    Filter by
                </span></h5>
                <div class="bg-light px-4 py-3 mb-30">
                    <form id="form-filter" action="/products/filter" method="POST">
                        @csrf
                        <div class="mb-4">
                            <h4>Price</h4>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>From: <span>0$</span></div>
                            <div>To: <span id="maxrange">500$</span></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <input id="price_filter" name="max_price" class="w-100" type="range" min="0" max="500"
                                step="20"
                                oninput="document.getElementById('maxrange').innerHTML = this.value + '$'">
                        </div>
                        <div class="mb-4 mt-5">
                            <h4>Color</h4>
                        </div>
                        <div class="d-flex flex-wrap">
                            @php
                                $colors = config('constants.COLORS');
                            @endphp
                            @foreach ($colors as $color)
                                <div class="custom-control custom-checkbox mb-3 ml-3">
                                    <input type="checkbox" name="colors[]" class="custom-control-input" value="{{$color}}"
                                        id="color-{{$color}}">
                                    <label class="custom-control-label" for="color-{{$color}}">{{$color}}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-4 mt-5">
                            <h4>Size</h4>
                        </div>
                        <div class="d-flex flex-wrap">
                            @php
                                $sizes = config('constants.SIZES');
                            @endphp
                            @foreach ($sizes as $size)
                                <div class="custom-control custom-checkbox mb-3 ml-3">
                                    <input type="checkbox" name="sizes[]" class="custom-control-input" value="{{$size}}"
                                        id="size-{{$size}}">
                                    <label class="custom-control-label" for="size-{{$size}}">{{$size}}</label>
                                </div>
                            @endforeach
                        </div>
                </div>

                <button class="btn btn-warning text-uppercase px-4 py-2" type="submit">Filter</button>
                <!-- Size End -->
            </form>
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
                                    {{-- <div class=""> --}}
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
                                    {{-- </div> --}}
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

                    <div id="productlist_container" class="d-flex flex-wrap w-100">
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
                                            <a class="btn btn-outline-dark btn-square favorite-link-btn active"
                                                href="#">
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
                    </div>

                    @if (count($products) > 0)
                        <div class="col-12 pr-5 mt-4 d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
</x-layout>
