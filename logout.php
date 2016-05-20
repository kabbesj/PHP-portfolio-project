<?php 
/* This is the logout page. It destroys the session information. */

// Need the session:
session_start();

// Reset the session array:
$_SESSION = array();

// Destroy the session data on the server:
session_destroy();

// Define a page title and include the header:
define('TITLE', 'Logout');
include('templates/header.php');

?>


<p>You are now logged out.</p>


<?php include('templates/footer.html'); ?>