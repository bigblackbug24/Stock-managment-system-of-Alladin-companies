
<?php
require_once 'core.php';

if(isset ($_POST['submit'])) 
{
         $branch_id		= $_POST["branch_id"];
	  $order_date		= $_POST["order_date"];
        $total_cost		= $_POST["total_cost"];
	 $query = "INSERT INTO orders SET   
                                `branch_id`= '$branch_id',
		                `order_date`  = '$order_date',
				`total_cost`     = '$total_cost'";
				
       if(mysql_query($query) or die(mysql_error())){
           echo "<h1><center>Order has been Registered</center></h1>";
           header('location:../order.php');
       }

}
?>
