<?php include("data/root.php"); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') { 

	$user = $_COOKIE["user"];
	$newemail = $_POST["newemail"];	

	$filename = $root . 'data/rfc/addr.txt';

	if ($op = fopen($filename, "r+")) {
		if (flock($op, LOCK_EX)) {
	
			$userinfo = file_get_contents($filename);

			if (preg_match_all('/(.*?)::(.*?)\n/', $userinfo, $ologins)) {
				$total = sizeof($ologins[1]);
			
				for ($i = 0; $i < $total; $i++) {				
					if ($user == $ologins[1][$i]) {
						$output = $ologins[1][$i] . "::" . $newemail . "\n";
						fwrite($op,$output);
					}
					else {
						$output = $ologins[1][$i] . "::" . $ologins[2][$i] . "\n";
						fwrite($op,$output);
					}
				}
			}
			
			flock($op, LOCK_UN);
		}
			
		fclose($op);
			
		print "success!";
	}
	else {
		print "failed to reopen file!";
	}
}
	
?>