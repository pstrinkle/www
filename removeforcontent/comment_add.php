<?php include("data/root.php"); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') { 

  $comment = $_POST['comment'];
  $page = $_POST['page'];
  $name = $_POST['name'];

  $filename = $root . 'data/comments/' . $page . '.xml';

  $newcomment = htmlspecialchars($comment);
  $newname = htmlspecialchars($name);

  if ($fp = fopen($filename, "a")) {
    fwrite($fp, "<name>$name</name><comment>$comment</comment>\n");  
    print "<p class=\"comment\">Name: $newname<br>Comment: $newcomment</p>";
	fclose($fp);
  }
  else {
    print "";
  }

}
?>