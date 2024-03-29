@props(['favorites'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CodoShop - Online Shop For You</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ URL::to('/') }}/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ URL::to('/') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ URL::to('/') }}/css/style.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/custom.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="#">Become a seller</a>
                    <a class="text-body mr-3" href="#">About</a>
                    <a class="text-body mr-3" href="#">Support</a>
                    <a class="text-body mr-3" href="#">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">


                    @auth

                        <div class="btn-group mx-1 text-center">
                            Hello {{ auth()->user()->name }}! How're you doing?
                        </div>
                        <div class="btn-group mx-1">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                data-toggle="dropdown">EN</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button">EN</button>
                                <button class="dropdown-item" type="button">VI</button>
                            </div>
                        </div>
                        <div class="btn-group mx-1">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-light">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="btn-group mx-1">
                            {{-- <button type="button" class="btn btn-sm btn-light" data-toggle="dropdown">Sign in</button> --}}
                            <a class="btn btn-sm btn-light" href="/login">Log in</a>
                        </div>
                        <div class="btn-group mx-1">
                            <a class="btn btn-sm btn-light" href="/register">Register</a>
                        </div>
                    @endauth

                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>

                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">
                            0
                        </span>

                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="/" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Codo</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="/products">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        @foreach ($categories as $category)
                            <a href="/products/?category={{ $category->name }}"
                                class="nav-item nav-link">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="/" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Codo</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse"
                        data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            {{-- <a href="/" class="nav-item nav-link active">Home</a>
                            <a href="/products" class="nav-item nav-link">Shop</a>
                            <a href="/products/uploaded" class="nav-item nav-link">My products</a>
                            <a href="/products/favorites" class="nav-item nav-link">My favorites</a>
                            <a href="/products/upload" class="nav-item nav-link">Upload product</a> --}}

                            <a href="/" class="{{ (request()->path() === ('/')) ? 'nav-item nav-link active' : 'nav-item nav-link' }}">Home</a>
                            <a href="/products" class="{{ (request()->path() === ('products')) ? 'nav-item nav-link active' : 'nav-item nav-link' }}">Shop</a>
                            <a href="/products/uploaded" class="{{ (request()->path() === ('products/uploaded')) ? 'nav-item nav-link active' : 'nav-item nav-link' }}">My products</a>
                            <a href="/products/favorites" class="{{ (request()->path() === ('products/favorites')) ? 'nav-item nav-link active' : 'nav-item nav-link' }}">My favorites</a>
                            <a href="/products/upload" class="{{ (request()->path() === ('products/upload')) ? 'nav-item nav-link active' : 'nav-item nav-link' }}">Upload product</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="/products/favorites" class="btn px-0 ml-3">
                                <i class="fas fa-heart text-primary"></i>
                                <span id="total-favorite"
                                    class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">
                                    0
                                </span>
                            </a>
                            <a href="#" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">
                                    0
                                </span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    {{ $slot }}


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed
                    dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="/"><i
                                    class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="/products"><i class="fa fa-angle-right mr-2"></i>
                                Shop</a>
                            <a class="text-secondary mb-2" href="/products/uploaded"><i
                                    class="fa fa-angle-right mr-2"></i>
                                My Products</a>
                            <a class="text-secondary mb-2" href="/products/favorites"><i
                                    class="fa fa-angle-right mr-2"></i>My Favorites</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="/products/uploaded"><i
                                    class="fa fa-angle-right mr-2"></i>
                                My Products</a>
                            <a class="text-secondary mb-2" href="/products/favorites"><i
                                    class="fa fa-angle-right mr-2"></i>My Favorites</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="https://pixabay.com/">Pixabay</a>. All Rights Reserved.
                    Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                    <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    {{-- <form action="/products/filter/price" method="POST">
                        @csrf
                        <button type="submit">Hello There</button>
                    </form>
                    <a href="/products/filter/price">Hello GET</a> --}}
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ URL::to('/') }}/img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ URL::to('/') }}/lib/easing/easing.min.js"></script>
    <script src="{{ URL::to('/') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="{{ URL::to('/') }}/mail/jqBootstrapValidation.min.js"></script>
    <script src="{{ URL::to('/') }}/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="{{ URL::to('/') }}/js/main.js"></script>

    <script>
        $(document).ready(function() {
            var loggedIn = {{ auth()->check() ? 'true' : 'false' }};

            if (loggedIn) {
                // Pass favorites to header id ('#total-favorite')
                $.ajax({
                    type: "POST",
                    url: "/favorites/count",
                    data: $(".toggle-favorite-form").serialize(),
                    success: function(response) {
                        $("#total-favorite").html(response);
                        console.log("Success with response = " + response);
                    },
                    error: function(error) {
                        console.log("Fail with response = " + error);
                    }
                });

                /** ------------ Events goes here
                 * These functions only run when called by actions
                 */

                // Toggle favorite
                $(".toggle-favorite-form").on("submit", function(e) {
                    e.preventDefault();
                    var productId = $(this).children(".toggle-favorite-pid").html();
                    var favoriteBtn = $(this).children(".favorite-link-btn");
                    // Toggle active to ON
                    favoriteBtn.toggleClass("active");
                    favoriteBtn.find("i").toggleClass("active");

                    $.ajax({
                        type: "POST",
                        url: "/products/" + productId + "/favorite",
                        data: $(".toggle-favorite-form").serialize(),
                        success: function(response) {
                            $("#total-favorite").html(response);
                            console.log("Item favorite state with id(" + productId +
                                ") has been toggle !");
                        },
                        error: function(error) {
                            // Toggle active back to OFF when error
                            favoriteBtn.toggleClass("active");
                            favoriteBtn.find("i").toggleClass("active");
                            console.error(
                                "Toggle favorite failed! Try fixing some bugs first.\nError: " +
                                error);
                        }
                    });
                })
            }

            // $("#form-filter").on('submit', function (e) {
            //     e.preventDefault();

            //     // Call ajax to get a list of filtered products with this price
            //     $.ajax({
            //         type: "POST",
            //         url: "/products/filter",
            //         // data: $(this).find("input").val(),
            //         data: 2,
            //         success: function(response) {
            //             console.log("Success: " + response);
            //         },
            //         error: function(error) {
            //             console.log("Error: " + error);
            //         }
            //     })
            // });


        });

    </script>
</body>

</html>
