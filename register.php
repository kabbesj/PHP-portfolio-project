<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"/>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Register</title>
	<style type="text/css" media="screen">
		.error { color: red; }
	</style>
</head>
<body>

<?php 
/* This script registers a user. */
include('templates/header.php');
print "<h1>Register</h1>";

// Identify the directory and file to use:
$dir = getcwd() . "/users/";


if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

    $dbc = mysql_connect('localhost', 'web_user', 'webpassword');
    mysql_select_db('fanclub', $dbc);
    
    $problem = FALSE; // No problems so far.

	// Check for each value...
	if (empty($_POST['username'])) {
		$problem = TRUE;
		print '<p class="error">Please enter a username!</p>';
                exit();
	}	

	if (empty($_POST['password1'])) {
		$problem = TRUE;
		print '<p class="error">Please enter a password!</p>';
                exit();
	}

	if ($_POST['password1'] != $_POST['password2']) {
		$problem = TRUE;
		print '<p class="error">Your password did not match your confirmed password!</p>';
                exit();
	} 
	
	
        //Check for duplicate username
        $querycheck = "SELECT username FROM users WHERE username='{$_POST['username']}'";
        
        if ($r = @mysql_query($querycheck, $dbc)){
            $row = mysql_fetch_array($r); 
            $username = $_POST['username'];
                if ($row['username'] == $username){
                     print '<p class="error">Username already exists!</p>';
                     exit();
                }
                    
        }
         
                    if(!$problem){
			$username = $_POST['username'];
                        $password = md5(trim($_POST['password1']));
                        $dir .= $username;
                        mkdir ($dir);
                        
                        
			// Create the data to be written:
			$query = "INSERT INTO users (username, password, user_dir, status, admin) VALUES ('$username', '$password', '$dir', 'OPEN', 'N')";
		
		// Execute the query:
                        if (@mysql_query($query, $dbc)) {
                            print '<p>You are now registered!</p>';
                        } else {
                            print '<p style="color: red;">There was an error because: <br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
                            }

			
                    mysql_close($dbc); // Close the connection.
                }

} else { // Display the form.

// Leave PHP and display the form:
?>

<form action="register.php" method="post">
	<p>Username: <input type="text" name="username" size="20" /></p>
	<p>Password: <input type="password" name="password1" size="20" /></p>
	<p>Confirm Password: <input type="password" name="password2" size="20" /></p>
	<input type="submit" name="submit" value="Register" />
</form>

<?php 
} 

include('templates/footer.html');
?>
</body>
</html>