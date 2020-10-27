<?php
 require('config.php');

$errors = array();

if(isset($_POST['submit'])){
    $NAME = mysqli_real_escape_string($conn,$_POST['name']);
    $EMAIL = mysqli_real_escape_string($conn,$_POST['email']);
    $PASSWORD = mysqli_real_escape_string($conn,$_POST['password']);
    $PASSWORD2 = mysqli_real_escape_string($conn,$_POST['password2']);
    $ADDRESS = mysqli_real_escape_string($conn,$_POST['address']);

    //check for existing email
    $user_check_query = "SELECT * FROM users WHERE email = '$EMAIL' LIMIT 1";
    $results = mysqli_query($conn,$user_check_query);
    $user = mysqli_fetch_assoc($results);
    if($user){
        if($user["email"] === $EMAIL){array_push($errors,"This Email Already Exists");}
    }
    if(count($errors)==0){
        $query= "INSERT INTO users(Name,email,password,password2,address) VALUES ('$NAME','$EMAIL','$PASSWORD','$PASSWORD2','$ADDRESS')";
        mysqli_query($conn, $query);
        echo 'Registration Successful <a href="../account.php">Click here for login</a>';
    }
    else{
        echo 'ERROR : This Email Already Exists <a href="../login.php">Go Back </a>' .mysqli_error($conn);
    }
}