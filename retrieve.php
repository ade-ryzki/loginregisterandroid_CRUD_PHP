<?php

require("koneksi.php");
$perintah = "SELECT * FROM iptv";
$eksekusi = mysqli_query($konek, $perintah);
$cek = mysqli_affected_rows($konek);

if($cek > 0){
    $response["kode"] = 1;
    $response["pesan"] = "Data Terserdia";
    $response["data"] = array();

    while($ambil = mysqli_fetch_object($eksekusi)){
        $F["id"] = $ambil->id;
        $F["nama"] = $ambil->nama;
        $F["ktp"] = $ambil->ktp;
        $F["alamat"] = $ambil->alamat;
        $F["telepon"] = $ambil->telepon;

        array_push($response["data"], $F);
    }
}else{
    $response["kode"] = 0;
    $response["pesan"] = "Data Tidak Terserdia";
}

echo json_encode($response);
mysqli_close($konek);