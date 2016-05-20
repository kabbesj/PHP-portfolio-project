<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Create the Database</title>
</head>
<body>
<?php 
/* This script demonstrates how to create a database and table. This script is not executed on the site
and is here for demonstration purposes only. */

// Attempt to connect to MySQL and print out messages:
if ($dbc = @mysql_connect('localhost', 'web_user', 'webpassword')) {
	
	print '<p>Successfully connected to MySQL!</p>';
	
	// Try to create the database:
	if (@mysql_query('CREATE DATABASE fanclub', $dbc)) {
		print '<p>The database has been created!</p>';
	} else { // Could not create it.
		print '<p style="color: red;">Could not create the database because:<br />' . mysql_error($dbc) . '.</p>';
	}
	
	// Try to select the database:
	if (@mysql_select_db('fanclub', $dbc)) {
		print '<p>The database has been selected!</p>';
	} else {
		print '<p style="color: red;">Could not select the database because:<br />' . mysql_error($dbc) . '.</p>';
	}
	
	//mysql_close($dbc); // Close the connection.

} else {

	print '<p style="color: red;">Could not connect to MySQL:<br />' . mysql_error() . '.</p>';

}

///Create table users:

if ($dbc) {

	// Define the query:
	$query = 'CREATE TABLE users (
username VARCHAR(100),
password VARCHAR(100),
user_dir VARCHAR(100),
status VARCHAR(100),
admin CHAR(1)
)';
        
	
	// Execute the query:
	if (@mysql_query($query, $dbc)) {
		print '<p>The table users has been created!</p>';
	} else {
		print '<p style="color: red;">Could not create the table because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	}
        
      	
	mysql_close($dbc); // Close the connection.

}

?>
</body>
</html>