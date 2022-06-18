<?php get_component('header'); ?>
<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT pro_image,pro_name,promotional_price,tbl_orderdetail.quantity 
        FROM tbl_order,tbl_orderdetail,tbl_product WHERE tbl_order.order_id=tbl_orderdetail.order_id AND 
        tbl_orderdetail.pro_id=tbl_product.pro_id AND tbl_order.user_id='$user_id'";


$rs = mysqli_query($con, $sql);
$r1 = mysqli_fetch_array($rs);
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
                        <a href="" title="">Sản phẩm đã mua</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <h2 style="font-size: 20px;text-transform: uppercase;margin: 20px 0 15px 0">Sản phẩm đã mua</h2>
            <form method="POST" action="?mod=cart&act=order" name="form-checkout" style="width: 100%; height: 800px; overflow-y: scroll;">
                <div class="section" id="order-review-wp" style="width: 100%;">
                    <div class="section-detail">
                        <table class="table info-exhibition" style="box-shadow: 0 10px 10px rgba(0,0,0,0.05)">
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                            <?php
                            $sum_price = 0;
                            $sum_quantity = 0;
                            $count = 0;
                            while ($r = mysqli_fetch_assoc($rs)) {
                                $count++;
                                $price = $r['promotional_price'];
                                $quantity = $r['quantity'];
                                $sum = $price * $quantity;
                            ?>
                                <tr>
                                    <td class="thead-text"><?= $count ?></td>
                                    <td class="thead-text">
                                        <div class="thumb">
                                            <img src="<?= $r['pro_image'] ?>" alt="" width="50px" height="50px">
                                        </div>
                                    </td>
                                    <td class="thead-text"><?= $r['pro_name'] ?></td>
                                    <td class="thead-text"><?= currency_format($r['promotional_price']) ?></td>
                                    <td class="thead-text"><?= $r['quantity'] ?></td>
                                    <td class="thead-text"><?= currency_format($sum) ?></td>
                                </tr>
                            <?php
                                $sum_price += $sum;
                                $sum_quantity += $quantity;
                            }
                            ?>
                            <tr>
                                <td colspan="4">Tổng đơn hàng:</td>
                                <td><?= $sum_quantity ?></td>
                                <td><?= currency_format($sum_price); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="place-order-wp clearfix">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php get_component('footer'); ?>