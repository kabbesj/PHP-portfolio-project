<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Edit a Quote</title>
</head>
<body>

<?php
/* This script edits a quote. */
include('templates/header.php');

print "<h1>Edit an Entry</h1>";
// Connect and select:
$dbc = mysql_connect('localhost', 'web_user', 'webpassword');
mysql_select_db('fanclub', $dbc);

if (isset($_GET['id']) && is_numeric($_GET['id']) ) { // Display the entry in a form:

	// Define the query.
	$query = "SELECT author, text, favorite FROM quotes WHERE id={$_GET['id']}";
	if ($r = mysql_query($query, $dbc)) { // Run the query.
	
		$row = mysql_fetch_array($r); // Retrieve the information.
		
		// Make the form:
		print '<form action="edit_entry.php" method="post">
	<p>Entry Title: <input type="text" name="author" size="40" maxsize="100" value="' . htmlentities($row['author']) . '" /></p>
	<p>Entry Text: <textarea name="text" cols="40" rows="5">' . htmlentities($row['text']) . '</textarea></p>';
                       if($row['favorite'] == 'y'){
                           print '<p>Favorite: <input type="checkbox" value="n"  name="favorite" checked> </p>';
                       }
                       else{
                           print '<p>Favorite: <input type="checkbox" value="y"  name="favorite"> </p>';
                       }
        print '<input type="hidden" name="id" value="' . $_GET['id'] . '" />        
	<input type="submit" name="submit" value="Update this Entry!" />
	</form>';

	} else { // Couldn't get the information.
		print '<p style="color: red;">Could not retrieve the blog entry because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
	}

} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) { // Handle the form.

	// Validate and secure the form data:
	$problem = FALSE;
	if (!empty($_POST['author']) && !empty($_POST['text'])) {
		$title = mysql_real_escape_string(trim(strip_tags($_POST['author'])), $dbc);
		$entry = mysql_real_escape_string(trim(strip_tags($_POST['text'])), $dbc);
                //$favorite = mysql_real_escape_string(trim(strip_tags($_POST['favorite'])), $dbc);
	} else {
		print '<p style="color: red;">Please submit both a title and an entry.</p>';
		$problem = TRUE;
	}
        if(!empty($_POST['favorite'])){
            $favorite = mysql_real_escape_string(trim(strip_tags('y')), $dbc);
        }
        else{
            $favorite = mysql_real_escape_string(trim(strip_tags('n')), $dbc);
        }

	if (!$problem) {

		// Define the query.
		$query = "UPDATE quotes SET author='$title', text='$entry', favorite='$favorite' WHERE id={$_POST['id']}";
		$r = mysql_query($query, $dbc); // Execute the query.
		
		// Report on the result:
		if (mysql_affected_rows($dbc) == 1) {
			print '<p>The blog entry has been updated.</p>';
		} else {
			print '<p style="color: red;">Could not update the entry because:<br />' . mysql_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
		}
		
	} // No problem!

} else { // No ID set.
	print '<p style="color: red;">This page has been accessed in error.</p>';
} // End of main IF.

mysql_close($dbc); // Close the connection.
include('templates/footer.html');
?>
</body>
</html>