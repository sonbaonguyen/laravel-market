<x-layout>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Upload product</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">
                Upload new product
            </span>
        </h2>
        <div class="row px-xl-5">
            <div class="col mb-5">
                <div class="row contact-form bg-light p-30">

                    <form class="col" method="POST" action="/products/upload" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="control-group">
                                    <label for="name">Product Name</label>
                                    <input type="name" class="form-control" id="name" name="name"
                                        required="required"
                                        data-validation-required-message="Please enter product name" value="{{old('name')}}" />
                                    <p class="help-block text-danger"></p>
                                    @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="control-group">
                                    <label for="price">Price</label>
                                    <input type="price" class="form-control" id="price" name="price"
                                        required="required"  value="{{old('price')}}"
                                        data-validation-required-message="Please enter product price" />
                                    <p class="help-block text-danger"></p>
                                    @error('price')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="control-group">
                                    <label for="short_description">Short description</label>
                                    <input type="short_description" class="form-control" id="short_description"
                                        name="short_description" required="required" value="{{old('short_description')}}"
                                        data-validation-required-message="Please enter short description" />
                                    <p class="help-block text-danger"></p>
                                    @error('short_description')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="control-group">
                                    <label for="long_description">Detail description</label>
                                    <input type="long_description" class="form-control" value="{{old('long_description')}}"
                                    id="long_description"
                                        name="long_description" required="required"
                                        data-validation-required-message="Please enter more detail" />
                                    <p class="help-block text-danger"></p>
                                    @error('long_description')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">

                                <div class="control-group">
                                    <label for="image_path">Image</label>
                                    <input type="file" class="form-control" id="image_path" name="image_path[]" multiple
                                        data-validation-required-message="Please enter product image" />
                                    <p class="help-block text-danger"></p>
                                </div>

                                {{-- Colors --}}
                                <div class="pt-2">
                                    <label>Available colors:</label>
                                    <div class="d-flex flex-wrap">

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="colors[]" class="custom-control-input" value="Black" id="color-Black">
                                            <label class="custom-control-label" for="color-Black">Black</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="colors[]" class="custom-control-input" value="White" id="color-White">
                                            <label class="custom-control-label" for="color-White">White</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="colors[]" class="custom-control-input" value="Red" id="color-Red">
                                            <label class="custom-control-label" for="color-Red">Red</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="colors[]" class="custom-control-input" value="Blue" id="color-Blue">
                                            <label class="custom-control-label" for="color-Blue">Blue</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="colors[]" class="custom-control-input" value="Green" id="color-Green">
                                            <label class="custom-control-label" for="color-Green">Green</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Sizes --}}
                                <div class="pt-2">
                                    <label>Available sizes:</label>
                                    <div class="d-flex flex-wrap">

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="sizes[]" class="custom-control-input" value="XS" id="size-XS">
                                            <label class="custom-control-label" for="size-XS">XS</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="sizes[]" class="custom-control-input" value="S" id="size-S">
                                            <label class="custom-control-label" for="size-S">S</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="sizes[]" class="custom-control-input" value="M" id="size-M">
                                            <label class="custom-control-label" for="size-M">M</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="sizes[]" class="custom-control-input" value="L" id="size-L">
                                            <label class="custom-control-label" for="size-L">L</label>
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3 ml-3">
                                            <input type="checkbox" name="sizes[]" class="custom-control-input" value="XL" id="size-XL">
                                            <label class="custom-control-label" for="size-XL">XL</label>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">
                                    Add product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
</x-layout>
