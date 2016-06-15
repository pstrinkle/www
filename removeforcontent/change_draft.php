<?php include("data/root.php"); ?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$title = $_POST['title'];
	$article = $_POST['article'];
	$category = $_POST['category'];
	$date = $_POST['date'];
	$filehash = $_POST['filehash'];
	$username = $_COOKIE["user"];
	
	$foldername = md5($username);				
	
	$filename = $root . 'data/rfc/' . $foldername . '/' . $filehash . '.xml';
	
	$newarticle = htmlspecialchars($article);
	$newtitle = htmlspecialchars($title);
	
	$shortened = substr($newarticle,0,11999);
	
  	if ($fp = fopen($filename, "w")) {
   		fwrite($fp, "<user>$username</user>\n<title>$newtitle</title>\n<date>$now</date>\n<category>$category</category>\n"); 
		fwrite($fp, "<article>$shortened</article>"); 
		print "Success!";
		fclose($fp);
	}
	else {
		print "Failed to open";
	}	
}
?>