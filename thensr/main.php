<?php include("data/root.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?
$page = $_GET['page'];

switch($page)
{
	case "pc":
		$area2 = "pc";
		break;
	case "tech":
		$area2 = "tech";
		break;
	case "linux":
		$area2 = "linux";
		break;
	case "gamer":
		$area2 = "gamer";
		break;
	case "activities":
		$area2 = "team";
		break;
	default:
		$area2 = $area;
		break;
}
?>
<head>
<title>Network Stability Resource, <? echo $page ?> at the NSR</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/main.css" charset="iso-8859-1" type="text/css">
<link rel="alternate" type="application/rss+xml" title="Network Stability Resources [10 Most Recent]" href="http://www.thensr.com/rss/rss.php">
<script language="JavaScript1.2" src="js/newsletter.js" type="text/javascript"></script>
</head>

<body bgcolor="#666666">

<!-- body layout table -->
<table border="0" bgcolor="#333333" align="center">
<tr>
<td colspan="2" class="mainheader">Network Stability Resource</td>
</tr>
<tr>
<td width="170" valign="top"><br>
<!-- begin left layout cell -->
<!-- left menu table -->
<?php include("submenus/left.php"); ?>
<!-- end menu table -->
<!-- end left layout cell -->
</td>
    <td class="lftseperator" width="650" align="center" valign="top"><br>
        <!-- begin right layout cell -->

<div class="mainheader"><? echo $page ?></div>

<div class="boxitem">
<?
$filename = $root . 'data/main.xml';

if ($fp = fopen($filename, "r")) {

	$file = file_get_contents($filename);
	$cnt = 0;
	$here;
	
	if (preg_match_all('/<title>(.*?)<\/title>\s*<img>(.*?)<\/img>\s*<short>(.*?)<\/short>\s*<date>(.*?)<\/date>\s*<link>(.*?)<\/link>\s*<area>(.*?)<\/area>/', $file, $articles)) {

		$total = sizeof($articles[1]);

		for ($i = 0; $i < $total; $i++) {

			if ($articles[6][$i] == $page) {

				$here[$cnt]['title'] = $articles[1][$i];
				$here[$cnt]['img'] = $articles[2][$i];
				$here[$cnt]['short'] = $articles[3][$i];
				$here[$cnt]['date'] = $articles[4][$i];
				$here[$cnt]['link'] = $articles[5][$i];

				$cnt++;
			}
		}
	}
	else {
		print "<p>No matches</p>\n";
	}

	fclose($fp);

	print "<table border=\"0\" bgcolor=\"#FFFFFF\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	
	$i = 0;
	
	while ($cnt > 0) {
		if ($cnt - 2 >= 0) {
			print "<tr>\n";			
			print "<td width=\"80\" align=\"center\" valign=\"middle\"><a href=\"article.php?page=" . $here[$i]['link'] . "\" class=\"norm\"><img src=\"" . $here[$i]['img'] . "\" border=\"0\" alt=\"" . $here[$i]['title']  . "\"></a></td>\n";
			print "<td width=\"160\" align=\"center\" valign=\"top\"><p class=\"body\"><a href=\"article.php?page=" . $here[$i]['link'] . "\" class=\"norm\">" . $here[$i]['title'] . "</a><br>\n" . $here[$i]['short'] . "<br>\n" . $here[$i]['date'] . "</p></td>\n";
			print "<td width=\"60\"></td>\n";
			$i++;
			print "<td width=\"80\" align=\"center\" valign=\"middle\"><a href=\"article.php?page=" . $here[$i]['link'] . "\" class=\"norm\"><img src=\"" . $here[$i]['img'] . "\" border=\"0\" alt=\"" . $here[$i]['title'] . "\"></a></td>\n";
			print "<td width=\"160\" align=\"center\" valign=\"top\"><p class=\"body\"><a href=\"article.php?page=" . $here[$i]['link'] . "\" class=\"norm\">" . $here[$i]['title'] . "</a><br>\n" . $here[$i]['short'] . "<br>\n" . $here[$i]['date'] . "</p></td>\n";
			$cnt -= 2;
			$i++;

			if ($cnt != 0) {
				print "</tr><tr><td colspan=\"5\"><br></td></tr>\n";
			}
		}
		else if ($cnt - 1 == 0) {
			print "<tr>\n";	
			print "<td width=\"80\" align=\"center\" valign=\"middle\"><a href=\"article.php?page=" . $here[$i]['link'] . "\" class=\"norm\"><img src=\"" . $here[$i]['img'] . "\" border=\"0\" alt=\"" . $here[$i]['title'] . "\"></a></td>\n";
			print "<td width=\"160\" align=\"center\" valign=\"top\"><p class=\"body\"><a href=\"article.php?page=" . $here[$i]['link'] . "\" class=\"norm\">" . $here[$i]['title'] . "</a><br>\n" . $here[$i]['short'] . "<br>\n" . $here[$i]['date'] . "</p></td>\n";
			print "<td width=\"250\" colspan=\"3\"></td>\n";
			$cnt -= 1;
			$i++;
			print "</tr><tr><td colspan=\"5\"><br></td></tr>\n";
		}			
	}

	print "</table>\n";
}
else {
	print "<p>Failed to open file.</p>\n";
}
?>
</div>

<br><br>

<?
$submenu = $root . 'submenus/main.htm';

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
<?php include("submenus/footer.htm"); ?>
<!-- footer inside table -->
</td>
</tr>
</table>

</body>
</html>
