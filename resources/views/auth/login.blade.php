<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />

    <!--====== Title ======-->
    <title>Welcome | Chat-Scribe</title>
    <meta name="theme-color" content="black">
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png" />

    <!--====== CSS Files LinkUp ======-->

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lineIcons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <style>
        .video {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            object-fit: cover;
            z-index: -1000;
            height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>

    <!--====== HEADER PART START ======-->
    <header class="header-area">
        <video class="video" autoplay muted>
            <source src="{{ asset('logo_animation.mp4') }}">
        </video>

        <!-- navbar area -->

        <div id="home" class="header-hero bg_cover">
            
            <div class="header-hero-image text-center wow fadeIn" data-wow-duration="1.3s" data-wow-delay="1.4s">
               
            </div>
           
            <a href="/auth/google/redirect" class="main-btn "
                style="text-decoration: none ; background-color:#4B8AE8; font-family:Helvetica;"
                data-wow-duration="1.3s" data-wow-delay="1.1s">
                Sign In
            </a>
           
            <div id="particles-1" class="particles"></div>
        </div>
        <!-- header hero -->
    </header>



</body>

</html>
