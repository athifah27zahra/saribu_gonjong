<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Desa Wisata Saribu Gonjong</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="keywords" />
        <meta content="" name="description" />

        <!-- Favicon -->
        <link href="media/icon/favicon.svg" rel="icon" />

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
                href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Quicksand:wght@600;700&display=swap"
                rel="stylesheet"
        />

        <!-- Icon Font Stylesheet -->
        <link
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
                rel="stylesheet"
        />
        <link
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
                rel="stylesheet"
        />

        <!-- Libraries Stylesheet -->
        <link href="assets/lib/animate/animate.min.css" rel="stylesheet" />
        <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet" />
        <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/landing-page/bootstrap.min.css" rel="stylesheet" />

        <!-- Template Stylesheet -->
        <link href="css/landing-page/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?= base_url('css/web.css'); ?>">

        <!-- Third Party CSS and JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/de7d18ea4d.js" crossorigin="anonymous"></script>

        <!-- Google Maps API and Custom JS -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8B04MTIk7abJDVESr6SUF6f3Hgt1DPAY&libraries=drawing"></script>
        <script src="<?= base_url('js/web.js'); ?>"></script>
    </head>
    <body>

    <!-- Spinner Start -->
    <div
            id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
    >
        <div
                class="spinner-border text-primary"
                style="width: 3rem; height: 3rem"
                role="status"
        >
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav
            class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-4 px-lg-5 wow fadeIn"
            data-wow-delay="0.1s"
    >
        <a href="/" class="navbar-brand p-0">
            <img class="img-fluid me-3" src="media/icon/logo.svg" alt="Icon" />
            <h1 class="m-0 text-primary">Tourism Village</h1>
        </a>
        <button
                type="button"
                class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse py-4 py-lg-0" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="#home" class="nav-item nav-link active">Home</a>
                <a href="/web" class="nav-item nav-link">Explore</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="#award" class="nav-item nav-link">Award</a>
            </div>
            <?php if (!logged_in()): ?>
            <a href="<?= base_url('login'); ?>" class="btn btn-primary">Login</a>
            <?php endif; ?>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid bg-dark p-0 mb-5" id="home">
        <div class="row g-0 flex-column-reverse flex-lg-row">
            <div class="col-lg-6 p-0 wow fadeIn" data-wow-delay="0.1s">
                <div
                        class="header-bg h-100 d-flex flex-column justify-content-center p-5"
                >
                    <h2 class="display-6 text-light mb-2">
                        Welcome to
                    </h2>
                    <h1 class="display-4 text-light mb-5">
                        Desa Wisata Saribu Gonjong
                    </h1>
                    <div class="d-flex align-items-center pt-4 animated slideInDown">
                        <a href="/web" class="btn btn-primary py-sm-3 px-3 px-sm-5 me-5"
                        >Explore</a
                        >
                        <button
                                type="button"
                                class="btn-play"
                                data-bs-toggle="modal"
                                data-src="<?= base_url('media/videos/opening1.mp4'); ?>"
                                data-bs-target="#videoModal"
                        >
                            <span></span>
                        </button>
                        <h6 class="text-white m-0 ms-4 d-none d-sm-block">Watch Video</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="media/photos/landing-page/carousel-1.jpg" alt="" />
                    </div>
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="media/photos/landing-page/carousel-2.jpg" alt="" />
                    </div>
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="media/photos/landing-page/carousel-3.jpg" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Video Modal Start -->
    <div
            class="modal modal-video fade"
            id="videoModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Video</h3>
                    <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <video
                                src=""
                                class="embed-responsive-item"
                                id="video"
                                controls
                                autoplay
                        >Sorry, your browser doesn't support embedded videos</video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->

    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row p-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p><span class="text-primary me-2">#</span>Welcome To Desa Wisata </p>
                    <h1 class="display-5 mb-4">
                        Why You Should Visit
                        Desa Wisata <span class="text-primary">Saribu Gonjong</span>
                    </h1>
                    <p class="mb-4">
                        Desa Wisata Saribu Gonjong terletak di Nagari Koto Tinggi, Kecamatan Gunuang Omeh Kabupaten Lima Puluh Kota  Sumatra Barat tepatnya di dataran tinggi gugusan Bukit Barisan yang dialiri oleh aliran hulu Batang Sinamar. Untuk menuju ke Desa Wisata Saribu Gonjong diperkirakan menempuh perjalanan dari Bandara Internasional Minangkabau lebih kurang 5 jam perjalanan. Di Desa Wisata Saribu Gonjong terdapat wisata yang berbasis budaya dengan adanya lebih kurang 29 buah rumah gadang dan beberapa situs sejarah. Dari sekian banyaknya rumah gadang, terdapat 8 buah rumah gadang yang sudah dijadikan Homestay bagi wisatawan yang berkunjung ke Desa Wisata Saribu Gonjong.
                    </p>
                    <h5 class="mb-3">
                        <a href="#map" class="text-reset" onclick="showMap('r');">
                            <i class="far fa-check-circle text-primary me-3"></i>Rumah Gadang
                        </a>
                    </h5>
                    <h5 class="mb-3">
                            <i class="far fa-check-circle text-primary me-3"></i>Tourism Package
                        </a>
                    </h5>
                    <h5 class="mb-3">
                        <a href="#map" class="text-reset" onclick="showMap('cp');">
                            <i class="far fa-check-circle text-primary me-3"></i>UMKM Place
                        </a>
                    </h5>
                    <h5 class="mb-3">
                        <a href="#map" class="text-reset" onclick="showMap('wp');">
                            <i class="far fa-check-circle text-primary me-3"></i>Worship Place
                        </a>
                    </h5>
                    <h5 class="mb-3">
                        <a href="#map" class="text-reset" onclick="showMap('sp');">
                            <i class="far fa-check-circle text-primary me-3"></i>Souvenir Place
                        </a>
                    </h5>
                    <h5 class="mb-3">
                        <a href="#map" class="text-reset" onclick="showMap('hp');">
                            <i class="far fa-check-circle text-primary me-3"></i>History Place
                        </a>
                    </h5>
                    
                    <a class="btn btn-primary py-3 px-5 mt-3" href="/web">Explore</a>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="img-border  ">
                        <img class="img-fluid" src="media/photos/landing-page/bg-about.jpg" alt="" />
                    </div>
                </div>
            </div>
            <div class="row p-5" id="map">
                <div class="mb-3">
                    <a class="btn btn-outline-danger float-end" onclick="closeMap();"><i class="fa-solid fa-xmark"></i></a>
                </div>
                <div class="col-lg-6 wow fadeInUp googlemaps" data-wow-delay="0.5s" id="googlemaps">
                    <script>initMap(); </script>
                    <div id="legend"></div>
                    <script>$('#legend').hide(); getLegend();</script>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Award Start -->
    <div
            class="container-xxl bg-primary facts my-5 py-5 wow fadeInUp"
            data-wow-delay="0.1s"
            id="award"
    >
        <div class="container py-5">
            <div class="row g-4">
                <div
                        class="col-md-6 col-lg-6 text-center wow fadeIn"
                        data-wow-delay="0.1s"
                >
                    <img src="media/photos/landing-page/trophy.png" alt="" style="filter: invert(100%); max-width: 4em" class="mb-3">
                    <h1 class="text-white mb-2" data-toggle="counter-up">50</h1>
                    <p class="text-white mb-0">Besar ADWI 2021</p>
                </div>
                <div
                        class="col-md-6 col-lg-6 text-center wow fadeIn"
                        data-wow-delay="0.3s"
                >
                    <img src="media/photos/landing-page/rumah-gadang.png" alt="" style="filter: invert(100%); max-width: 5em">
                    <h1 class="text-white mb-2" data-toggle="counter-up">29</h1>
                    <p class="text-white mb-0">Rumah Gadang</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Award End -->

    <!-- Footer Start -->
    <div
            class="container-fluid footer bg-dark text-light footer mt-5 pt-5 wow fadeIn"
            data-wow-delay="0.1s"
    >
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-9 col-md-6">
                    <h5 class="text-light mb-4">Address</h5>
                    <p class="mb-2">
                        <i class="fa fa-map-marker-alt me-3"></i>Nagari Koto Tinggi, Gunuang Omeh, Kabupaten Lima Puluh Kota, Sumatra Barat
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-phone-alt me-3"></i>+62 822 8909 7535
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-envelope me-3"></i>sarugokampuangwisata@gmail.com
                    </p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/kampung.wisata.sarugo/"
                        ><i class="fab fa-instagram"></i
                            ></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/Kampuang%20Sarugo"
                        ><i class="fab fa-facebook-f"></i
                            ></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Links</h5>
                    <a class="btn btn-link" href="#home">Home</a>
                    <a class="btn btn-link" href="/web">Explore</a>
                    <a class="btn btn-link" href="#about">About</a>
                    <a class="btn btn-link" href="#award">Award</a>
                    <a class="btn btn-link" href="<?= base_url('login'); ?>">Login</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Athifah Zahra</a>, All
                        Right Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"
    ><i class="bi bi-arrow-up"></i
        ></a>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/counterup/counterup.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('js/landing-page.js'); ?>"></script>
    <script>
        $('#map').hide();
        
        function closeMap() {
            $('#map').hide();
        }
    </script>
    <script>
        function showMap(category = null) {
            if ($('#map').hide()) {
                $('#map').show();
            }

            let URI = "<?= base_url('api')?>";
            clearMarker();
            clearRadius();
            clearRoute();
            if (category == 'r') {
                URI = URI + '/rumahGadang/new'
            } else if (category == 'ev') {
                URI = URI + '/event'
            } else if (category == 'cp') {
                URI = URI + '/umkmPlace/new'
            } else if (category == 'wp') {
                URI = URI + '/worshipPlace/new'
            } else if (category == 'sp') {
                URI = URI + '/souvenirPlace/new'
            } else if (category == 'hp') {
                URI = URI + '/historyPlace/new'
            }

            currentUrl = '';
            $.ajax({
                url: URI,
                dataType: 'json',
                success: function (response) {
                    let data = response
                    // let data = response.data
                    for(i in data) {
                        let item = data[i];
                        currentUrl = currentUrl + item.id;
                        objectMarker(item.id, item.lat, item.lng);
                    }
                    boundToObject();
                    // console.log(data);
                }
            })
        }
    </script>
    </body>
</html>