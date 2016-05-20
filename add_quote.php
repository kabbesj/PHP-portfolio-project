<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Add a Quote</title>
</head>
<body>
<?php
include('templates/header.php');
?>
<h1>Add a quote</h1>
<?php 
/* This script adds quotes to the database. */


///Check if user is logged in
if(!isset($_SESSION['username'])){
    print "You must be logged in to view this page.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Connect and select:
	$dbc = mysql_connect('localhost', 'web_user', 'webpassword');
	mysql_select_db('fanclub', $dbc);
        $favorite= 'n';
	
	// Validate the form data:
	$problem = FALSE;
	if (!empty($_POST['author']) && !empty($_POST['text'])) {
		$title = trim(strip_tags($_POST['author']));
		$entry = trim(strip_tags($_POST['text']));
	} 
        else {
		print '<p style="color: red;">Please submit both a title and an entry.</p>';
		$problem = TRUE;
	}
        
        if(isset($_POST['favorite'])){
            $favorite = 'y';
        }

	if (!$problem) {

		// Define the query:
		$query = "INSERT INTO quotes (text, author, favorite, date_entered) VALUES ('$title', '$entry', '$favorite', UTC_TIMESTAMP())";
		
		// Execute the query:
		if (@mysql_query($query, $dbc)) {
			print '<p>The blog entry has been added!</p>';
		} else {
			print '<p style="color: red;">Could not add the entry because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
		}
	
	} // No problem!

	mysql_close($dbc); // Close the connection.
	
} // End of form submission IF.

else{
// Display the form:
?>
<form action="add_quote.php" method="post">
	<p>Author: <input type="text" name="author" size="40" maxsize="100" /></p>
	<p>Quote Text: <textarea name="text" cols="40" rows="5"></textarea></p>
        <p>Favorite? <input type="checkbox" name="favorite" value="1" /></p>
	<input type="submit" name="submit" value="Post This Entry!" />
</form>

<?php
}
include('templates/footer.html');
?>
</body>
</html>