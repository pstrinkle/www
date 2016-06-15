<?php include("data/root.php"); ?>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') { 

	$user = $_POST['user'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$repass = $_POST['repass'];
	$type = $_POST['acttype'];
	$unique = true;
	$filename = $root . 'data/rfc/users.txt';

	if ($fp = fopen($filename, "r")) {
		
		$file = file_get_contents($filename);

		if (preg_match_all('/(.*?)::(.*?)\n/', $file, $logins)) {
					
			$total = sizeof($logins[1]);

			for ($i = 0; $i < $total; $i++) {
				if ($user == $logins[1][$i]) {
					$unique = false;
				}
			}
	
		}

		fclose($fp);
	}

	if ($unique == false) {	
		print "fail";
	}
	else {
		$passhash = md5($pass);
		$userfilename = $root . 'data/rfc/users.txt';
		$foldername = $root . 'data/rfc/' . md5($user);
		$draftfilename = $foldername . '/draft.xml';
		
		if ($fp = fopen($userfilename, "a")) {
			if (flock($fp, LOCK_EX)) {
				fwrite($fp, "$user::$passhash\n");
				flock($fp, LOCK_UN);
			}
			fclose($fp);
		}
		else {
			print "Failed to Open";
		}
		
		if ($type == "author") {
		
			mkdir($foldername,0666);
		
			if ($dp = fopen($draftfilename, "w")) {
				fwrite($dp, "");
				fclose($dp);
			}
			else {
				print "Failed to Create drafts.xml";
			}
		}
	
		print "success";
	}
}

?>