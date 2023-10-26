<?php
session_start();
include_once "config.php";
$connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
if ( !$connection ) {
    echo mysqli_error( $connection );
    throw new Exception( "Database cannot Connect" );
}
 else {
    $action = $_REQUEST['action'];
        
    if ( 'addPharmacist' == $action ) {
        $fname = $_REQUEST['fname'];
        $lname = $_REQUEST['lname'];
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $address = $_REQUEST['address'];
        $password = $_REQUEST['password'];
        $password = $_REQUEST['password'];

         $query="SELECT * FROM pharmacists WHERE  phone='". $phone ."' OR email='". $email ."' ";
         $result = mysqli_query( $connection, $query );
        // mysqli_num_rows( $result );
        if(mysqli_num_rows( $result )>0)
        {
            
            ?>
            <script type="text/javascript">
                
             alert("Data already exist");
             window.location.href = "http://localhost/Pharmacy/index1.php?id=addPharmacist";

             </script>

        <?php 
       
        exit;
        }

        else
        {
            $query = "INSERT INTO pharmacists(fname,lname,username,email,phone,address,password) VALUES ('{$fname}','$lname','$username','$email','$phone','$address','$hashPassword')";
        }

        if ( $fname && $lname && $lname && $phone && $password ) {
            $hashPassword = md5( $password);
            $query = "INSERT INTO pharmacists(fname,lname,username,email,phone,address,password) VALUES ('{$fname}','$lname','$username','$email','$phone','$address','$hashPassword')";            mysqli_query( $connection, $query );
            header( "location:index1.php?id=allPharmacist" );
        }
     }
     elseif ( 'updatePharmacist' == $action ) {
        $id = $_REQUEST['id'] ?? '';
        $fname = $_REQUEST['fname'] ?? '';
        $lname = $_REQUEST['lname'] ?? '';
        $email = $_REQUEST['email'] ?? '';
        $phone = $_REQUEST['phone'] ?? '';

        if ( $fname && $lname && $lname && $phone ) {
            $query = "UPDATE pharmacists SET fname='{$fname}', lname='{$lname}', email='$email', phone='$phone' WHERE id='{$id}'";
            mysqli_query( $connection, $query );
            header( "location:index1.php?id=allPharmacist" );
        }
    } 
     else if('addStock' == $action)  {
        $action = $_REQUEST['action'] ?? '';
            
        if ( 'addStock' == $action ) {
            $med_id  = $_REQUEST['med_id'] ?? '';
            $med_name = $_REQUEST['med_name'] ?? '';
            $med_price = $_REQUEST['med_price'] ?? '';
            $med_category = $_REQUEST['med_category'] ?? '';
            $med_quantity = $_REQUEST['med_quantity'] ?? '';
            $med_entry_date = $_REQUEST['med_entry_date'] ?? '';
            $med_manufacture_date = $_REQUEST['med_manufacture_date'] ?? '';
            $med_expiry_date = $_REQUEST['med_expiry_date'] ?? '';
            $med_description = $_REQUEST['med_description'] ?? '';
    
            if ( $med_name && $med_entry_date && $med_manufacture_date && $med_expiry_date ) {
                // $hashPassword = password_hash( $password, PASSWORD_BCRYPT );
                $query = "INSERT INTO stock_master(med_name,med_price,med_category,med_quantity,med_entry_date,med_manufacture_date,med_expiry_date,med_description) VALUES ('{$med_name}','$med_price','$med_category','$med_quantity','$med_entry_date','$med_manufacture_date','$med_expiry_date','$med_description')";
                mysqli_query( $connection, $query );
                header( "location:index1.php?id=allStock" );
            }
        }
    } else if ( 'updateStock' == $action ) {
            $med_id  = $_REQUEST['med_id'];
            $med_name = $_REQUEST['med_name'];
            $med_category = $_REQUEST['med_category'];
            $med_quantity = $_REQUEST['med_quantity'];
            // $med_entry_date = $_REQUEST['med_entry_date'] ?? '';
            // $med_manufacture_date = $_REQUEST['med_manufacture_date'] ?? '';
            // $med_expiry_date = $_REQUEST['med_expiry_date'] ?? '';
            // $med_description = $_REQUEST['med_description'] ?? '';

            if ( $med_name && $med_category && $med_quantity) {
            $query = "UPDATE stock_master SET med_name='{$med_name}', med_category='{$med_category}',med_quantity='$med_quantity', WHERE med_id='{$med_id}'";
            mysqli_query( $connection, $query );
            header( "location:index1.php?id=allStock" );
        }
    }  else if('addBill' == $action)  {
        $action = $_REQUEST['action'];
            
        if ( 'addBill' == $action ) {
            $bill_id  = $_REQUEST['bill_id'];
            $customer_name = $_REQUEST['customer_name'];
            $doctor=$_REQUEST['doctor'];
            $bill_date = $_REQUEST['bill_date'];
            $payment_type = $_REQUEST['payment_type'];
            $med_name = $_REQUEST['med_name'];
            $med_quantity = $_REQUEST['med_quantity'];
            if ( $customer_name && $doctor && $bill_date && $payment_type && $med_quantity) {
                $query = "INSERT INTO bill_master(customer_name,doctor,bill_date,payment_type,med_name,med_quantity) VALUES ('{$customer_name}','$doctor','$bill_date','$payment_type','$med_name','$med_quantity')";
                mysqli_query( $connection, $query );
                header( "location:index1.php?id=allBill" );
        }
    }
}
elseif ( 'updateProfile' == $action ) {
    $fname = $_REQUEST['fname'] ?$_REQUEST['fname'] : '';
    $lname = $_REQUEST['lname'] ?$_REQUEST['lname'] : '';
    $email = $_REQUEST['email'] ?$_REQUEST['email'] : '';
    $phone = $_REQUEST['phone'] ?$_REQUEST['phone'] : '';
    $oldPassword = $_REQUEST['oldPassword'] ?$_REQUEST['oldPassword']: '';
    $newPassword = $_REQUEST['newPassword'] ?$_REQUEST['newPassword']: '';
    $sessionId = $_SESSION['id'] ? $_SESSION['id']: '';
    $sessionRole = $_SESSION['role'] ?$_SESSION['role']: '';
    $avatar = $_FILES['avatar']['name'] ?$_FILES['avatar']['name']: "";

    if ( $fname && $lname && $email && $phone && $oldPassword && $newPassword ) {
        $query = "SELECT password,avatar FROM {$sessionRole}s WHERE id='$sessionId'";
        $result = mysqli_query( $connection, $query );

        if ( $data = mysqli_fetch_assoc( $result ) ) {
            $_password = $data['password'];
            $_avatar = $data['avatar'];
            $avatarName = '';
            if ( $_FILES['avatar']['name'] !== "" ) {
                $allowType = array(
                    'image/png',
                    'image/jpg',
                    'image/jpeg'
                );
                if ( in_array( $_FILES['avatar']['type'], $allowType ) !== false ) {
                    $avatarName = $_FILES['avatar']['name'];
                    $avatarTmpName = $_FILES['avatar']['tmp_name'];
                    move_uploaded_file( $avatarTmpName, "assets/img/$avatar" );
                } else {
                    header( "location:index1.php?id=userProfileEdit&avatarError" );
                    return;
                }
            } else {
                $avatarName = $_avatar;
            } 
                $hashPassword = md5( $newPassword );
                $updateQuery = "UPDATE {$sessionRole}s SET fname='{$fname}', lname='{$lname}', email='{$email}', phone='{$phone}', password='{$hashPassword}', avatar='{$avatarName}' WHERE id='{$sessionId}'";
                mysqli_query( $connection, $updateQuery );

                header( "location:index1.php?id=userProfile" ); 

        }

    } else {
        echo mysqli_error( $connection );
    }

}

}
