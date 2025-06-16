<?php
// File: ADMIN/api/get_stats.php (Final dengan Filter Periode)

// Baris ini untuk menampilkan error jika ada, sangat membantu untuk debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Path ini mengasumsikan folder projek Anda ada di root htdocs/www
// Contoh: C:/xampp/htdocs/NAMA_FOLDER_PROJEK/ADMIN/api/get_stats.php
require_once __DIR__ . '/../../koneksi.php';

// [BARU] Ambil parameter periode dari URL, default ke '7d' (7 hari)
$period = isset($_GET['period']) ? $_GET['period'] : '7d';

$response = [
    'stats' => [],
    'charts' => []
];

// --- [BARU] Logika Rentang Waktu berdasarkan Periode ---
$date_condition = "";
$date_column_users = "created_at"; // Kolom tanggal di tabel users
$date_column_orders = "tanggal_order"; // Kolom tanggal di tabel orders
$date_column_feedback = "Tanggal"; // Kolom tanggal di tabel data_support

switch ($period) {
    case '24h':
        $date_condition = ">= NOW() - INTERVAL 24 HOUR";
        break;
    case '30d':
        $date_condition = ">= CURDATE() - INTERVAL 29 DAY";
        break;
    case '7d':
    default:
        $date_condition = ">= CURDATE() - INTERVAL 6 DAY";
        break;
}

// --- Data untuk Kotak Statistik (Sekarang juga dinamis sesuai periode) ---
$response['stats']['total_users'] = $mysqli->query("SELECT COUNT(id) as total FROM users WHERE $date_column_users $date_condition")->fetch_assoc()['total'];
$response['stats']['total_feedback'] = $mysqli->query("SELECT COUNT(Kode) as total FROM data_support WHERE $date_column_feedback $date_condition")->fetch_assoc()['total'];
$response['stats']['new_orders'] = $mysqli->query("SELECT COUNT(order_id) as total FROM orders WHERE $date_column_orders $date_condition")->fetch_assoc()['total'];
// Unique visitors kita hitung total keseluruhan user, tidak terpengaruh periode
$response['stats']['unique_visitors'] = $mysqli->query("SELECT COUNT(id) as total FROM users")->fetch_assoc()['total'];


// --- Data untuk Diagram ---

// 1. Data untuk Diagram Tren Pendaftaran
$trend_data = [];
// Logika pengelompokan berdasarkan periode
$group_by_format = "DATE($date_column_users)"; // default untuk 7d dan 30d
$date_format_select = "DATE($date_column_users)";

if ($period == '24h') {
    $group_by_format = "HOUR($date_column_users)"; // kelompokkan per jam
    $date_format_select = "CONCAT(DATE_FORMAT($date_column_users, '%Y-%m-%d %H'), ':00:00')";
}

$query_trend = "SELECT $date_format_select as tanggal, COUNT(id) as jumlah 
                FROM users 
                WHERE $date_column_users $date_condition
                GROUP BY $group_by_format
                ORDER BY tanggal ASC";
$result_trend = $mysqli->query($query_trend);
while($row = $result_trend->fetch_assoc()) {
    $trend_data[] = [
        'x' => $row['tanggal'],
        'y' => (int)$row['jumlah']
    ];
}
$response['charts']['user_trend'] = $trend_data;


// 2. Data untuk Diagram Status Order
$query_order_status = "SELECT status, COUNT(order_id) as jumlah 
                       FROM orders 
                       WHERE $date_column_orders $date_condition
                       GROUP BY status";
$result_order_status = $mysqli->query($query_order_status);
$order_status_data = ['labels' => [], 'series' => []];
while($row = $result_order_status->fetch_assoc()) {
    $order_status_data['labels'][] = $row['status'];
    $order_status_data['series'][] = (int)$row['jumlah'];
}
$response['charts']['order_status'] = $order_status_data;


// Mengirimkan semua data sebagai satu objek JSON
header('Content-Type: application/json');
echo json_encode($response);

$mysqli->close();
?>