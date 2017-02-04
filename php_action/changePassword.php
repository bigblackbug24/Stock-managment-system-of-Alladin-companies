<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$currentPassword = $_POST['password'];
	$newPassword = $_POST['npassword'];
	$conformPassword = $_POST['cpassword'];
	$userId = $_SESSION['userId'];

	$sql ="SELECT * FROM user WHERE user_id = $userId";
        
	$query = mysql_query($sql);
	$result = mysql_fetch_assoc($query);

	if($currentPassword == $result['password']) {

		if($newPassword == $conformPassword) {

			$updateSql = "UPDATE user SET password = '$newPassword' WHERE user_id = $userId";
			if(mysql_query($updateSql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Updated";		
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while updating the password";	
			}

		} else {
			$valid['success'] = false;
			$valid['messages'] = "New password does not match with Conform password";
		}

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Current password is incorrect";
	}

	

	echo json_encode($valid);

}

?>