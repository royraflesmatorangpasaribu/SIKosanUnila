<?php
include '../SESSION-Login/session-cek.php';
// mengambil data dari form
$id_kos  = $_POST['idKosin'];
$nama_kos = $_POST['namaKosin'];
$status_kos = $_POST['statuskosin'];
$tipe_kos = $_POST['tipekosin'];
$fasilitas_kos = $_POST['fasilitasin'];
$lokasi_kos = $_POST['lokasiin'];
$kapasitas_kos = $_POST['kapasitasin'];
$harga_kos  = $_POST['hargain'];


// memeriksa apakah file foto diunggah
if (isset($_FILES["fotoin"]) && $_FILES["fotoin"]["error"] == 0) {
    $foto = $_FILES["fotoin"]["name"];

    // menyimpan/menambah data ke database
    $sql = "INSERT INTO riwayat_kos(id_kos, nama_kos, status_kos, tipe_kos, fasilitas_kos, lokasi_kos, kapasitas_kos, harga_kos, foto) VALUES ('$id_kos', '$nama_kos', '$status_kos', '$tipe_kos', '$fasilitas_kos','$lokasi_kos','$kapasitas_kos','$harga_kos', '$foto')";

    if (mysqli_query($mysqli, $sql)) {
        $driver_id = mysqli_insert_id($mysqli); // Mendapatkan ID driver yang baru ditambahkan

        // Memindahkan file foto ke folder uploadimg
        $target_dir = "uploadimg/";
        $target_file = $target_dir . basename($_FILES["fotoin"]["name"]);
        move_uploaded_file($_FILES["fotoin"]["tmp_name"], $target_file);

        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    }
} else {
    echo "Error: Foto tidak diunggah.";
}

// memeriksa apakah file foto diunggah
if (isset($_FILES["gambar"]) && count($_FILES["gambar"]["tmp_name"]) > 0) {
    $gambarFiles = $_FILES["gambar"];
    $gambarCount = count($gambarFiles["tmp_name"]);

    // Memindahkan file foto ke folder uploadimg
    $targetDir = "uploadimg/";

    for ($i = 0; $i < $gambarCount; $i++) {
        $gambarFile = $gambarFiles["name"][$i];
        $gambarTmpName = $gambarFiles["tmp_name"][$i];
        $targetFile = $targetDir . basename($gambarFile);

        // Pindahkan file gambar ke folder uploadimg
        move_uploaded_file($gambarTmpName, $targetFile);

        // Simpan detail gambar ke dalam tabel foto_fasilitas
        $sql = "INSERT INTO foto_fasilitas (id_kos, foto) VALUES ('$id_kos', '$gambarFile')";

        if (mysqli_query($mysqli, $sql)) {
            echo "Data berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        }
    }
} else {
    echo "Error: Foto tidak diunggah.";
}


header('Location: riwayat-kos.php');
exit();
