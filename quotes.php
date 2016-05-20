<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>View My Blog</title>
</head>
<body>
       <?php
include('templates/header.php');
?>
<h1>Quotes</h1>
<?php 
/* This script displays all the quotes created by the user who is logged in and gives the user the option to
 * edit them, delete them or add a new quote. */

// Connect and select:
$dbc = mysql_connect('localhost', 'web_user', 'webpassword');
mysql_select_db('fanclub', $dbc);
	
// Define the query:
$query = 'SELECT * FROM quotes ORDER BY date_entered DESC';


///logged on
if (isset($_SESSION['username'])){
    
    print "<h3><a href='add_quote.php'>Add quote</a></h3>";
    if ($r = mysql_query($query, $dbc)) { // Run the query.

	// Retrieve and print every record:
	while ($row = mysql_fetch_array($r)) {
		print "<p><h3>{$row['author']}</h3>
		{$row['text']}<br />
		<a href=\"edit_entry.php?id={$row['id']}\">Edit</a>
		<a href=\"delete_entry.php?id={$row['id']}\">Delete</a>
		</p><hr />\n";
	}

} else { // Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.
}


///Not logged on
else{
     if ($r = mysql_query($query, $dbc)) { // Run the query.

	// Retrieve and print every record:
	while ($row = mysql_fetch_array($r)) {
		print "<p><h3>{$row['author']}</h3>
		{$row['text']}<br />
		</p><hr />\n";
	}

} else { // Query didn't run.
	print '<p style="color: red;">Could not retrieve the data because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
} // End of query IF.
}

	


mysql_close($dbc); // Close the connection.
include('templates/footer.html');

?>
</body>
</html>