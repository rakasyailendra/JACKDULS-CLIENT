<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dashboard Final Lengkap - Jackduls</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        /* (CSS tidak ada perubahan) */
        :root {
            --sidebar-gradient: linear-gradient(180deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            --sidebar-active-highlight:rgb(117, 93, 214);
            --card-shadow: 0 4px 15px rgba(208, 178, 178, 0.08);
            --border-color: #e9ecef;
        }
        body { background-color: #f8f9fe; font-family: 'Source Sans 3', sans-serif; }
        .app-sidebar { background: var(--sidebar-gradient) !important; }
        .nav-sidebar .nav-item .nav-link.active, .nav-sidebar .nav-item .nav-link:hover { background-color: rgba(218, 211, 225, 0.2) !important; border-left: 3px solid var(--sidebar-active-highlight); }
        .card { border: 1px solid var(--border-color); border-radius: 0.75rem; box-shadow: var(--card-shadow); margin-bottom: 1.5rem; }
        .card-header { background-color: #fff; border-bottom: 1px solid var(--border-color); font-weight: 600; }
        .small-box {
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            color: white !important;
            position: relative;
            overflow: hidden;
            height: 100%;
        }
        .small-box .inner { z-index: 10; padding: 1.25rem; }
        .small-box .inner h3 { font-weight: 700; font-size: 5.5rem; }
        .small-box .inner p { color: rgba(255, 255, 255, 0.8) !important; }
        .small-box:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15); }
        .small-box .icon {
            position: absolute;
            right: 15px;
            bottom: 15px;
            font-size: 70px;
            color: rgba(0, 0, 0, 0.15);
            transition: all 0.3s linear;
            z-index: 5;
        }
        .bg-custom-1 { background: linear-gradient(135deg, #4854e4 0%, #845ec2 100%); }
        .bg-custom-2 { background: linear-gradient(135deg, #ff6f61 0%, #ffb199 100%); }
        .bg-custom-3 { background: linear-gradient(135deg, #26a0da 0%, #3dd5f3 100%); }
        .bg-custom-4 { background: linear-gradient(135deg, #d65bca 0%, #ef749a 100%); }
        .filter-btn-group .btn { background-color: #fff; border: 2px solid #dee2e6; color: #495057; font-size: 0.85rem; padding: 0.375rem 0.75rem; }
        .filter-btn-group .btn.active { background-color: #0f2027; color: #fff; border-color: #0f2027; }
        .chart-loading-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255, 255, 255, 0.8); z-index: 10; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(2px); border-radius: 0.75rem; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .chart-loading-spinner { width: 40px; height: 40px; border: 4px solid #f0f0f0; border-top: 4px solid var(--sidebar-active-highlight); border-radius: 50%; animation: spin 1s linear infinite; }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-white shadow-sm">
            <div class="container-fluid">
                <ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list fs-4"></i></a></li></ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown"><a class="nav-link" data-bs-toggle="dropdown" href="#"><i class="bi bi-bell fs-4"></i><span class="navbar-badge badge text-bg-danger">15</span></a></li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <?php $username = "Jecky"; ?>
                            <img src="../ASSETS/profil.png" class="user-image rounded-circle shadow-sm" alt="User Image" style="width: 32px; height: 32px;">
                            <span class="d-none d-md-inline ms-2"><?= $username; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                            <li class="user-header" style="background: linear-gradient(135deg, #0f2027 0%, #2c5364 100%); color:white;"><img src="../ASSETS/profil.png" class="img-circle shadow" alt="User Image"><p><?= $username; ?><small>Web Developer</small></p></li>
                            <li class="user-footer d-flex justify-content-between p-2"><a href="#" class="btn btn-default btn-flat">Profile</a><a href="../index.php" class="btn btn-danger btn-flat">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <aside class="app-sidebar shadow" data-bs-theme="dark">
            <div class="sidebar-brand"><a href="./index.html" class="brand-link"><span class="brand-text fw-light">ADMIN JACKDULS&copy;</span></a></div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav nav-sidebar flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">MENU UTAMA</li>
                        <li class="nav-item"><a href="dashboard.php" class="nav-link active"><i class="nav-icon fa-solid fa-house-chimney"></i><p>Dashboard</p></a></li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fa-solid fa-chart-line"></i><p>Analytics</p></a></li>
                        <li class="nav-item"><a href="feedback.php" class="nav-link"><i class="nav-icon fa-solid fa-comments"></i><p>Feedback</p></a></li>
                        <li class="nav-item"><a href="datauser.php" class="nav-link"><i class="nav-icon fa-solid fa-users"></i><p>Data User</p></a></li>
                        <li class="nav-header">SISTEM</li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fa-solid fa-gears"></i><p>Pengaturan</p></a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6"><h3 class="mb-0" style="font-weight: 600;">Dashboard Utama</h3></div>
                    </div>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6"><div class="small-box bg-custom-1"><div class="inner"><h3 id="sb-orders">...</h3><p>New Orders</p></div><div class="icon"><i class="fa-solid fa-shopping-bag"></i></div></div></div>
                        <div class="col-lg-3 col-6"><div class="small-box bg-custom-2"><div class="inner"><h3 id="sb-feedback">...</h3><p>Total Feedback</p></div><div class="icon"><i class="fa-solid fa-comments"></i></div></div></div>
                        <div class="col-lg-3 col-6"><div class="small-box bg-custom-3"><div class="inner"><h3 id="sb-users">...</h3><p>User Registrations</p></div><div class="icon"><i class="fa-solid fa-user-plus"></i></div></div></div>
                        <div class="col-lg-3 col-6"><div class="small-box bg-custom-4"><div class="inner"><h3 id="sb-visitors">...</h3><p>Unique Visitors</p></div><div class="icon"><i class="fa-solid fa-users-line"></i></div></div></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-end">
                            <div class="btn-group filter-btn-group" role="group">
                                <button type="button" class="btn" data-period="24h">24 Jam</button>
                                <button type="button" class="btn active" data-period="7d">7 Hari</button>
                                <button type="button" class="btn" data-period="30d">1 Bulan</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header"><h3 class="card-title"><i class="fa-solid fa-arrow-trend-up me-2"></i>Tren Pendaftaran Pengguna</h3></div>
                                <div class="card-body position-relative"><div id="chart-trend"></div></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                             <div class="card">
                                <div class="card-header"><h3 class="card-title"><i class="fa-solid fa-chart-pie me-2"></i>Ringkasan Status Order</h3></div>
                                <div class="card-body position-relative"><div id="chart-order-status"></div></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-header"><h3 class="card-title"><i class="fa-solid fa-wallet me-2"></i>Distribusi Metode Pembayaran</h3></div>
                                <div class="card-body position-relative"><div id="chart-payment"></div></div>
                            </div>
                            <div class="card">
                                <div class="card-header"><h3 class="card-title"><i class="fa-solid fa-tshirt me-2"></i>Tren Fashion Teratas</h3></div>
                                <div class="card-body position-relative"><div id="chart-fashion-trend"></div></div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-header"><h3 class="card-title"><i class="fa-solid fa-video me-2"></i>Video Tutorial</h3></div>
                                <div class="card-body p-0">
                                    <video width="100%" controls style="border-bottom-left-radius: 0.75rem; border-bottom-right-radius: 0.75rem;">
                                        <source src="../ASSETS/videoberanda.mp4" type="video/mp4">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline"><strong>Version</strong> Final Complete</div>
            <strong>Copyright &copy; 2025 <a href="#">Admin Jackduls</a>.</strong> All rights reserved.
        </footer>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Semua Chart
        var chartTrend = new ApexCharts(document.querySelector("#chart-trend"), getChartOptions('trend'));
        var chartOrderStatus = new ApexCharts(document.querySelector("#chart-order-status"), getChartOptions('order'));
        var chartPayment = new ApexCharts(document.querySelector("#chart-payment"), getChartOptions('payment'));
        var chartFashion = new ApexCharts(document.querySelector("#chart-fashion-trend"), getChartOptions('fashion'));

        chartTrend.render();
        chartOrderStatus.render();
        chartPayment.render();
        chartFashion.render();

        async function fetchDashboardData(period = '7d') {
            const trendChartEl = document.querySelector("#chart-trend").parentElement;
            const orderChartEl = document.querySelector("#chart-order-status").parentElement;

            showLoading(trendChartEl);
            showLoading(orderChartEl);

            try {
                const response = await fetch(`api/get_stats.php?period=${period}`);
                const data = await response.json();

                hideLoading(trendChartEl);
                hideLoading(orderChartEl);

                // Update Kotak Statistik
                updateStat('sb-orders', data.stats.new_orders);
                updateStat('sb-feedback', data.stats.total_feedback);
                updateStat('sb-users', data.stats.total_users);
                updateStat('sb-visitors', data.stats.unique_visitors);

                // Update Diagram Realtime
                if (data.charts.user_trend && data.charts.user_trend.length > 0) {
                    chartTrend.updateOptions(getChartOptions('trend', period), true, true);
                    chartTrend.updateSeries([{ data: data.charts.user_trend }]);
                } else {
                    document.querySelector("#chart-trend").innerHTML = `<p class="text-center text-muted" style="padding-top: 120px;">Tidak ada data pendaftaran untuk periode ini.</p>`;
                }

                if(data.charts.order_status && data.charts.order_status.labels.length > 0){
                    chartOrderStatus.updateOptions({
                        series: data.charts.order_status.series,
                        labels: data.charts.order_status.labels
                    });
                } else {
                    document.querySelector("#chart-order-status").innerHTML = `<p class="text-center text-muted" style="padding-top: 120px;">Tidak ada data order untuk periode ini.</p>`;
                }

            } catch (error) {
                console.error('Gagal mengambil data dasbor:', error);
            }
        }

        function updateStat(id, value) {
            const element = document.getElementById(id);
            if(element) element.textContent = value;
        }

        function showLoading(element) {
            const overlay = document.createElement('div');
            overlay.className = 'chart-loading-overlay';
            overlay.innerHTML = '<div class="chart-loading-spinner"></div>';
            element.appendChild(overlay);
        }

        function hideLoading(element) {
            const overlay = element.querySelector('.chart-loading-overlay');
            if (overlay) overlay.remove();
        }

        function getChartOptions(type, period = '7d') {
            if (type === 'trend') {
                let xaxisOptions = { type: 'datetime', labels: { datetimeUTC: false, format: 'dd MMM' } };
                if (period === '24h') xaxisOptions = { type: 'datetime', labels: { datetimeUTC: false, format: 'HH:mm' } };
                return {
                    series: [{ name: 'Pendaftar', data: [] }],
                    chart: { type: 'area', height: 350, toolbar: { show: false }, zoom: { enabled: false } },
                    colors: ['#0d6efd'], dataLabels: { enabled: false }, stroke: { curve: 'smooth', width: 2 },
                    fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.1, stops: [0, 90, 100] } },
                    xaxis: xaxisOptions,
                    tooltip: { x: { format: period === '24h' ? 'HH:mm' : 'dd MMMM yy' } }
                };
            }
            if (type === 'order') {
                return {
                    series: [], chart: { type: 'donut', height: 350 },
                    labels: [], colors: ['#198754', '#ffc107', '#dc3545', '#0dcaf0'],
                    legend: { position: 'bottom' },
                    plotOptions: { pie: { donut: { size: '65%', labels: { show: true, total: { show: true, label: 'Total Orders' } } } } },
                    dataLabels: { enabled: false }
                };
            }
            if (type === 'payment') {
                return {
                    series: [{ name: 'Jumlah Transaksi', data: [400, 430, 448, 470, 540] }],
                    chart: { type: 'bar', height: 250, toolbar: { show: false } },
                    plotOptions: { bar: { borderRadius: 4, horizontal: true, distributed: true } },
                    dataLabels: { enabled: true, textAnchor: 'start', style: { colors: ['#fff'] }, formatter: function (val, opt) { return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val }, offsetX: 0 },
                    xaxis: { categories: ['Transfer Bank', 'E-Wallet', 'Kartu Kredit', 'COD', 'PayLater'], labels: { show: false } },
                    colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B'],
                    tooltip: { theme: 'dark', x: { show: false }, y: { title: { formatter: function () { return '' } } } }
                };
            }
            if (type === 'fashion') {
                return {
                    series: [{ name: 'Penjualan', data: [76, 85, 101, 98, 87, 105] }],
                    chart: { type: 'bar', height: 250, toolbar: { show: false } },
                    plotOptions: { bar: { borderRadius: 4, horizontal: false, columnWidth: '55%', distributed: true } },
                    dataLabels: { enabled: false },
                    xaxis: { categories: ['Kaos', 'Celana Kargo', 'Hoodie', 'Kemeja', 'Topi', 'Jaket'] },
                    colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#589A8D'],
                    legend: { show: false },
                    tooltip: { theme: 'light', y: { title: { formatter: () => 'Terjual' } } }
                };
            }
        }

        document.querySelectorAll('.filter-btn-group .btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelector('.filter-btn-group .btn.active').classList.remove('active');
                this.classList.add('active');
                fetchDashboardData(this.dataset.period);
            });
        });

        fetchDashboardData('7d');
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="../../dist/js/adminlte.js"></script>
</body>
</html>