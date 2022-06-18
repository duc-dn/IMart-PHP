<?php
$id=$_GET['id'];
$delete_pro="DELETE FROM tbl_product WHERE cat_id='$id'";
mysqli_query($con,$delete_pro);
$sql="DELETE FROM tbl_category WHERE cat_id='$id'";
$result=mysqli_query($con,$sql);
require("list_cat.php");
?>
