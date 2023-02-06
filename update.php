<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //post data 
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $ktp = $_POST["ktp"];
    $alamat = $_POST["alamat"];
    $telepon = $_POST["telepon"];

    $perintah = "UPDATE iptv SET nama ='$nama', ktp ='$ktp', alamat ='$alamat', telepon ='$telepon' WHERE id = '$id'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Berhasil Update";
        
    }else{
        $response["kode"] = 0;
        $response["pesan"] = "Data Gagal Update";-+
        
    }
}else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($konek);