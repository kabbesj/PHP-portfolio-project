<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Upload a File</title>
</head>
<body>
<?php 
/* This script takes a file upload and stores it on the server. */
ini_set('display_errors', '0');

include('templates/header.php');
$filename = $_FILES['the_file']['name'];
$file_parts = pathinfo($filename);
$user = $_SESSION['username'];
$path1 = '/users';
$path2 = $_FILES['the_file']['name'];
//$slash = "/";
$fullpath = getcwd() . $path1 . '/' . $user . '/' . $path2;



if(!(isset($_SESSION['username']))){
    print "You must first be logged in before uploading a file.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Try to move the uploaded file:
    
         

            switch($file_parts['extension'])
            {
                case "txt":
                    break;

                case "pdf":
                    break;
            
                case "doc":
                    break;
            
                case "docx":
                    break;

                case "": // Handle file extension for files ending in '.'
                    print "Error: No file extension.";
                    exit();
                case NULL: // Handle no file extension
                    print "Error: No file extension";
                    exit();
                default:
                    print "Error: Not an acceptable file type.";
                    exit();
            }            
        
        
            
            
	if (move_uploaded_file($_FILES['the_file']['tmp_name'], $fullpath))
             {
       

		print '<p>Your file has been uploaded.</p>';
	
	}
        
              
        else { // Problem!

		print '<p style="color: red;">Your file could not be uploaded because: ';
		
		// Print a message based upon the error:
		switch ($_FILES['the_file']['error']) {
			case 1:
				print 'The file exceeds the upload_max_filesize setting in php.ini';
				break;
			case 2:
				print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form';
				break;
			case 3:
				print 'The file was only partially uploaded';
				break;
			case 4:
				print 'No file was uploaded';
				break;
			case 6:
				print 'The temporary folder does not exist.';
				break;
			default:
				print 'Something unforeseen happened.';
				break;
		}
		
		print '.</p>'; // Complete the paragraph.

	} // End of move_uploaded_file() IF.
	
} // End of submission IF.

// Leave PHP and display the form:
?>

<form action="upload_file.php" enctype="multipart/form-data" method="post">
	<p>Upload a file using this form:</p>
	<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
	<p><input type="file" name="the_file" /></p>
	<p><input type="submit" name="submit" value="Upload This File" /></p>
</form>
<?php 
    include('templates/footer.html');
?>
</body>
</html>