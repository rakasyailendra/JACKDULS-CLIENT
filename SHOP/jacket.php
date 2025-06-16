<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../ASSETS/head-logo.JPEG" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JACKDULS Jacket&reg;</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        /* Animasi Navigasi */
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
            background-color: rgba(0,0,0,0.05);
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

        .card-img-top {
            object-fit: cover;
            height: 300px;
            transition: transform 0.3s ease-in-out;
        }

        .card-img-top:hover {
            transform: scale(1.05);
        }

        body {
            background-color: #f8f9fa;
            padding-top: 5px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
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
        }

        @media (max-width: 768px) {
            .search-input {
                min-width: 150px;
            }
        }

        .btn-primary {
            background-color: #000;
            border-color: #000;
            width: 100%;
            font-weight: 500;
            border-radius: 4px;
            padding: 8px 0;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }

        .wishlist-icon:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.1);
        }

        .wishlist-icon i {
            color: #dc3545;
            font-size: 1.1rem;
        }

        .img-container {
            position: relative;
            overflow: hidden;
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
            transform: scale(1.1);
        }

        .wishlist-icon i {
            color: #dc3545;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav style="padding: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.6);"
        class="navbar navbar-expand-lg fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- LOGO -->
            <a style="font-weight: bold;" class="navbar-brand me-5" >JACKDULS Jacket&reg;</a>

            <!-- MENU & SEARCH & CART -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <!-- MENU -->
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

                <!-- SEARCH -->
                <form class="d-flex me-3" id="searchForm">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                        id="searchInput">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>

                <!-- CART ICON -->
                <a href="../card.php" id="cartIcon" class="cart-icon-wrapper">
    <img style="height:24px; width:24px;" src="../ASSETS/SHOPcart.png" alt="Cart">
    <span class="cart-pulse"></span>
</a> <script>document.addEventListener('DOMContentLoaded', function () {
        const cartLink = document.getElementById('cartIcon');

        if (cartLink) {
            cartLink.addEventListener('click', function (e) {
                <?php if (!isset($_SESSION['loggedin'])) { ?>
                    e.preventDefault(); // Hentikan aksi default
                    alert('Anda harus login terlebih dahulu.');
                    window.location.href = '../login.php'; // Arahkan ke halaman login
                <?php } ?>
            });
        }
    });</script>
    
            <?php if (isset($_SESSION['loggedin'])): ?>
    <a style="color:black; font-weight:bold" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="btn btn-sm btn-outline-light ms-2">Logout</a>
<?php else: ?>
    <a style="color:black; font-weight:bold" href="../login.php?redirect=SHOP/jacket.php" class="btn btn-sm btn-outline-light ms-2">Login</a>
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
            <p>Coba kata kunci lain seperti: Jacket, Hoodie, Zipper</p>
        </div>
    </div>

    <!-- KONTEN -->
    <div class="container mt-4">
        <div class="row" id="productContainer">
            <!-- Product 1 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="Jacket Arabic Jackduls white">
                <div class="card h-100">
                    <img src="../ASSETS/Jacket/jacket 1.JPEG" class="card-img-top"
                        onmouseover="this.src='../ASSETS/Jacket/jacket 1 hover.JPEG'"
                        onmouseout="this.src='../ASSETS/Jacket/jacket 1.JPEG'" alt="Jacket Arabic Jackduls white">
                    <div class="wishlist-icon" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jacket Arabic Jackduls white</h5>
                        <p style="color:red; font-weight:bold;" class="card-text">
                            <s style="color:rgb(58, 58, 58);">Rp350.000</s> Rp225.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Jacket Arabic Jackduls white"
                            data-image="../ASSETS/Jacket/jacket 1.JPEG">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="Hoodie Arabic Jackduls white">
                <div class="card h-100">
                    <img src="../ASSETS/Jacket/jacket 2.JPEG" class="card-img-top"
                        onmouseover="this.src='../ASSETS/Jacket/jacket 2 hover.JPEG'"
                        onmouseout="this.src='../ASSETS/Jacket/jacket 2.JPEG'" alt="Hoodie Arabic Jackduls white">
                    <div class="wishlist-icon" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hoodei Arabic Jackduls white</h5>
                        <p style="color:red; font-weight:bold;" class="card-text">
                            <s style="color:rgb(58, 58, 58);">Rp350.000</s> Rp225.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Hoodie Arabic Jackduls white"
                            data-image="../ASSETS/Jacket/jacket 2.JPEG">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="Hoodie Marl Jackduls White">
                <div class="card h-100">
                    <img src="../ASSETS/Jacket/jacket 3.JPEG" class="card-img-top"
                        onmouseover="this.src='../ASSETS/Jacket/jacket 3 hover.JPEG'"
                        onmouseout="this.src='../ASSETS/Jacket/jacket 3.JPEG'" alt="Hoodie Marl Jackduls White">
                    <div class="wishlist-icon" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hoodie Marl Jackduls White</h5>
                        <p style="color:red; font-weight:bold;" class="card-text">
                            <s style="color:rgb(58, 58, 58);">Rp350.000</s> Rp225.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Hoodie Marl Jackduls White"
                            data-image="../ASSETS/Jacket/jacket 3.JPEG">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="Jacket Marskar 1990`s">
                <div class="card h-100">
                    <img src="../ASSETS/Jacket/jacket 4.JPEG" class="card-img-top"
                        onmouseover="this.src='../ASSETS/Jacket/jacket 4 hover.png'"
                        onmouseout="this.src='../ASSETS/Jacket/jacket 4.JPEG'" alt="Jacket Marskar 1990`sWhite">
                    <div class="wishlist-icon" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jacket Marskar 1990`sWhite</h5>
                        <p style="color:red; font-weight:bold;" class="card-text">
                            <s style="color:rgb(58, 58, 58);">Rp350.000</s> Rp225.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Jacket Marskar 1990`sWhite"
                            data-image="../ASSETS/Jacket/jacket 4.JPEG">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="Jacket Ocean blue white">
                <div class="card h-100">
                    <img src="../ASSETS/Jacket/jacket 5.JPEG" class="card-img-top"
                        onmouseover="this.src='../ASSETS/Jacket/jacket 5 hover.png'"
                        onmouseout="this.src='../ASSETS/Jacket/jacket 5.JPEG'" alt="Jacket Ocean blue white">
                    <div class="wishlist-icon" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jacket Ocean blue white</h5>
                        <p style="color:red; font-weight:bold;" class="card-text">
                            <s style="color:rgb(58, 58, 58);">Rp350.000</s> Rp225.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Jacket Ocean blue white"
                            data-image="../ASSETS/Jacket/jacket 5.JPEG">Add To Cart</a>
                    </div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="col-md-3 mb-4 product-card" data-keywords="Jacket M&M Cookies">
                <div class="card h-100">
                    <img src="../ASSETS/Jacket/jacket 6.JPEG" class="card-img-top"
                        onmouseover="this.src='../ASSETS/Jacket/jacket 6 hover.png'"
                        onmouseout="this.src='../ASSETS/Jacket/jacket 6.JPEG'" alt="Jacket M&M Cookies">
                    <div class="wishlist-icon" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jacket M&M Cookies</h5>
                        <p style="color:red; font-weight:bold;" class="card-text">
                            <s style="color:rgb(58, 58, 58);">Rp350.000</s> Rp225.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Jacket M&M Cookies"
                            data-image="../ASSETS/Jacket/jacket 6.JPEG">Add To Cart</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4 product-card" data-keywords="Jacket Tokyo Soul black">
                <div class="card h-100">
                    <img src="../ASSETS/Jacket/jacket 7.JPEG" class="card-img-top"
                        onmouseover="this.src='../ASSETS/Jacket/jacket 7 hover.png'"
                        onmouseout="this.src='../ASSETS/Jacket/jacket 7.JPEG'" alt="Jacket Tokyo Soul black">
                    <div class="wishlist-icon" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jacket Tokyo Soul black</h5>
                        <p style="color:red; font-weight:bold;" class="card-text">
                            <s style="color:rgb(58, 58, 58);">Rp350.000</s> Rp225.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Jacket Tokyo Soul black"
                            data-image="../ASSETS/Jacket/jacket 7.JPEG">Add To Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4 product-card" data-keywords="Jacket RaskieNoMercy`s">
                <div class="card h-100">
                    <img src="../ASSETS/Jacket/jacket 8.png" class="card-img-top"
                        onmouseover="this.src='../ASSETS/Jacket/jacket 8 hover.png'"
                        onmouseout="this.src='../ASSETS/Jacket/jacket 8.png   '" alt="Jacket RaskieNoMercy`s">
                    <div class="wishlist-icon" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jacket RaskieNoMercy`s</h5>
                        <p style="color:red; font-weight:bold;" class="card-text">
                            <s style="color:rgb(58, 58, 58);">Rp350.000</s> Rp225.000
                        </p>
                        <a href="#" class="btn btn-primary add-to-cart-btn" data-title="Jacket RaskieNoMercy`s"
                            data-image="../ASSETS/Jacket/jacket 8.png">Add To Cart</a>
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
                            <li><a href="jacket.php" class="text-white text-decoration-none">Shop</a></li>
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
        document.addEventListener('DOMContentLoaded', function () {
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
                    } else {
                        product.style.display = 'none';
                    }
                });

                if (noResults) {
                    noResults.style.display = found ? 'none' : 'block';
                }
            });

            input.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    form.dispatchEvent(new Event('submit'));
                }
            });
        });
    </script>
    <script>
        const cartForm = document.getElementById('addToCartForm');
        let selectedProduct = {};

// CARD SEBELUM LOGIN

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

            alert("Berhasil ditambahkan ke keranjang!");
        });

        // Wishlist Toggle Function
        function toggleWishlist(element) {
            const icon = element.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.style.color = '#dc3545';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.style.color = '#dc3545';
            }
        }
    </script>
</body>
</html>