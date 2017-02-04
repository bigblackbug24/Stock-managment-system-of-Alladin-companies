
<?php

require_once 'core.php';

if (isset($_POST['submit'])) {
    $branch_id = $_POST["branch_id"];
       $order_date = $_POST["order_date"];
    $order_id = $_POST["order_id"];
     $order_query = "INSERT INTO orders SET   
                                `branch_id`      =   '$branch_id',
		                            `order_date`    =   '$order_date'";
    
    mysql_query($order_query);
    $total = $_POST['total_order'];
     for ($i = 0; $i <= $total; $i++) {
 
    $product_id = $_POST["prod_name_" . $i];
    $quantity = $_POST["qty_" .$i];
    $price = $_POST["price_" . $i];
    $total_cost = $_POST["total_cost_" . $i];

   
    $q = "SELECT * FROM orders ORDER BY order_id DESC LIMIT 1;";
     $result_q = mysql_query($q);
    $data = mysql_fetch_array($result_q);
     
    $order_get_id = $data['order_id'];
    $query = "INSERT INTO order_detail SET   
                    `order_id`      =   '$order_get_id',
		                `product_id`    =   '$product_id',
                    `quantity`      =   '$quantity',
		                `price`         =    '$price',
				            `total_cost`    =    '$total_cost'";

    
    mysql_query($query);
    
     $select_stock = "SELECT qntty FROM stock WHERE product_id = '$product_id'";
    $sql = mysql_query($select_stock);
    $sqli = mysql_fetch_array($sql);

    $remaining_gntty = $sqli['qntty'] - $quantity;

    $update = "UPDATE stock SET
                    `qntty`      =   '$remaining_gntty'
                     WHERE product_id = '$product_id'";
    mysql_query($update);
     }

    /*$select_stock = "SELECT qntty FROM stock WHERE product_id = '$product_id'";
    $sql = mysql_query($select_stock);
    $sqli = mysql_fetch_array($sql);

    $remaining_gntty = $sqli['qntty'] - $quantity;

    $update = "UPDATE stock SET
                    `qntty`      =   '$remaining_gntty'
                     WHERE product_id = '$product_id'";
    mysql_query($update);*/
    header("location:../order_details.php");
}
else{
    header("location:../order_details.php");
}
?>