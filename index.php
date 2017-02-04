<?php
require_once 'php_action/db_connect.php';

session_start();

if (isset($_SESSION['userId']) && $_SESSION['action']) {
    header('location:dashboard.php');
}

$errors = array();

if ($_POST) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        if ($username == "") {
            $errors[] = "Username is required";
        }

        if ($password == "") {
            $errors[] = "Password is required";
        }
    } else {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysql_query($sql);

        if (mysql_num_rows($result) == 1) {
            $password = ($password);
            // exists
            $mainSql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
            $mainResult = mysql_query($mainSql);

            if (mysql_num_rows($mainResult) == 1) {
                $value = mysql_fetch_array($mainResult);
                $user_id = $value['user_id'];
                $action = $value['action'];
                 $username=$value['username'];
                // set session
                $_SESSION['action'] = $action;
                $_SESSION['userId'] = $user_id;
                $_SESSION['username'] = $username;
                if ($action == 'admin') {
                    header('location:dashboard.php');
                } elseif ($action == 'others') {
                    header('location:dashboard.php');
                } elseif ($action == 'gatekepar') {
                    header('location:gatepass.php');
                }
            } else {

                $errors[] = "Incorrect username/password combination";
            } // /else
        } else {
            $errors[] = "Username doesnot exists";
        } // /else
    } // /else not empty username // password
} // /if $_POST
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Stock Management System</title>

        <!-- bootstrap -->
        <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
        <!-- bootstrap theme-->
        <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
        <!-- font awesome -->
        <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

        <!-- custom css -->
        <link rel="stylesheet" href="custom/css/custom.css">
        <!-- icon	 -->
        <link rel="icon" href="assests/images/background.jpg" type="image/gif" sizes="16x16">
        <!-- jquery -->
        <script src="assests/jquery/jquery.min.js"></script>
        <!-- jquery ui -->  
        <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
        <script src="assests/jquery-ui/jquery-ui.min.js"></script>

        <!-- bootstrap js -->
        <script src="assests/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body class="full">
        <div class="container">
            <div class="row vertical">
                <div class="col-md-5 col-md-offset-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign in</h3>
                        </div>
                        <div class="panel-body">

                            <div class="messages">
<?php
if ($errors) {
    foreach ($errors as $key => $value) {
        echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									' . $value . '</div>';
    }
}
?>
                            </div>

                            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="username" class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
                                        </div>
                                    </div>	
                                    <!-- <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-2">
       <input   name="action" type="radio" value="admin">Admin
     <input   name="action" type="radio" value="others">Others
  
   
   </div></div> -->							
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <!-- panel-body -->
                    </div>
                    <!-- /panel -->
                </div>
                <!-- /col-md-4 -->
            </div>
            <!-- /row -->
        </div>
        <!-- container -->	
    </body>
</html>







