<?php get_component('header'); ?>
<?php 
$user = get_info_user_ordered();
$list_product = get_list_product_in_cart($_SESSION['user_id']);
$order_id=getMaDH();
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form method="POST" action="?mod=cart&act=order" name="form-checkout">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" name="fullname" id="fullname" value="<?= $user['fullname'] ?>">
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?= $user['email'] ?>">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="address" id="address" value="<?= $user['address'] ?>">
                            </div>
                            <div class="form-col fl-right">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" name="phone" id="phone" value="<?= $user['phone_num'] ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <textarea name="note"></textarea>
                            </div>
                        </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($list_product as $item){
                            ?>
                            <tr class="cart-item">
                                <td class="product-name">
                                <span style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; width: 400px"><?php echo $item['pro_name']?></span>
                                <strong class="product-quantity">x <?php echo $item['quantity']?></strong></td>
                                <td class="product-total"><?php echo currency_format($item['promotional_price']>0 ? $item['promotional_price']: $item['original_price']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php echo currency_format(get_total_cart()) ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <?php if (count($list_product) == 0) { ?>
                            <p style="color:red; font-style: italic;">Không thể đặt hàng vì giỏ hàng rỗng!!</p>
                            <a href="?mod=home&act=main">Chọn sản phẩm</a>
                        <?php } else {?>
                        <input type="submit" id="order-now" value="Đặt hàng">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php get_component('footer'); ?>