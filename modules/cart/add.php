<?php 
// nếu đã đăng nhập

if (isset($_SESSION['user_id'])) {

    if (mysqli_num_rows($result = mysqli_query($con, "SELECT * from tbl_cart where pro_id = {$_GET['pro_id']} and user_id = {$_SESSION['user_id']}")) > 0) {
        $pro = mysqli_fetch_assoc($result);
        mysqli_query($con, "UPDATE tbl_cart SET quantity = {$pro['quantity']} + 1 WHERE pro_id = {$_GET['pro_id']}");
        
        redirect("?mod=cart");
    } 
    else { // Nếu chưa có sản phẩm
        $user_id = $_SESSION['user_id'];
        $pro_id = $_GET['pro_id'];
        $rs = mysqli_query($con, "INSERT INTO tbl_cart VALUES($user_id, $pro_id, 1)");
        
        if(!$rs){
            echo  "Thêm sản phẩm vào giỏ hàng thất bại.";
        }
        else redirect("?mod=cart");
    }
}
else redirect("?mod=account", "login");

?>