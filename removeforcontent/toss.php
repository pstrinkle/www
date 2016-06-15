<?php include("data/root.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?
/*
$firstfile = 'd:\webs\thensr\data\rfc\users.txt';
$secondfile = 'd:\webs\thensr\data\rfc\addr.txt';

if ($fp = fopen($firstfile, "w")) {
	fwrite($fp, "patrick::" . md5("patrick") . "\n");
	fwrite($fp, "george::" . md5("george"). "\n");
	fclose($fp);
	print "added users";
}
else {
	print "failed to open user file";
}

if ($sp = fopen($secondfile, "w")) {
	fwrite($sp, "patrick::pstrink@yahoo.com\n");
	fwrite($sp, "george::george@website.com\n");
	fclose($sp);
	print "added emails";
}
else {
	print "failed to open email file";
}
*/
$foldername = $root . 'data/rfc/' . md5("patrick");
$draftfilename = $foldername . '/draft.xml';

mkdir($foldername,0666);
		
			if ($dp = fopen($draftfilename, "w")) {
				fwrite($dp, "");
				fclose($dp);
			}
			else {
				print "Failed to Create drafts.xml";
			}
	
		print "success";

print md5("patrick");

?>
</body>
</html>
