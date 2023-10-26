<?php
$connection = mysqli_connect('localhoewst','root','weg');
if($connection === FALSE)
{
    echo  "Database cannot Connect" ;
}
else{
    echo "connection established";
}