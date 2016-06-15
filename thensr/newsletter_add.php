<?php include("data/root.php"); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') { 

  $email = $_GET['addr'];

  $filename = $root . 'data/newsletter.txt';

  if ($fp = fopen($filename, "a")) {
    fwrite($fp, "$email\r\n");  
    print "Successfully added email address: $email";
	fclose($fp);
  }
  else {
    print "Failed, try again later.";
  }

}
?>