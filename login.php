<?php

include 'connection.php';

if($_POST){
    //data
    $username =$_POST['username'] ?? '';
    $password =$_POST['password'] ?? '';

    $response = [];//data response

    //check username 
    $userQuery =$connection->prepare("SELECT * from user where username = ?");
    $userQuery->execute(array($username));
    $query = $userQuery->fetch();

    if($userQuery->rowCount()==0){
        $response['status']= false;
        $response['message']= "username tidak terdaftar";
    } else {
        // ambil password
        $passwordDB = $query['password'];

        if(strcmp(md5($password),$passwordDB) === 0){
            $response['status'] = true;
            $response['message'] = "Login Berhasil";
            $response['data'] = [
                'user_id' => $query['id'],
                'username' => $query['username'],
                'name' => $query['name']
            ];
        } else {
            $response['status'] = false;
            $response['message'] = "Password anda salah";
        }
    }
    // jadikan data json
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //print
    echo $json;
}