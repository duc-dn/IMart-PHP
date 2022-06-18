<?php 
function get_detail_order()
{
    global $con;
    $sql = "with tab as (
        select order_id, sum(quantity) sl from tbl_orderdetail GROUP BY order_id
    )
    SELECT * from tab inner join 
    tbl_order on tab.order_id = tbl_order.order_id
    INNER JOIN tbl_user on tbl_order.user_id = tbl_user.user_id
    ;";

    $result = mysqli_query($con, $sql);
    $list_order = array();
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($list_order, $row);
        }
    }
    return $list_order;
}
?>