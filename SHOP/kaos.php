<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../ASSETS/head-logo.JPEG" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jackduls Tshirt&reg;</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Add animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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

        /* Product Card Animations */
        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: all 0.3s ease;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .img-container {
            position: relative;
            overflow: hidden;
            height: 300px;
            border-radius: 5px 5px 0 0;
        }

        .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 100%;
            transition: transform 0.5s ease-in-out;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .wishlist-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.8);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 2;
        }

        .wishlist-icon:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.2);
        }

        .wishlist-icon i {
            color: #dc3545;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: #000;
            border-color: #000;
            width: 100%;
            font-weight: 500;
            border-radius: 4px;
            padding: 8px 0;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }

        .btn-primary::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .btn-primary:hover::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 1;
            }

            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }

        body {
            background-color: #f8f9fa;
            padding-top: 5px;
        }

        .search-container {
            margin: 20px auto;
            max-width: 500px;
        }

        .search-input {
            border-radius: 20px 0 0 20px;
            border-right: none;
        }

        .search-btn {
            border-radius: 0 20px 20px 0;
            border-left: none;
        }

        .no-results {
            text-align: center;
            padding: 50px;
            display: none;
        }

        .product-match {
            border: 2px solid #ff5500;
            box-shadow: 0 0 15px rgba(255, 85, 0, 0.3);
        }

        /* Price Animation */
        .price-animation {
            transition: all 0.3s ease;
        }

        .card:hover .price-animation {
            transform: scale(1.05);
            color: #d00 !important;
        }

        /* Modal Animation */
        .modal.fade .modal-dialog {
            transform: translateY(-50px);
            transition: all 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .search-input {
                min-width: 150px;
            }
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav style="padding: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.6);"
        class="navbar navbar-expand-lg fixed-top animate-on-load">
        <div class="container d-flex align-items-center justify-content-between">
            <a style="font-weight: bold;" class="navbar-brand me-5">JACKDULS TShirt&reg;</a>
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <ul style="font-weight:bold;" class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active nav-hover-effect" href="../index.php">
                            <span class="nav-link-text">Home</span>
                            <span class="nav-hover-line"></span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle nav-hover-effect" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <span class="nav-link-text">Shop</span>
                            <span class="nav-hover-line"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-animated">
                            <li><a class="dropdown-item" href="../SHOP/kaos.php">Kaos</a></li>
                            <li><a class="dropdown-item" href="../SHOP/celana.php">Celana</a></li>
                            <li><a class="dropdown-item" href="../SHOP/topi.php">Topi</a></li>
                            <li><a class="dropdown-item" href="../SHOP/jacket.php">Jacket</a></li>
                        </ul>
                    </li>
                        <a class="nav-link active nav-hover-effect" aria-current="page" href="../support.php">
                            <span class="nav-link-text">Support</span>
                            <span class="nav-hover-line"></span>
                        </a>
                </ul>
                
                <form class="d-flex me-3" id="searchForm">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                        id="searchInput">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>

                <!-- CART ICON  -->
                <a href="<?php echo isset($_SESSION['loggedin']) ? '../shop/card.php' : '../login.php?redirect=../shop/card.php'; ?>" 
   id="cartIcon" class="cart-icon-wrapper">
    <img style="height:24px; width:24px;" src="../ASSETS/SHOPcart.png" alt="Cart">
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
    <a style="color:black; font-weight:bold" href="../login.php?redirect=SHOP/kaos.php" class="btn btn-sm btn-outline-light ms-2">Login</a>
<?php endif; ?>
                
            </div>
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
        <a href="../logout.php" class="btn btn-danger">Ya, Logout</a>
      </div>
    </div>
  </div>
</div>

    <!-- SPACER -->
    <div style="margin-top: 100px;"></div>

    <!-- No Results Message -->
    <div class="container mt-4">
        <div id="noResults" class="no-results text-center" style="display: none;">
            <h4>Produk tidak ditemukan</h4>
            <p>Coba kata kunci lain seperti: Kaos, Sweeter, T-shirt</p>
        </div>
    </div>

    <!-- KONTEN -->
    <div class="container mt-4 animate-on-load">
        <div class="row" id="productContainer">
            <!-- Product 1 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="tshirt heavenly goods hitam black jackduls">
                <div class="card h-100">
                    <div class="img-container">
                        <img src="../ASSETS/Tshirt/artikel 1.jpeg" class="card-img-top"
                            onmouseover="this.src='../ASSETS/Tshirt/artikel 1 hover.jpeg'"
                            onmouseout="this.src='../ASSETS/Tshirt/artikel 1.jpeg'" alt="Tshirt Heavenly Goods black">
                        <div class="wishlist-icon" onclick="toggleWishlist(this)">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tshirt Heavenly Goods black</h5>
                        <p style="color:red; font-weight:bold;" class="card-text price-animation">
                            <s style="color:rgb(58, 58, 58);">Rp230.000</s> Rp135.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Tshirt Heavenly Goods black"
                            data-image="../ASSETS/Tshirt/artikel 1.jpeg">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="tshirt kissing attitude putih white jackduls">
                <div class="card h-100">
                    <div class="img-container">
                        <img src="../ASSETS/Tshirt/artikel 2.jpeg" class="card-img-top"
                            onmouseover="this.src='../ASSETS/Tshirt/artikel 2 hover.png'"
                            onmouseout="this.src='../ASSETS/Tshirt/artikel 2.jpeg'" alt="Tshirt Kissing Attitude white">
                        <div class="wishlist-icon" onclick="toggleWishlist(this)">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tshirt Kissing Attitude white</h5>
                        <p style="color:red; font-weight:bold;" class="card-text price-animation">
                            <s style="color:rgb(58, 58, 58);">Rp230.000</s> Rp135.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Tshirt Kissing Attitude white"
                            data-image="../ASSETS/Tshirt/artikel 2.jpeg">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="tshirt doomsday rider putih white jackduls">
                <div class="card h-100">
                    <div class="img-container">
                        <img src="../ASSETS/Tshirt/artikel 3.jpeg" class="card-img-top"
                            onmouseover="this.src='../ASSETS/Tshirt/artikel 3 hover.png'"
                            onmouseout="this.src='../ASSETS/Tshirt/artikel 3.jpeg'" alt="Tshirt Doomsday Rider white">
                        <div class="wishlist-icon" onclick="toggleWishlist(this)">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tshirt Doomsday Rider white</h5>
                        <p style="color:red; font-weight:bold;" class="card-text price-animation">
                            <s style="color:rgb(58, 58, 58);">Rp230.000</s> Rp135.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Tshirt Doomsday Rider white"
                            data-image="../ASSETS/Tshirt/artikel 3.jpeg">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="tshirt wild soul merah red jackduls">
                <div class="card h-100">
                    <div class="img-container">
                        <img src="../ASSETS/Tshirt/artikel 4.jpeg" class="card-img-top"
                            onmouseover="this.src='../ASSETS/Tshirt/artikel 4 hover.png'"
                            onmouseout="this.src='../ASSETS/Tshirt/artikel 4.jpeg'" alt="Tshirt Wild Soul red">
                        <div class="wishlist-icon" onclick="toggleWishlist(this)">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tshirt Wild Soul red</h5>
                        <p style="color:red; font-weight:bold;" class="card-text price-animation">
                            <s style="color:rgb(58, 58, 58);">Rp230.000</s> Rp135.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Tshirt Wild Soul red"
                            data-image="../ASSETS/Tshirt/artikel 4.jpeg">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="tshirt guardian souls hitam black jackduls">
                <div class="card h-100">
                    <div class="img-container">
                        <img src="../ASSETS/Tshirt/artikel 5.jpeg" class="card-img-top"
                            onmouseover="this.src='../ASSETS/Tshirt/artikel 5 hover.png'"
                            onmouseout="this.src='../ASSETS/Tshirt/artikel 5.jpeg'" alt="Tshirt Guardian of Souls black">
                        <div class="wishlist-icon" onclick="toggleWishlist(this)">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tshirt Guardian of Souls black</h5>
                        <p style="color:red; font-weight:bold;" class="card-text price-animation">
                            <s style="color:rgb(58, 58, 58);">Rp230.000</s> Rp135.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Tshirt Guardian of Souls black"
                            data-image="../ASSETS/Tshirt/artikel 5.jpeg">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="Tshirt Bint Shaqiyyah White">
                <div class="card h-100">
                    <div class="img-container">
                        <img src="../ASSETS/Tshirt/artikel 6.jpg" class="card-img-top"
                            onmouseover="this.src='../ASSETS/Tshirt/artikel 6 hover.jpg'"
                            onmouseout="this.src='../ASSETS/Tshirt/artikel 6.jpg'" alt="Tshirt Bint Shaqiyyah White">
                        <div class="wishlist-icon" onclick="toggleWishlist(this)">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tshirt Bint Shaqiyyah White</h5>
                        <p style="color:red; font-weight:bold;" class="card-text price-animation">
                            <s style="color:rgb(58, 58, 58);">Rp230.000</s> Rp135.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Tshirt Bint Shaqiyyah White"
                            data-image="../ASSETS/Tshirt/artikel 6.jpg">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 7 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="Tshirt Radeon's SkullBlacks">
                <div class="card h-100">
                    <div class="img-container">
                        <img src="../ASSETS/Tshirt/artikel 7.jpeg" class="card-img-top"
                            onmouseover="this.src='../ASSETS/Tshirt/artikel 7 hover.png'"
                            onmouseout="this.src='../ASSETS/Tshirt/artikel 7.jpeg'" alt="Tshirt Radeon's SkullBlack">
                        <div class="wishlist-icon" onclick="toggleWishlist(this)">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tshirt Radeon's SkullBlack</h5>
                        <p style="color:red; font-weight:bold;" class="card-text price-animation">
                            <s style="color:rgb(58, 58, 58);">Rp230.000</s> Rp135.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Tshirt Radeon's SkullBlack"
                            data-image="../ASSETS/Tshirt/artikel 7.jpeg">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 8 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="Tshirt Lovesomeone Black">
                <div class="card h-100">
                    <div class="img-container">
                        <img src="../ASSETS/Tshirt/artikel 8.png" class="card-img-top"
                            onmouseover="this.src='../ASSETS/Tshirt/artikel 8 hover.png'"
                            onmouseout="this.src='../ASSETS/Tshirt/artikel 8.png'" alt="Tshirt Lovesomeone Black">
                        <div class="wishlist-icon" onclick="toggleWishlist(this)">
                            <i class="far fa-heart"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tshirt Lovesomeone Black</h5>
                        <p style="color:red; font-weight:bold;" class="card-text price-animation">
                            <s style="color:rgb(58, 58, 58);">Rp230.000</s> Rp135.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Tshirt Lovesomeone Black"
                            data-image="../ASSETS/Tshirt/artikel 8.png">Add To Cart</a>
                    </div>
                </div>
            </div>
        </div>
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
                            <li><a href="../index.php" class="text-white text-decoration-none">Home</a></li>
                            <li><a href="kaos.php" class="text-white text-decoration-none">Shop</a></li>
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

    <!-- Modal -->
    <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addToCartForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addToCartModalLabel">Add Product to Cart</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="productTitle">
                        <input type="hidden" id="productImage">
                        <div class="mb-3">
                            <label for="size" class="form-label">Size</label>
                            <select class="form-select" id="size" required>
                                <option value="">Pilih size</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Kamu" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Catatan</label>
                            <textarea class="form-control" id="note" rows="2"
                                placeholder="Catatan (opsional)"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan ke Keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add class to animate elements when page loads
        document.addEventListener('DOMContentLoaded', function () {
            const animatedElements = document.querySelectorAll('.animate-on-load');
            animatedElements.forEach((element, index) => {
                // Apply staggered delay based on element's position
                element.style.animationDelay = `${index * 0.1 + 0.2}s`;
            });

            // Initialize search functionality
            const form = document.getElementById('searchForm');
            const input = document.getElementById('searchInput');
            const products = document.querySelectorAll('.product-card');
            const noResults = document.getElementById('noResults');

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const keyword = input.value.toLowerCase().trim();
                let found = false;

                products.forEach(product => {
                    const keywords = product.getAttribute('data-keywords').toLowerCase();
                    if (keywords.includes(keyword)) {
                        product.style.display = 'block';
                        found = true;
                        // Add animation class for search results
                        product.classList.add('animate__animated', 'animate__fadeIn');
                    } else {
                        product.style.display = 'none';
                    }
                });

                if (noResults) {
                    noResults.style.display = found ? 'none' : 'block';
                    if (!found) {
                        noResults.classList.add('animate__animated', 'animate__fadeIn');
                    }
                }
            });

            input.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    form.dispatchEvent(new Event('submit'));
                }
            });

            // Add to cart functionality
            const cartForm = document.getElementById('addToCartForm');
            let selectedProduct = {};

            // Tombol Add to Cart diklik
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', function (e) {
        <?php if (!isset($_SESSION['loggedin'])) { ?>
            e.preventDefault();
            alert('Anda harus login terlebih dahulu.');
            window.location.href = '../login.php'; // Arahkan ke halaman login
        <?php } else { ?>
            e.preventDefault();
            selectedProduct.title = this.dataset.title;
            selectedProduct.image = this.dataset.image;
            new bootstrap.Modal(document.getElementById('addToCartModal')).show();
        <?php } ?>
    });
});
            // Saat form di-submit
            cartForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const size = document.getElementById('size').value;
                const name = document.getElementById('name').value;
                const note = document.getElementById('note').value;

                const newItem = {
                    title: selectedProduct.title,
                    image: selectedProduct.image,
                    size: size,
                    name: name,
                    note: note
                };

                // Simpan ke localStorage
                const existingCart = JSON.parse(localStorage.getItem('cartItems')) || [];
                existingCart.push(newItem);
                localStorage.setItem('cartItems', JSON.stringify(existingCart));

                // Tutup modal & reset form
                bootstrap.Modal.getInstance(document.getElementById('addToCartModal')).hide();
                cartForm.reset();

                // Show success animation
                const successAlert = document.createElement('div');
                successAlert.className = 'alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3 animate__animated animate__fadeInDown';
                successAlert.textContent = 'Berhasil ditambahkan ke keranjang!';
                document.body.appendChild(successAlert);

                setTimeout(() => {
                    successAlert.classList.add('animate__fadeOutUp');
                    setTimeout(() => successAlert.remove(), 500);
                }, 2000);
            });
        });

        // Wishlist Toggle Function with animation
        function toggleWishlist(element) {
            const icon = element.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.style.color = '#dc3545';
                element.classList.add('animate__animated', 'animate__heartBeat');

                // Remove animation class after animation completes
                setTimeout(() => {
                    element.classList.remove('animate__animated', 'animate__heartBeat');
                }, 1000);
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.style.color = '#dc3545';
            }
        }
    </script>
</body>

</html>