<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Admin</title>
</head>
<body>
       <?php
include('templates/header.php');
?>
<h1>Admin</h1>
<?php 
/* This script allows an admin to edit user properties and delete them from the database. */

// Connect and select:
$dbc = mysql_connect('localhost', 'web_user', 'webpassword');
mysql_select_db('fanclub', $dbc);
	
// Define the query:
$query = 'SELECT * FROM users';


///logged on
if ($_SESSION['admin'] == TRUE){
    
    //print "<h3><a href='add_quote.php'>Add quote</a></h3>";
    if ($r = mysql_query($query, $dbc)) { // Run the query.

	// Retrieve and print every record:
        print "<form action='edit.php' method='post'> <select name='username'>";
	while ($row = mysql_fetch_array($r)) {
		print "<option value='{$row['username']}'>{$row['username']}</option>";
	}
        print "</select> <input type='submit' name='Submit' value='Submit' /></form><br>";

} else { // Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.
}


///Not logged on
else{
  print "You must be an admin to view this page";   
}

	


mysql_close($dbc); // Close the connection.
include('templates/footer.html');

?>
</body>
</html>