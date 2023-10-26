<?php

    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "pms";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }


if (isset($_GET['term'])) {
     
   $query = "SELECT * FROM stock_master WHERE med_name LIKE '{$_GET['term']}%' LIMIT 25";
    $result = mysqli_query($conn, $query);
 
    if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      $res[] = $user['med_name'];
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
?>