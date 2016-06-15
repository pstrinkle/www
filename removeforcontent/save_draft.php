<?php include("data/root.php"); ?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$title = $_POST['title'];
	$article = $_POST['article'];
	$category = $_POST['category'];
	$now = date("D M j G:i:s T Y");
	$username = $_COOKIE["user"];
	
	$foldername = md5($username);				
	$hash = md5($title . $now);
	
	$filename = $root . 'data/rfc/' . $foldername . '/' . $hash . '.xml';
	$draftfilename = $root . 'data/rfc/' . $foldername . '/' . 'draft.xml';
	
	if ($category == "") {
		$category = "pc";
	}
	
	$newtitle = htmlspecialchars($title);
	$newarticle = htmlspecialchars($article);

	$shortened = substr($newarticle,0,11999);

  	if ($fp = fopen($filename, "w")) {
   		fwrite($fp, "<user>$username</user>\n<title>$newtitle</title>\n<date>$now</date>\n<category>$category</category>\n"); 
		fwrite($fp, "<article>$shortened</article>"); 
		print "Success!";
		fclose($fp);
	}
	else {
		print "Failed to create draft";
	}
	
	if ($fp = fopen($draftfilename, "a")) {
		fwrite($fp, "<title>$newtitle</title>\n<draftid>$hash</draftid>\n");

		fclose($fp);		
	}	
}
?>