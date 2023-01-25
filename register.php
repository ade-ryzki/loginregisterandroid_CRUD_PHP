<?php

include 'connection.php';

if($_POST){
    //POST data
    $username = filter_input (INPUT_POST,'username', FILTER_SANITIZE_STRING);
    $password = filter_input (INPUT_POST,'password', FILTER_SANITIZE_STRING);
    $name = filter_input (INPUT_POST,'name', FILTER_SANITIZE_STRING);

    $response = [];//data response

    //check username 
    $userQuery = $connection->prepare("SELECT * FROM user where username = ?");
    $userQuery->execute(array($username));

    //check username ada atau tidak

    if($userQuery->rowCount()!=0){
        $response['status']= false;
        $response['message']= "akun sudah digunakan";
    } else {

        $insertAccount = 'INSERT INTO user (username, password, name) values (:username, :password, :name)';
        $statement =$connection->prepare($insertAccount);

        try{
            //ekseksi statement db
            $statement->execute([
                ':username' => $username,
                ':password' => md5($password),
                ':name' => $name
            ]);

            //beri response
            $response['status'] = true;
            $response['messsage']= 'akun berhsil didaftar';
            $response['data']= [
                'username' =>$username,
                'name' => $name
            ];
        } catch (Exception $e){
            die($e->getMessage());
        }
    }
    // jadikan data json
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //print
    echo $json;
}