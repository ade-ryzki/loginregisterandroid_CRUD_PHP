<?php
require("koneksi.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //post data 
    $id = $_POST["id"];

    $perintah = "SELECT * FROM iptv WHERE id = '$id'";
    $eksekusi = mysqli_query($konek, $perintah);
    $cek = mysqli_affected_rows($konek);

    if($cek > 0){
        $response["kode"] = 1;
        $response["pesan"] = "Data Tersedia";
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
        $response["pesan"] = "Data Tidak Tersedia";
    }
}else{
    $response["kode"] = 0;
    $response["pesan"] = "Tidak Ada Post Data";
}

echo json_encode($response);
mysqli_close($konek);