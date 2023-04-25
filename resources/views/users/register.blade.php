<x-layout>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Register</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3 d-flex justify-content-center">
                Register your account
            </span>
        </h2>
        <div class="row px-xl-5">
            <div class="col mb-5 d-flex justify-content-center">
                <div class="row contact-form bg-light p-30 col-lg-6 col-md-8  col-sm-10 d-flex justify-content-center">

                    <div class="col-8 pr-4">
                        <div id="success"></div>

                        <form action="/register" method="POST">
                            @csrf
                            <div class="control-group">
                                <label for="name">Name</label>
                                <input type="name" class="form-control" id="name" name="name"
                                    required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                                @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="control-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    required="required" data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                                @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="control-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    required="required" data-validation-required-message="Please enter a password" />
                                <p class="help-block text-danger"></p>
                                @error('password')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="control-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                    required="required" data-validation-required-message="Please enter password confirm" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">
                                    Register
                                </button>
                            </div>
                            <div class="mt-5 d-flex">
                                <p>Already have an account?</p>
                                <a href="" class="pl-2 text-info">Login here</a>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
</x-layout>
