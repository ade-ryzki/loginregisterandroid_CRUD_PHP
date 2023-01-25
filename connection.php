<?php

$connection = null;

try{
    //config
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname ="db-login-register-android";
    
    //connection
    $database = "mysql:dbname=$dbname;host=$host"; 
    $connection = new PDO($database, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // if($connection){
    //     echo "connection berhasil";
    // } else {
    //     echo "connection gagal";
    // }

}catch (PDOException $e){
    echo "error !". $e->getMessage();
    die;
}