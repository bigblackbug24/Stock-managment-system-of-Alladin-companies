 <?php
 $id = $_REQUEST['id'];
 $sql = $display;
                                $select = "select qntty from stock where product_id = '$sql'";

                                $result = mysql_query($select);
                                $result1 = mysql_fetch_array($result);
                                echo $result1['qntty'];

 ?>