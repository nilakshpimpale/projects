<?php
$connect=mysql_connect("localhost","root","","pms");
if(isset($_POST["query"]))
{
$output='';
$query="SELECT * FROM `stock_master` WHERE `med_name` LIKE'%".$_POST["query"]."%'";
$result=mysql_query($connect,$query);
$output='<ul class="list-unstyled">';
if(mysql_num_rows($result)>0) {
    while($row=mysql_fetch_array($result))
    {
        $output .= '<li>'.$row['med_name'].'</li>';
    }
else
{
    $output.='<li> Medicine Not Found </li>';
}
$output.='</ul>';
echo $output;

}
?>

