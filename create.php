<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //post data 
    $nama = $_POST["nama"];
    $ktp = $_POST["ktp"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];

    $perintah = "INSERT INTO iptv (nama, ktp, alamat, telepon) VALUES('$nama','$ktp','$alamat','$telepon')";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Post Data Berhasil";
    }else{
        $response["kode"] = 0;
        $response["pesan"] = "Post Data Gagal";
    }
}else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($konek);