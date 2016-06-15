<?
print "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>\n";
print "<rss version=\"2.0\">\n";
print "<channel>\n";
print "<title>Network Stability Resource</title>\n";
print "<link>http://www.thensr.com</link>\n";
print "<description>All About Everything Cool and Modern with Technology</description>\n";
print "<language>en-us</language>\n";
print "<copyright>Copyright � 2007 Network Stability Resource, All Rights Reserved</copyright>\n";
print "<pubDate>" . date("r") . "</pubDate>\n";
print "<image>\n";
print "<url>http://www.thensr.com/rss/nsr_small.jpg</url>\n";
print "<height>130</height>\n";
print "<width>51</width>\n";
print "<link>http://www.thensr.com</link>\n";
print "<title>Network Stability Resource</title>\n";
print "</image>\n";

$filename = '/home/content/p/s/t/pstrink2/html/data/main.xml';

if ($fp = fopen($filename, "r")) {
	$file = file_get_contents($filename);

	if (preg_match_all('/<title>(.*?)<\/title>\s*<img>(.*?)<\/img>\s*<short>(.*?)<\/short>\s*<date>(.*?)<\/date>\s*<link>(.*?)<\/link>\s*<area>(.*?)<\/area>/', $file, $articles)) {
		$total = sizeof($articles[1]);
		if ($total >= 10) {
			$countto = 10;
		}
		else {
			$countto = sizeof($articles[1]);
		}
		for ($i = 0; $i < $countto; $i++) {
			print "<item>\n";
			print "<title>" . $articles[1][$i] . "</title>\n";
			print "<link>http://www.thensr.com/article.php?page=" . $articles[5][$i] . "</link>\n";
			print "<description>\n";
			print "<img alt='' height='1' width='1' src='http://www.thensr.com/rss/0.gif' />" . $articles[3][$i] . "</description>\n";
			print "<pubDate>" . $articles[4][$i] . "</pubDate>\n";
			print "</item>\n";
		}
	}
		
	fclose($fp);
}
else {
	print "<item>\n";
	print "<title>" . "cheep" . "</title>\n";
	print "<link>http://www.thensr.com/article.php?page=" . "cheep" . "&area=" . "cheep" . "</link>\n";
	print "<description>\n";
	print "<img alt='' height='1' width='1' src='http://www.thensr.com/rss/0.gif' />" . "cheep" . "</description>\n";
	print "<pubDate>" . "cheep" . "</pubDate>\n";
	print "</item>\n";
}


print "</channel>\n";
print "</rss>\n";
?>