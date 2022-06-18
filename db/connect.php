<?php 
$con = mysqli_connect('localhost', 'root', '', 'IMart');

if (!$con) {
    echo "Kết nối không thành công ".mysqli_connect_error();
    die();
}

?>