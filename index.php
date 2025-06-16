<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/ASSETS/head-logo.jpeg" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JACKDULS&reg;</title>
    <link rel="icon" href="/ASSETS/head logo.jpeg" type="image/jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Add animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<style>
    /* Page Load Animation */
    .page-load-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #000;
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: fadeOut 1s ease-in-out forwards;
        animation-delay: 1.5s;
    }

    .loader-logo {
        width: 150px;
        opacity: 0;
        animation: zoomIn 1s ease-out forwards, fadeOutLogo 0.5s ease-in-out forwards;
        animation-delay: 0.3s, 1.3s;
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.5);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes fadeOutLogo {
        to {
            opacity: 0;
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            visibility: hidden;
        }
    }

    /* Content Animation */
    .animate-on-load {
        opacity: 0;
        animation: fadeInUp 0.8s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Delay animations for different sections */
    .navbar {
        animation-delay: 0.2s;
    }

    .marquee {
        animation-delay: 0.3s;
    }

    .carousel {
        animation-delay: 0.4s;
    }

    .slogan-image-container {
        animation-delay: 0.5s;
    }

    #about-us-section {
        animation-delay: 0.6s;
    }

    .card-parallax {
        animation-delay: 0.7s;
    }

    footer {
        animation-delay: 0.8s;
    }

    /* Navbar Hover Animations */
    .nav-hover-effect {
        position: relative;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .nav-link-text {
        position: relative;
        z-index: 1;
    }

    .nav-hover-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #000;
        transition: width 0.3s ease, left 0.3s ease;
    }

    .nav-hover-effect:hover .nav-hover-line {
        width: 100%;
        left: 0;
    }

    .nav-hover-effect:hover {
        transform: translateY(-2px);
    }

    /* Dropdown Animation */
    .dropdown-menu-animated {
        display: block;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .dropdown:hover .dropdown-menu-animated {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-menu-animated .dropdown-item {
        transition: all 0.2s ease;
        transform: translateX(-5px);
        opacity: 0.8;
    }

    .dropdown-menu-animated .dropdown-item:hover {
        transform: translateX(0);
        opacity: 1;
        background-color: rgba(0, 0, 0, 0.05);
    }

    /* Cart Icon Animation */
    .cart-icon-wrapper {
        position: relative;
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .cart-icon-wrapper:hover {
        transform: scale(1.1);
    }

    .cart-pulse {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 10px;
        height: 10px;
        background-color: #ff0000;
        border-radius: 50%;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .cart-icon-wrapper:hover .cart-pulse {
        animation: pulse 1.5s infinite;
        opacity: 1;
    }

    @keyframes pulse {
        0% {
            transform: scale(0.8);
            box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.7);
        }

        70% {
            transform: scale(1.1);
            box-shadow: 0 0 0 10px rgba(255, 0, 0, 0);
        }

        100% {
            transform: scale(0.8);
            box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
        }
    }

    .marquee {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
    }

    .marquee span {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 10s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translate(0, 0);
        }

        100% {
            transform: translate(-100%, 0);
        }
    }

    .card-parallax {
        justify-content: center;
        align-items: center;
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
        margin: 40px 20px;
        perspective: 1000px;
    }

    .parallax-card {
        width: 20rem;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.5s, box-shadow 0.5s;
        transform-style: preserve-3d;
        position: relative;
        background: white;
        cursor: pointer;
    }

    .parallax-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0) 60%);
        z-index: 2;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .parallax-card:hover::before {
        opacity: 1;
    }

    .card-img-container {
        position: relative;
        overflow: hidden;
        height: 250px;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .parallax-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .card-body {
        padding: 20px;
        text-align: center;
        background: white;
        position: relative;
        z-index: 1;
    }

    .card-title {
        font-weight: 600;
        color: #333;
        margin: 0;
        font-size: 1.4rem;
        transition: color 0.3s;
    }

    .parallax-card:hover .card-title {
        color: #000;
    }

    .card-hover-effect {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at var(--x) var(--y), rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0) 70%);
        opacity: 0;
        transition: opacity 0.3s;
        pointer-events: none;
    }

    .parallax-card:hover .card-hover-effect {
        opacity: 1;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* Glow effect on hover */
    .parallax-card:hover {
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
    }

    /* 3D Tilt Effect for News Section */
    .parallax-img-container {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        transform-style: preserve-3d;
        transition: transform 0.1s;
        perspective: 1000px;
    }

    .parallax-img {
        transition: transform 0.1s;
        width: 100%;
        height: auto;
        transform: translateZ(0);
    }

    .img-hover-effect {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at var(--mouse-x) var(--mouse-y),
                rgba(255, 255, 255, 0.3) 0%,
                rgba(255, 255, 255, 0) 70%);
        opacity: 0;
        transition: opacity 0.3s;
        pointer-events: none;
    }

    .parallax-img-container:hover .img-hover-effect {
        opacity: 1;
    }

    .hover-3d {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .hover-3d:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .shop-now {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-top: 10px;
        font-weight: 600;
        color: #333;
        transition: color 0.3s;
    }

    .parallax-card:hover .shop-now {
        color: #000;
    }

    .cart-icon-container {
        position: relative;
        width: 40px;
        height: 40px;
        margin: 10px auto 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cart-icon {
        font-size: 1.5rem;
        color: #333;
        transition: all 0.3s ease;
    }

    .plus-icon {
        position: absolute;
        font-size: 0.8rem;
        color: white;
        background: #333;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        top: -5px;
        right: -5px;
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s ease;
    }

    .parallax-card:hover .cart-icon {
        transform: scale(1.2);
        color: #000;
    }

    .parallax-card:hover .plus-icon {
        opacity: 1;
        transform: scale(1);
        background: #000;
    }

    .parallax-card .cart-icon-container:hover .cart-icon {
        animation: cartBounce 0.5s ease;
    }

    @keyframes cartBounce {

        0%,
        100% {
            transform: translateY(0) scale(1.2);
        }

        50% {
            transform: translateY(-5px) scale(1.3);
        }
    }

    html {
        scroll-behavior: smooth;
    }
</style>

<body>
    <!-- Page Load Animation -->
    <div class="page-load-animation">
        <img src="ASSETS\head-logo.jpeg" alt="JACKDULS Logo" class="loader-logo">
    </div>

    <!-- NAVBAR -->
    <nav style="padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.6);"
        class="navbar navbar-expand-lg sticky-top animate-on-load">
        <div class="container">
            <!-- LOGO -->
            <a style="font-weight: bold;" class="navbar-brand" href="/">JACKDULS&reg;</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <!-- MENU -->
                <ul style="font-weight:bold;" class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active nav-hover-effect" aria-current="page" href="index.php">
                            <span class="nav-link-text">Home</span>
                            <span class="nav-hover-line"></span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle nav-hover-effect" href="shop.php" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="nav-link-text">Shop</span>
                            <span class="nav-hover-line"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-animated">
                            <li><a class="dropdown-item" href="shop/kaos.php">Kaos</a></li>
                            <li><a class="dropdown-item" href="shop/celana.php">Celana</a></li>
                            <li><a class="dropdown-item" href="shop/topi.php">Topi</a></li>
                            <li><a class="dropdown-item" href="shop/jacket.php">Jacket</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
    <?php if (isset($_SESSION['loggedin'])): ?>
        <a class="nav-link active nav-hover-effect" href="support.php">
            <span class="nav-link-text">Support</span>
            <span class="nav-hover-line"></span>
        </a>
    <?php else: ?>
        <a class="nav-link active nav-hover-effect" href="login.php?redirect=support.php">
            <span class="nav-link-text">Support</span>
            <span class="nav-hover-line"></span>
        </a>
    <?php endif; ?>
</li>
                </ul>
            </div>

            <!-- CART ICON  -->
                <a href="<?php echo isset($_SESSION['loggedin']) ? 'card.php' : 'login.php?redirect=card.php'; ?>" 
   id="cartIcon" class="cart-icon-wrapper">
    <img style="height:24px; width:24px;" src="ASSETS/SHOPcart.png" alt="Cart">
    <span class="cart-pulse"></span>
</a>
<script>

adocument.addEventListener('DOMContentLoaded', function () {
    const cartLink = document.getElementById('cartIcon');

    if (cartLink && cartLink.getAttribute('href').includes('login.php')) {
        cartLink.addEventListener('click', function (e) {
            alert('Anda harus login terlebih dahulu.');
            // Browser otomatis mengarahkan ke login.php?redirect=card.php
        });
    }
});
</script>

        <?php if (isset($_SESSION['loggedin'])): ?>
    <a style="color:black; font-weight:bold" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="btn btn-sm btn-outline-light ms-2">Logout</a>
<?php else: ?>
    <a style="color:black; font-weight:bold" href="login.php?redirect=index.php" class="btn btn-sm btn-outline-light ms-2">Login</a>
<?php endif; ?>
                
            </div>

    </nav>

    <!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin keluar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="logout.php" class="btn btn-danger">Ya, Logout</a>
      </div>
    </div>
  </div>
</div>

    <div class="marquee bg-black text-white py-2 animate-on-load">
        <span style="font-size: 1.5rem;">Welcome to JACKDULS&reg; - Streetwear for the Brave &nbsp;&nbsp;&nbsp; |
            &nbsp;&nbsp;&nbsp; Free Shipping over Rp500.000!</span>
    </div>

    <!-- COROUSEL -->
    <div id="carouselExampleAutoplaying" class="carousel slide animate-on-load" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
                <video class="d-block w-100" autoplay loop muted playsinline>
                    <source src="ASSETS\videoberanda.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="slogan-image-container animate-on-load">
            <img src="ASSETS/sloganberanda.png" alt="Slogan Jackduls" class="img-fluid w-100">
        </div>
    </div>

    <!-- NEWS SECTION -->
    <div class="container my-5 animate-on-load" id="about-us-section">
        <!-- First Article with 3D Effect -->
        <div class="row align-items-center mb-5 article-3d">
            <div class="col-md-6">
                <div class="parallax-img-container" onmousemove="handleImgMove(this, event)"
                    onmouseleave="handleImgLeave(this)">
                    <img src="ASSETS/beranda1.png" class="img-fluid rounded parallax-img" alt="Jackduls Store">
                    <div class="img-hover-effect"></div>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="fw-bold">Jackduls&reg; Apparel dari Sidoarjo Buka Flagship Store di Surabaya</h3>
                <p>Jackduls, apparel start up asal Sidoarjo yang kental dengan budaya custom culture resmi membuka
                    flagship store pertamanya di Sidoarjo, Minggu (29/9)...</p>
                <a href="#" class="btn btn-dark hover-3d">Read More</a>
            </div>
        </div>

        <!-- Second Article with 3D Effect -->
        <div class="row align-items-center article-3d">
            <div class="col-md-6 order-md-2">
                <div class="parallax-img-container" onmousemove="handleImgMove(this, event)"
                    onmouseleave="handleImgLeave(this)">
                    <img src="ASSETS/beranda2.png" class="img-fluid rounded parallax-img" alt="Jackduls Founders">
                    <div class="img-hover-effect"></div>
                </div>
            </div>
            <div class="col-md-6 order-md-1">
                <h3 class="fw-bold">Jackduls&reg; Since 2024</h3>
                <p>"Pada Sabtu malam nan cerah di penghujung Bulan April ini, Jecky bersama para rekan Developers
                    nya...Raka dan Heral<br>Memulai Perjalanan karirnya dalam dunia Start up fashion...</p>
                <a href="#" class="btn btn-dark hover-3d">Read More</a>
            </div>
        </div>
    </div>

    <!-- HORIZONTAL CARD -->
    <nav class="card-parallax animate-on-load">
        <a href="SHOP/kaos.php">
            <div class="parallax-card" onmousemove="handleMouseMove(this, event)" onmouseleave="handleMouseLeave(this)">
                <div class="card-img-container">
                    <img src="ASSETS/bajuberanda.jpeg" class="card-img-top" alt="Tshirt">
                    <div class="card-hover-effect"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Tshirt</h5>
                    <div class="cart-icon-container">
                        <i class="fas fa-shopping-cart cart-icon"></i>
                        <i class="fas fa-plus plus-icon"></i>
                    </div>
                </div>
            </div>
        </a>

        <a href="SHOP/celana.php">
            <div class="parallax-card" onmousemove="handleMouseMove(this, event)" onmouseleave="handleMouseLeave(this)">
                <div class="card-img-container">
                    <img src="ASSETS/celanaberanda.jpeg" class="card-img-top" alt="Pants">
                    <div class="card-hover-effect"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pants</h5>
                    <div class="cart-icon-container">
                        <i class="fas fa-shopping-cart cart-icon"></i>
                        <i class="fas fa-plus plus-icon"></i>
                    </div>
                </div>
            </div>
        </a>

        <a href="shop/topi.php">
            <div class="parallax-card" onmousemove="handleMouseMove(this, event)" onmouseleave="handleMouseLeave(this)">
                <div class="card-img-container">
                    <img src="ASSETS/Caps/cap 8.jpeg" class="card-img-top" alt="Cap">
                    <div class="card-hover-effect"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Cap</h5>
                    <div class="cart-icon-container">
                        <i class="fas fa-shopping-cart cart-icon"></i>
                        <i class="fas fa-plus plus-icon"></i>
                    </div>
                </div>
            </div>
        </a>

        <a href="shop/jacket.php">
            <div class="parallax-card" onmousemove="handleMouseMove(this, event)" onmouseleave="handleMouseLeave(this)">
                <div class="card-img-container">
                    <img src="ASSETS/jacketberanda.jpeg" class="card-img-top" alt="Jacket">
                    <div class="card-hover-effect"></div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Jacket</h5>
                    <div class="cart-icon-container">
                        <i class="fas fa-shopping-cart cart-icon"></i>
                        <i class="fas fa-plus plus-icon"></i>
                    </div>
                </div>
            </div>
        </a>
    </nav>

    <!-- FOOTER -->
    <div class="marquee bg-black text-white py-2 animate-on-load">
        <span style="font-size: 1.2rem;">🔥 Temukan Koleksi Terbaru Jackduls&reg; | 👠🛍👕👢👚👖👗👞👟👛🛒 | Shop Now!
            🔥</span>
    </div>
    <!-- FOOTER -->
        <footer class="bg-black text-white pt-4">
            <div class="container text-center text-md-start">
                <div class="row">
                    <!-- Branding -->
                    <div class="col-md-4 mb-4">
                        <h5 class="fw-bold">JACKDULS</h5>
                        <p class="">Fashion that fits your freedom. Discover your style with JACKDULS Pants®.
                        </p>
                    </div>

                    <!-- Links -->
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase fw-bold mb-3">Quick Links</h6>
                        <ul class="list-unstyled">
                            <li><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                            <li><a href="SHOP/kaos.php" class="text-white text-decoration-none">Shop</a></li>
                        </ul>
                    </div>

                    <!-- Social -->
                    <div class="col-md-4 mb-4">
                        <h6 class="text-uppercase fw-bold mb-3">Follow Us</h6>
                        <a href="https://www.instagram.com/jackduls/" target="_blank"
                            class="text-white text-decoration-none d-block mb-2">
                            Instagram
                        </a>
                        <a href="https://www.instagram.com/jackduls/" target="_blank"
                            class="text-white text-decoration-none d-block mb-2">
                            TikTok
                        </a>
                        <a href="https://www.instagram.com/jackduls/" class="text-white text-decoration-none d-block">
                            Email Us
                        </a>
                    </div>
                </div>
                <hr class="bg-light" />
                <div class="text-center pb-3">
                    &copy; 2024 JACKDULS - All Rights Reserved
                </div>
            </div>
        </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script>
        // Set current year in footer
        document.getElementById('year').textContent = new Date().getFullYear();

        // Horizontal card effect
        function handleMouseMove(card, event) {
            const cardRect = card.getBoundingClientRect();
            const x = event.clientX - cardRect.left;
            const y = event.clientY - cardRect.top;

            const centerX = cardRect.width / 2;
            const centerY = cardRect.height / 2;

            const angleX = (y - centerY) / 20;
            const angleY = (centerX - x) / 20;

            // Update card tilt
            card.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg) scale(1.03)`;

            // Update hover effect position
            const hoverEffect = card.querySelector('.card-hover-effect');
            hoverEffect.style.setProperty('--x', `${x}px`);
            hoverEffect.style.setProperty('--y', `${y}px`);

            // Update image parallax effect
            const img = card.querySelector('.card-img-top');
            const imgOffsetX = (centerX - x) / 20;
            const imgOffsetY = (centerY - y) / 20;
            img.style.transform = `scale(1.05) translateX(${imgOffsetX}px) translateY(${imgOffsetY}px)`;
        }

        function handleMouseLeave(card) {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale(1)';
            const img = card.querySelector('.card-img-top');
            img.style.transform = 'scale(1)';
        }

        // News section image effect
        function handleImgMove(container, event) {
            const rect = container.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const angleX = (y - centerY) / 20;
            const angleY = (centerX - x) / 20;

            // Update container tilt
            container.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg)`;

            // Update image position for parallax effect
            const img = container.querySelector('.parallax-img');
            const imgOffsetX = (centerX - x) / 20;
            const imgOffsetY = (centerY - y) / 20;
            img.style.transform = `translateX(${imgOffsetX}px) translateY(${imgOffsetY}px) translateZ(20px)`;

            // Update hover effect position
            const hoverEffect = container.querySelector('.img-hover-effect');
            hoverEffect.style.setProperty('--mouse-x', `${x}px`);
            hoverEffect.style.setProperty('--mouse-y', `${y}px`);
        }

        function handleImgLeave(container) {
            container.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
            const img = container.querySelector('.parallax-img');
            img.style.transform = 'translateZ(0)';
        }

        // Add class to animate elements when page loads
        document.addEventListener('DOMContentLoaded', function () {
            const animatedElements = document.querySelectorAll('.animate-on-load');
            animatedElements.forEach((element, index) => {
                // Apply staggered delay based on element's position
                element.style.animationDelay = `${index * 0.1 + 0.2}s`;
            });
        });
    </script>
</body>
</html>