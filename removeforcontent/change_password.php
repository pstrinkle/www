<?php include("data/root.php"); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') { 

	$user = $_COOKIE["user"];
	$oldpass = $_POST["oldpass"];
	$newpassword = $_POST["pass"];
	
	$success = false;

	$filename = $root . 'data/rfc/users.txt';

	if ($fp = fopen($filename, "r")) {
			
		$file = file_get_contents($filename);

		if (preg_match_all('/(.*?)::(.*?)\n/', $file, $logins)) {
					
			$total = sizeof($logins[1]);

			for ($i = 0; $i < $total; $i++) {
				if ($user == $logins[1][$i]) {
					if (md5($oldpass) == $logins[2][$i]) {
						$success = true;
					}
					else {
						$success = false;
					}
				}
			}
	
		}

		fclose($fp);
	}

	if ($success == true) {
		if ($op = fopen($filename, "r+")) {
			if (flock($op, LOCK_EX)) {
		
				$userinfo = file_get_contents($filename);

				if (preg_match_all('/(.*?)::(.*?)\n/', $userinfo, $ologins)) {
					$total = sizeof($ologins[1]);
				
					for ($i = 0; $i < $total; $i++) {				
						if ($user == $ologins[1][$i]) {
							$output = $ologins[1][$i] . "::" . md5($newpassword) . "\n";
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
	else {
		print "failure!";
	}
}
	
?>