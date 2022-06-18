<?php
$id=$_GET['id'];
$sql="DELETE FROM tbl_product WHERE pro_id='$id'";
mysqli_query($con,$sql);
require("list_product.php");
?>