<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Login</title>
</head>
<body>

<?php 

///This page allows a user who is registered to log in. To register visit register.php

include('templates/header.php');
print"<h1>Login</h1>";
///Check if user is logged in
if(isset($_SESSION['username'])){
    print "You are already logged in.";
    exit();
}



// Connect and select:
$dbc = mysql_connect('localhost', 'web_user', 'webpassword');
mysql_select_db('fanclub', $dbc);

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	$loggedin = FALSE; // Not currently logged in.
	$username = trim(strip_tags($_POST['username']));
        $password = md5(trim($_POST['password']));
        $query = "SELECT username, password, status, admin FROM users WHERE username='{$_POST['username']}'";
              
        
        
       if ($r = mysql_query($query, $dbc)) { // Run the query.
            $row = mysql_fetch_array($r);
            
               
                if ($row['username'] == $username && $row['password'] == $password){
                    $loggedin = TRUE;
                    $_SESSION['username'] = $_POST['username'];
                    
                }
                
                if($row['status'] == 'LOCKED'){
                    echo "Your account is locked";
                    exit();
                }
                
                if ($row['admin'] == 'Y'){
                    //$loggedin = TRUE;
                    $_SESSION['admin'] = TRUE;
                    
                }
                else{
                   $_SESSION['admin'] = FALSE; 
                }
            
        }
        
        
        
	// Print a message:
	if ($loggedin == TRUE) {
		print '<p>You are now logged in.</p>';
	} else {

            print '<p style="color: red;">The username and password you entered do not match those on file.</p>';	
	}
		
}
	

	

	
		
 else { // Display the form.

// Leave PHP and display the form:
?>

<form action="login.php" method="post">
	<p>Username: <input type="text" name="username" size="20" /></p>
	<p>Password: <input type="password" name="password" size="20" /></p>
	<input type="submit" name="submit" value="Login" />
</form>

<?php } // End of submission IF.
include('templates/footer.html');
mysql_close($dbc); // Close the connection.

?>

</body>
</html>
