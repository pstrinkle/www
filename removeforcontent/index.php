<?php include("data/root.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?
$area = $_GET['area'];

if ($area == "") {
	$area = "main";
}

$area2 = $area;
?>
<head>
<title>Network Stability Resource</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/main.css" charset="iso-8859-1" type="text/css">
<link rel="alternate" type="application/rss+xml" title="Network Stability Resources [10 Most Recent]" href="http://www.thensr.com/rss/rss.php">
<script language="JavaScript1.2" src="js/login.js" type="text/javascript"></script>
</head>

<body bgcolor="#666666">

<!-- body layout table -->
<table border="0" bgcolor="#333333" align="center">
<tr>
<td colspan="2" class="mainheader">Remove For Content</td>
</tr>
<tr>
<td width="170" valign="top"><br>
<!-- begin left layout cell -->
<!-- left menu table -->
<?php include("rfcsubsubmenus/left.php"); ?>
<!-- end menu table -->
<!-- end left layout cell -->
</td>
<td class="lftseperator" width="650" align="center" valign="top"><br>
        <!-- begin right layout cell -->

<br>

<div class="mainheader">recent</div>

<div class="boxitem">
<?
$filename = $root . 'data/main.xml';

if (file_exists($filename)) {

	if ($fp = fopen($filename, "r")) {
		$file = file_get_contents($filename);

		if (preg_match_all('/<title>(.*?)<\/title>\s*<img>(.*?)<\/img>\s*<short>(.*?)<\/short>\s*<date>(.*?)<\/date>\s*<link>(.*?)<\/link>/', $file, $articles)) {

			print "<table border=\"0\" bgcolor=\"#FFFFFF\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";

			$total = sizeof($articles[1]);

			$countto = 16;
			$i = 0;

			while ($countto > 0) {

				if ($countto - 2 >= 0) {
					print "<tr>\n";			
					print "<td width=\"80\" align=\"center\" valign=\"middle\"><a href=\"article.php?page=" . $articles[5][$i] . "\" class=\"norm\"><img src=\"" . $articles[2][$i] . "\" border=\"0\" alt=\"" . $articles[1][$i] . "\"></a></td>\n";
					print "<td width=\"160\" align=\"center\" valign=\"top\"><p class=\"body\"><a href=\"article.php?page=" . $articles[5][$i] . "\" class=\"norm\">" . $articles[1][$i] . "</a><br>\n" . $articles[3][$i] . "<br>\n" . $articles[4][$i] . "</p></td>\n";
					print "<td width=\"60\"></td>\n";
					$i++;
					
					print "<td width=\"80\" align=\"center\" valign=\"middle\"><a href=\"article.php?page=" . $articles[5][$i] . "\" class=\"norm\"><img src=\"" . $articles[2][$i] . "\" border=\"0\" alt=\"" . $articles[1][$i] . "\"></a></td>\n";
					print "<td width=\"160\" align=\"center\" valign=\"top\"><p class=\"body\"><a href=\"article.php?page=" . $articles[5][$i] . "\" class=\"norm\">" . $articles[1][$i] . "</a><br>\n" . $articles[3][$i] . "<br>\n" . $articles[4][$i] . "</p></td>\n";
					$countto -= 2;
					$i++;

					if ($countto != 0) {
						print "</tr><tr><td colspan=\"5\"><br></td></tr>\n";
					}
				} else if ($countto - 1 == 0) {
					print "<tr>\n";	
					print "<td width=\"80\" align=\"center\" valign=\"middle\"><a href=\"article.php?page=" . $articles[5][$i] . "\" class=\"norm\"><img src=\"" . $articles[2][$i] . "\" border=\"0\" alt=\"" . $articles[1][$i] . "\"></a></td>\n";
					print "<td width=\"160\" align=\"center\" valign=\"top\"><p class=\"body\"><a href=\"article.php?page=" . $articles[5][$i] . "\" class=\"norm\">" . $articles[1][$i] . "</a><br>\n" . $articles[3][$i] . "<br>\n" . $articles[4][$i] . "</p></td>\n";
					print "<td width=\"300\" colspan=\"3\"></td>\n";
					$countto -= 1;
					$i++;
				
					print "</tr><tr><td colspan=\"5\"><br></td></tr>\n";
				}
			}
		
			print "</table>\n";
		} else {
			print "<p>no matches found</p>\n";
		}
	
		fclose($fp);
	} else {
		print "<p>Could not open file.</p>\n";
	}
} else {
	print "<p>no matches found</p>\n";
}
?>
</div>
<br><br>


<?
$submenu = $root . 'rfcsubsubmenus/' . $area . '.htm';

if ($fp = fopen($submenu, "r")) {
	$file = file_get_contents($submenu);
	print $file;
	fclose($fp);
    } else {
    	print "<p class=\"alert\">Page doesn't exist.</p>";
}
?>
<!-- end right layout cell -->
</td>
</tr>
<tr>
<td colspan="2" class="footer">
<?php include("rfcsubsubmenus/footer.htm"); ?>
<!-- footer inside table -->
</td>
</tr>
</table>

</body>
</html>
