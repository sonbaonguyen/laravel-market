@props(['product'])

@php
    $path = substr($product->image_path, 1);
    $images = explode('@', $path);
@endphp

<div class="product-item bg-light mb-4">
    <div
        class="product-img position-relative overflow-hidden img-contain-card-fixed d-flex justify-content-center align-items-center">
        {{-- <a href="/products/{{ $product->id }}"> --}}
        <img class="w-100 img-custom-size-fixed" src="{{ URL::to('/') }}/uploads/{{ $images[0] }}" alt="">
        <div class="product-action">
            @auth
            <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
            <form class="toggle-favorite-form"  method="POST">
                {{-- action="/products/{{ $product->id }}/favorite" --}}
                @csrf
                {{ $slot }}
                {{-- This used to contain data to ajax --}}
                <p class="toggle-favorite-pid" hidden>{{ $product->id }}</p>
            </form>
            @endauth
            <a class="btn btn-outline-dark btn-square" href="/products/{{ $product->id }}"><i
                    class="fa fa-search"></i></a>
        </div>
    </div>

    <div class="text-center">
        <a class="h6 text-decoration-none text-truncate " href="/products/{{ $product->id }}">
            <div class="img-product-card-title-custom">{{ $product->name }}</div>
            <div class="d-flex align-items-center justify-content-center">
                <h5>${{ $product->price }}</h5>
                <h6 class="text-muted ml-2"><del>${{ $product->price }}</del></h6>
            </div>
            <div class="d-flex align-items-center justify-content-center pb-4">
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small>({{ $product->total_review }})</small>
            </div>
        </a>
        {{-- @php
                $username = $product->user->name;
            @endphp
            <div class="mt-4">By {{$product->user->name}}</div> --}}

        {{-- @php
            // $path = substr($product->categories, 1);
            $items = explode(',', $product->categories);
            @endphp
            @if ($items)
            <div class="mt-3 mb-2">
            @foreach ($items as $item)
                <a class="bg-dark text-decoration-none text-secondary border d-inline-block px-2 my-1" href="#">{{$item}}</a>
            @endforeach
            </div>
            @endif --}}
    </div>
</div>
