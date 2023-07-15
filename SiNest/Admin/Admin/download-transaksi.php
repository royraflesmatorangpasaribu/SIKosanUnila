<?php
include '../SESSION-Login/koneksi.php';

// Memanggil kolom yang ada pada tabel driver_log
$query_mysql = mysqli_query($mysqli, "SELECT * FROM history_transaksi");
$delimiter = ";";

// Membuat file CSV sementara
$filename = 'Data_Transaksi_SINest.csv';
$file = fopen('php://temp', 'w');

// Menulis header kolom ke file CSV
$fields = array('ID Transaksi', 'Nama Penyewa', 'Nama Kos', 'Tanggal Masuk', 'Tanggal Keluar', 'Harga Kos');
fputcsv($file, $fields, $delimiter);

// Menulis data dari database ke file CSV
while ($result = mysqli_fetch_assoc($query_mysql)) {
    $row = array($result['id_transaksi'], $result['nama_penyewa'], $result['nama_kos'], $result['tanggal_masuk'], $result['tanggal_keluar'], $result['harga_kos']);
    fputcsv($file, $row, $delimiter);
}

// Mengarahkan output ke file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

rewind($file);
echo stream_get_contents($file);
fclose($file);
exit;
