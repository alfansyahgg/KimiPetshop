<?php 

include('connect.php');

session_start();

$no_order = $_GET['no'];


$query = "select * from tbl_testimoni where no_order = $no_order ";
$result = mysqli_query($conn,$query);

$arr = [];
while($row = mysqli_fetch_assoc($result)){
	$arr[] = $row;
} 

echo json_encode($arr);


?>