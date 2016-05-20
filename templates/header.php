<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Green Bay Packers fan club</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/css.css" type="text/css" media="screen,projection" />
</head>
    
  
<body>
<div id="wrapper">
	
	<div id="header">	                    
                        <?php
                        session_start();
                        if(isset($_SESSION['username']) && $_SESSION['admin'] == FALSE){
                            
                            echo '
                                    <p class="description">Green Bay Packers fan club</p>
                                    <h1><a href="index.php">Go Pack Go!</a></h1>
                                    <ul id="nav">
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="quotes.php">Quotes</a></li>
                                        <li><a href="register.php">Register</a></li>
                                        <li><a href="upload_file.php">Upload</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                    ';                            
                        }
                        elseif(isset($_SESSION['username']) && $_SESSION['admin'] == TRUE){
                            echo '
                                    <p class="description">Green Bay Packers fan club</p>
                                    <h1><a href="index.php">Go Pack Go!</a></h1>
                                    <ul id="nav">
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="#">Quotes</a></li>
                                        <li><a href="register.php">Register</a></li>
                                        <li><a href="upload_file.php">Upload</a></li>
                                        <li><a href="admin.php">Admin</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                    ';   
                        }
                        else
                        {
                           echo '
                                    <p class="description">Green Bay Packers fan club</p>
                                    <h1><a href="index.php">Go Pack Go!</a></h1>
                                    <ul id="nav">
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="#">Quotes</a></li>
                                        <li><a href="register.php">Register</a></li>
                                        <li><a href="login.php">Login</a></li>
                                    </ul>
                                    ';                  
                        }
                        
                        ?>
                        
		
	</div><!-- header -->
	
	<div id="sidebar">
		<h2>Favorite Quotes</h2>
			<p class="news">It's not whether you get knocked down, it's whether you get up.<br />- <em>Vince Lombardi</em></p>
			<p class="news">The difference between a successful person and others is not a lack of strength, not a lack of knowledge, but rather a lack of will.<br />- <em>Vince Lombardi</em></p>
                        <?php 
                        date_default_timezone_set("America/Chicago");
                        echo date("h:i:sa") . " "  . date("m/d/y");
                        ?>
	</div><!-- sidebar -->

