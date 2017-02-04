<?php
require_once 'core.php';
	$q=$_GET['q'];
	$my_data=mysql_real_escape_string($q);
	
	$sql="SELECT name FROM product WHERE name LIKE '%$my_data%' ORDER BY name";
	$result = mysql_query($sql); 
	
	if($result)
	{
		while($row=mysql_fetch_array($result))
		{
			echo $row['name']."\n";
		}
	}
?>