<?php get_component('header'); ?>
<?php
echo "<script>alert('Chúc mừng bạn đã đặt hàng thành công!')</script>";

$order_id = $_GET['order_id'];
$sql = "SELECT tbl_order.order_id, tbl_order.date, tbl_order.address,tbl_order.phone_num,
               tbl_order.total_price, tbl_orderdetail.quantity, tbl_product.pro_image,
               tbl_product.pro_name
        from tbl_order inner join tbl_orderdetail 
        on tbl_order.order_id = tbl_orderdetail.order_id
        inner join tbl_product on tbl_product.pro_id = tbl_orderdetail.pro_id
        WHERE tbl_order.order_id='$order_id'";

$rs = mysqli_query($con, $sql);
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Chi tiết đơn hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <h2 style="font-size: 20px;text-transform: uppercase;margin: 20px 0 15px 0">Chi tiết tin đơn hàng</h2>
            <form method="POST" action="?mod=cart&act=order" name="form-checkout" style="width: 100%;">
                <div class="section" id="order-review-wp" style="width: 100%;">
                    <div class="section-detail">
                        <table class="table info-exhibition" style="box-shadow: 0 10px 10px rgba(0,0,0,0.05)">
                            <tr>
                                <td class="thead-text">Mã ĐH</td>
                                <td class="thead-text">Sản phẩm</td>
                                <td class="thead-text">Ngày đặt</td>
                                <td class="thead-text">Địa chỉ</td>
                                <td class="thead-text">Số điện thoại</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                            <?php
               
                            while ($r = mysqli_fetch_assoc($rs)) {
                                
                            ?>
                                <tr>
                                    <td class="thead-text" style="width: 5%"><?= $r['order_id'] ?></td>
                                    <td class="thead-text" style="text-align: left; padding-left: 20px; width: 57%;">
                                        <div class="content" style="display:flex; align-items:center; justify-content: space-between;">
                                            <div class="left" style="width: 15%;">
                                                <div class="thumb">
                                                    <img src="<?= $r['pro_image'] ?>" alt="" width="50px" height="50px" style="text-align:center; object-fit: contain; width: 80%;">
                                                </div>

                                            </div>
                                            <div class="right" style="width: 85%;margin-left: 10px">
                                                <span> <?= $r['pro_name'] ?></span><br><br>
                                                <span>Số lượng: <strong><?= $r['quantity'] ?></strong></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="thead-text" style="width: 10%"><?= $r['date'] ?></td>
                                    <td class="thead-text" style="width: 10%"><?= $r['address'] ?></td>
                                    <td class="thead-text" style="width: 8%"><?= $r['phone_num'] ?></td>
                                    <td class="thead-text" style="width: 10%"><?= currency_format($r['total_price']) ?></td>
                                </tr>
                            <?php

                            }
                            ?>
                        </table>
                    </div>
                    <div class="place-order-wp clearfix">
                        <a href="?mod=cart&act=list_product">Danh sách sản phẩm đã mua</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php get_component('footer'); ?>