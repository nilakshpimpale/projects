<?php 
require('vendor/autoload.php');
$customername= $_GET['name'];
$medicinename= $_GET['medicine'];
$doctor=$_GET['doctor'];
$billdate= $_GET['date'];
$payment_type= $_GET['payment_type'];
$quantity= $_GET['quantity'];





$html='<style>table, th, td {
	border: 1px solid black;
  }</style><table style="width: 100%;">';
$html.='<tr><td>Date</td><td>Name</td><td>Medicine</td><td>Doctor</td><td>Quantity</td><td>Payment</td></tr>';

 $html.='<tr><td>'.$billdate.'</td><td>'.$customername.'</td><td>'.$medicinename.'</td><td>'.$doctor.'</td><td>'.$quantity.'</td><td>'.$payment_type.'</td></tr>';   

 $html.='</table>';




      
$pdf=new \Mpdf\Mpdf();
$pdf->WriteHTML($html);
$file=time().'.pdf';
$pdf->output($file,'D'); 
?>







