<?php include("data/root.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?
$page = $_GET['page'];
$area = $_GET['area'];

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
</head>

<body bgcolor="#666666">

<!-- body layout table -->
<table border="0" bgcolor="#333333" align="center">
<tr>
<td colspan="2" class="mainheader">Network Stability Resource, the NSR Team
</td>
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

<table border="0" width="600" cellpadding="0" cellspacing="0">
	<tr><td border="0" class="mainheader"><? echo $page ?></td></tr><tr>
	<td>
		<table border="0" bgcolor="#FFFFFF" width="600" cellpadding="0" cellspacing="0" class="blkstriped">
			<tr><td width="10">&nbsp;</td>
			<td>

<?
$filename = $root . 'team/' . $page . '.xml';

if (file_exists($filename)) {
	if ($fp = fopen($filename, "r")) {
		$file = file_get_contents($filename);
	
		if (preg_match('/<name>(.*?)<\/name>/', $file, $matches)) {
			print "<p class=\"body\">$matches[1]";
		}
		
		if (preg_match('/<title>(.*?)<\/title>/', $file, $matches)) {
			print " ($matches[1])</p>";
		}	
		
		if (preg_match('/<img>(.*?)<\/img>/', $file, $matches)) {
			print "<img border=\"0\" src=\"$matches[1]\" alt=\"$page\">";
		}

		if (preg_match('/<body>(.*?)<\/body>/', $file, $matches)) {
			print "<p class=\"body\"><b>Bio:</b> $matches[1]</p>";
		}	
		# need to insert thing for links and articles somewhere in here
	
		if (preg_match('/<os>(.*?)<\/os>/', $file, $matches)) {
			print "<p class=\"body\"><b>OS Familiarity:</b> $matches[1]</p>";
		}
	
		fclose($fp);
	} else {
		print "<p class=\"alert\">Page doesn't exist.</p>";
	}
} else {
	print "<p class=\"alert\">Page doesn't exist.</p>";
}
?>

</td><td width="10">&nbsp;</td></tr>
		</table>
	</td>
	</tr>
</table>
<br><br>

<?
$submenu = $root . 'submenus/' . $area . '.htm';

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
