<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="/ASSETS/head-logo.jpeg" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JACKDULS Card&reg;</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
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
</style>

<body>

    <body>
        <!-- NAVBAR -->
        <nav style="padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.6);"
            class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                
<a style="font-weight: bold; cursor: pointer; margin-left: 20px; justify-content: center; align-items: center; display: flex;" 
   class="navbar-brand" 
   onclick="window.history.back()">
  <img style="height: 20px; margin-right:5px;" src="ASSETS\iconback.png" alt="">Kembali
</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <!-- MENU -->
                    <ul style="font-weight:bold;" class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="shop.php" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Shop
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="SHOP/kaos.php">Kaos</a></li>
                                <li><a class="dropdown-item" href="SHOP/celana.php">Celana</a></li>
                                <li><a class="dropdown-item" href="SHOP/topi.php">Topi</a></li>
                                <li><a class="dropdown-item" href="SHOP/jacket.php">Jacket</a></li>
                            </ul>
                        </li>
                        <a class="nav-link active nav-hover-effect" aria-current="page" href="support.php">
                            <span class="nav-link-text">Support</span>
                            <span class="nav-hover-line"></span>
                        </a>
                    </ul>
                </div>
                <a href="#">
                    <img style="height:28px; width:28px;" src="ASSETS/shopcart.png" alt="">
                </a>
            </div>
        </nav>
        <div id="cartContainer" class="container mt-4"></div>


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

        <!-- JAVASCRIPT -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
        <script>
            const container = document.getElementById('cartContainer');
            let items = JSON.parse(localStorage.getItem('cartItems')) || [];

            function renderCart() {
                container.innerHTML = "";

                if (items.length === 0) {
                    container.innerHTML = `<p style="text-align: center; font-weight:bold; margin:10px;">Keranjang kosong.</p>`;

                } else {
                    items.forEach((item, index) => {
                        container.innerHTML += `
                            <div class="card mb-3" style="max-width: 540px; margin:20px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="${item.image}" class="img-fluid rounded-start" alt="${item.title}">
                                    </div>
                                    <div  class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">${item.title}</h5>
                                            <p class="card-text"><strong>Size:</strong> ${item.size}</p>
                                            <p class="card-text"><strong>Nama:</strong> ${item.name}</p>
                                            <p class="card-text"><strong>Catatan:</strong> ${item.note}</p>
                                            <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });
                }
            }

            function removeItem(index) {
                items.splice(index, 1); // hapus item berdasarkan index
                localStorage.setItem('cartItems', JSON.stringify(items)); // update localStorage
                renderCart(); // re-render cart
            }

            // pertama kali render
            renderCart();
        </script>
        <script>
            const cartForm = document.getElementById('addToCartForm');
            let selectedProduct = {};

            // Tombol Add to Cart diklik
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    selectedProduct.title = this.dataset.title;
                    selectedProduct.image = this.dataset.image;
                    new bootstrap.Modal(document.getElementById('addToCartModal')).show();
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
        </script>
    </body>

</html>