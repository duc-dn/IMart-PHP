<?php
$order_id=$_GET['order_id'];
$sql="SELECT pro_image,pro_name,promotional_price,tbl_orderdetail.quantity FROM tbl_order,tbl_orderdetail,tbl_product WHERE tbl_order.order_id=tbl_orderdetail.order_id AND tbl_orderdetail.pro_id=tbl_product.pro_id AND tbl_order.order_id='$order_id'";
$sql1="SELECT order_id,tbl_user.address,tbl_order.note,tbl_order.status FROM tbl_order INNER JOIN tbl_user 
ON tbl_order.user_id=tbl_user.user_id WHERE order_id='$order_id'";
$rs=mysqli_query($con,$sql);
$rs1=mysqli_query($con,$sql1);
$r1=mysqli_fetch_array($rs1);
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?=$r1['order_id']?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?=$r1['address']?></span>
                    </li>
                    <li>
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail"><?=$r1['note']?></span>
                    </li>
                    <form method="POST" action="">
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select name="status">
                                <option value="<?=$r1['status']?>"><?=$r1['status']?></option>
                            </select>
                            <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                        </li>
                    </form>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                            <?php
                            $sum_price=0;
                            $sum_quantity=0;
                            $count=0;
                            while($r=mysqli_fetch_assoc($rs))
                            {
                                $count++;
                                $price=$r['promotional_price'];
                                $quantity=$r['quantity'];
                                $sum=$price*$quantity;
                                ?>
                            <tr>
                                <td class="thead-text"><?=$count?></td>
                                <td class="thead-text">
                                    <div class="thumb">
                                        <img src="../<?=$r['pro_image']?>" alt="">
                                    </div>
                                </td>
                                <td class="thead-text"><?=$r['pro_name']?></td>
                                <td class="thead-text"><?=$r['promotional_price']?></td>
                                <td class="thead-text"><?=$r['quantity']?></td>
                                <td class="thead-text"><?=$sum?></td>
                            </tr>
                                <?php
                                $sum_price+=$sum;
                                $sum_quantity+=$quantity;
                            }
                            ?>
                            
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?=$sum_quantity?></span>
                            <span class="total"><?=$sum_price?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>