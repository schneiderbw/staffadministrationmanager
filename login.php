<?php include_once 'config.php'; include_once 'mysql.php'; ?>
<?php
session_start();
if(isset($_POST['username'])){
$username = $_POST['username'];
}
if(isset($_POST['userpass'])){
$userpass = $_POST['userpass'];
}
if(isset($_POST['LoginFormSubmit'])){
        echo "Connecting to LDAP server: $ldap_server1 \n";
        $ldapconn = ldap_connect("$ldap_server1")
                or die ("Could not connect to LDAP server: $ldap_server1");
        if ($ldapconn) {
                echo "Connected successfully to $ldap_server1 \n";
                
                // set user's dn
                $userdn = "uid=$username,$ldap_basedn1";
                
                //feedback
                echo "Attempting to connect as $userdn \n";
                
                //set some ldap options
                ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
                
                // binding to ldap server
                $ldapbind = ldap_bind($ldapconn,$userdn,$userpass);
                
                // verify binding
                if ($ldapbind) {
                        echo "LDAP bind successful...";
                } else{
                        echo "LDAP bind to $ldap_server1 failed... \n ";
                        echo "Unsetting all generic variables.";
                        
                        // Unset generic variables
                        unset($ldapbind,$ldapconn,$userdn);
                        
                        $ldapconn = ldap_connect("$ldap_server2")
                                or die ("Could not connect to LDAP server: $ldap_server2");
                        echo "Connecting to $ldap_server2";
                        if ($ldapconn) {
                                echo "Connection to $ldap_server2 is valid \n";
                                                                
                                // set user's dn
                                $userdn = "uid=$username,$ldap_basedn2";
                                
                                echo "Attempting to connect as $userdn \n";
                                
                                //set some ldap options
                                ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
                                ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
                                
                                // binding to ldap server
                                $ldapbind = ldap_bind($ldapconn,$userdn,$userpass);
                                
                                //verify binding
                                if ($ldapbind) {
                                        $bindsuccess = "1";
                                        echo "Bound successfully to $ldap_server2";
                                } else {
                                        echo "Bind failed!";
                                        header("Location: /login.php?action=userpass");
                                        exit;
                                }
                        } else {
                                echo "A connection cannot be established to $ldap_server.";
                                header("Location: /login.php?action=noconn#noconn");
                        }
                        
                }
        } else {
                echo "A connection cannot be established to $ldap_server.";
                header("Location: /login.php?action=noconn");
        }
        $isallowed = mysqli_query($mysqli, "SELECT * FROM staff_info WHERE ldapusername = '$username' AND canLogin = '1'");
        // if the user is granted access to this resource start the session and set enough of the session variables for us to work with
        $result = mysqli_num_rows($isallowed);
        if($isallowed) {
            // start the session

            //fetch all information pertaining to the user and store it in the session key by 
            while($row = mysqli_fetch_array ( $isallowed )) {
                foreach($row as $key=>$value){
                    if(is_string($key)){
                        $_SESSION["$key"] = $value;
                        echo "<br>".$key." : ".$value." ";
                    }
                }
            }
            $uid = $_SESSION['id'];
            // get the role id number so that we can later get the permissions assigned to that role
            $getuserroleid = mysqli_query($mysqli, "SELECT `role_id` FROM `rbac_user-role` WHERE `user_id` = '$uid'");
            while($row = mysqli_fetch_array ( $getuserroleid )) {
            	foreach($row as $key=>$value){
            		if(is_string($key)){
            			$roleid = $value;
            			}
            		}
            	}
            //get the permissionid assigned to the role
            $getpermname = mysqli_query($mysqli, "SELECT `rbac_permissions`.`machine_name` FROM `titanstaff`.`rbac_role-perm` INNER JOIN `titanstaff`.`rbac_permissions` ON `rbac_role-perm`.`perm_id`=`rbac_permissions`.`taskid` WHERE `rbac_role-perm`.`role_id` = $roleid");
		while($permnamerow = mysqli_fetch_array($getpermname, MYSQLI_ASSOC)){
			$permnames[] = $permnamerow;
		}
		//sets the $permname variable as an array
		$permname = array();
		// enumerates the permissions retrieved from SQL so that they can be placed into a session variable
		foreach($permnames as $permnamearr){
			echo "<br>".$permnamearr['machine_name']." ";
			$permname[] = $permnamearr['machine_name'];
		}
		
		// Sets the session variable so that we can check and see if the current user has permission to do things on the program
		$_SESSION['permname'] = $permname;
		
		/* Test code to check if you are assigned the associated permission
		if (in_array("staff_create", $_SESSION['permname'])){
			echo "You're a district administrator!";
		} else {
			echo "you fail!";
		} */
		//print_r(mysqli_fetch_array(mysqli_query($mysqli, "SELECT machine_name FROM rbac_permissions")));
	    //$_SESSION('testsession') = "test";
            header("Location: index.php");
            exit;
        }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>SAM/IPDP Login</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
<?php
if(isset($_GET['action'])) {
if($_GET['action'] == "logout") {
        session_start();
        $logbackuser = $_SESSION['ldapusername'];
        session_destroy();
        echo "<body id=\"logout\">
        <div class=\"container\">
                <center><h1><b>You Are Logged Out</b></h1></center>
                <center><h3>You have successfully logged out of the SAM/IPDP application.  For security purposes,<br>please close this browser tab/window to complete the logout process.</h3></center><br>
                <center><h4>If you wish to log back into the application, click the \"Login\" button below.</h4></center><br>
                <center><a type=\"button\" class=\"btn btn-primary\" href=\"/login.php?action=logbackin&username=$logbackuser\">Login</a></center>
        ";
        exit;
} }
?>
          <body id="login">
            <div class="container">
        
              <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2 class="form-signin-heading">Sign in below</h2>
                <?php
                if($_GET['action'] !== "userpass"){
                    //if($_GET['action'] == "userpass"){
                        echo "Enter your computer username and password in the boxes below";
                    
                } else {
                        echo "<div class=\"alert alert-danger\"><b>Error:</b> Your username or password is not valid.<br><a data-toggle=\"modal\" href=\"#ithints\"><b>Click here for more information.</b></a></div>";                    
                }
                
                ?>
                <input type="text" name="username" class="input-block-level" placeholder="Computer Username" <?php if(isset($_GET['username'])) { $username = $_GET['username']; echo "value=\"$username\""; } ?>>
                <input type="password" name="userpass" class="input-block-level" placeholder="Password">
                <button class="btn btn-large btn-primary" type="submit" name="LoginFormSubmit">Sign in</button>
              </form>
        
            </div> <!-- /container -->
            <!-- modals -->
            <div class="modal fade" id="ithints" tabindex="-1" role="dialog" aria-labelledby="ITHints" aria-hidden="true">
                <div class="modal-diaglog">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">So, you can't access your account?</h4>
                                        </div>
                                        <div class="modal-body">
                                                <p>Based on the error message you recieved, either your <b><i>username</i></b> or your <b><i>password</i></b> is invalid.  Please
                                                make sure that you entered both your username and password are entered correctly.</p><br><p>
                                                If you aren't sure what to enter, use the username and password you use to login to the computers at school.
                                                </p><br><p>If you still aren't sure what to enter, or you can't remember your username or password, please
                                                contact your IT Department.</p>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                        </div>
                                </div>
                        </div>
                </div>
            </div>
            <div class="modal fade" id="noconn" tabindex="-1" role="dialog" aria-labelledby="NoConnection" aria-hidden="true">
                <div class="modal-diaglog">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Server Communication Error</h4>
                                        </div>
                                        <div class="modal-body">
                                                <p>We're really sorry about this, but we currently can't connect to either the authentication servers or the database server.
                                                    Please contact your IT Department and give them the following message: <blockquote><?php if (isset($it_error_msg)): ?><?php echo $it_error_msg; ?><?php endif; ?></blockquote></p>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                        </div>
                                </div>
                        </div>
                </div>
            </div>

            <script src="vendors/jquery-1.9.1.min.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>
          </body>
        </html>
