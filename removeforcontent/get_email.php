<?php include("data/root.php"); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') {

	$user = $_COOKIE["user"];
	$filename = $root . 'data/rfc/addr.txt';
	$vardraft = '';
	
	if ($fp = fopen($filename, "r")) {
		$file = file_get_contents($filename);
		$total = 0;

		if (preg_match_all('/(.*?)::(.*?)\n/', $file, $emails)) {		
			$total = sizeof($emails[1]);
	
			$i = 0;
			while ($i < $total) {
				if ($user == $emails[1][$i]) {
					$vardraft = $emails[2][$i];
				}
				$i++;						
			}	
		}
		fclose($fp);

		if ($total > 0) {
			print $vardraft;
		}
		else {
			print "";
		}
	}
	else {
		print "failure!";
	}	
}


?>