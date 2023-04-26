@props(['product'])

@php
    $path = substr($product->image_path, 1);
    $images = explode('@', $path);
@endphp

    <div class="product-item bg-light mb-4">
        <div class="product-img position-relative overflow-hidden">
            <img class="img-fluid w-100" src="{{ URL::to('/') }}/storage/{{$images[0]}}" alt="">
            <div class="product-action">
                <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
                <form action="/products/{{$product->id}}/favorite" method="POST">
                    @csrf
                        {{$slot}}
                </form>
                <a class="btn btn-outline-dark btn-square" href="/products/{{$product->id}}"><i class="fa fa-search"></i></a>
            </div>
        </div>
        <div class="text-center py-4">
            <a class="h6 text-decoration-none text-truncate" href="/products/{{$product->id}}">{{$product->name}}</a>
            <div class="d-flex align-items-center justify-content-center mt-2">
                <h5>${{$product->price}}</h5><h6 class="text-muted ml-2"><del>${{$product->price}}</del></h6>
            </div>
            <div class="d-flex align-items-center justify-content-center mb-1">
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small class="fa fa-star text-primary mr-1"></small>
                <small>({{$product->total_review}})</small>
            </div>

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
