<?php

session_start();

include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}
$action = $_REQUEST['action'];

if ( 'login' == $action ) {
    $username = $_REQUEST['username'];
    $password = md5($_REQUEST['password']);
    $role = $_REQUEST['role'];

    if ( $username && $password && $role ) {
        $query = "SELECT * FROM {$role} WHERE username='{$username}' AND password='{$password}'";
        //echo $query;
        $result = mysqli_query( $connection, $query );

        if ( $data = mysqli_fetch_assoc( $result ) ) {
            
            $_passsword = $data['password'];
            $_username = $data['username'];
            $_id = $data['id'];
            $_role = $data['role'];

            if ($password == $_passsword) {
                $_SESSION['role'] = $_role;
                $_SESSION['id'] = $_id;
                header("location:index1.php" );
                die();
            }
        } else {
            header("location:login.php?error" );
        }

    }
}

















