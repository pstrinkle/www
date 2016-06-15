<?php include("data/root.php"); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') { 

	$user = $_POST['user'];
	$pass = $_POST['pass'];
 
	$success = false;

	$filename = $root . 'data/rfc/users.txt';

	if ($fp = fopen($filename, "r")) {
			
		$file = file_get_contents($filename);

		if (preg_match_all('/(.*?)::(.*?)\n/', $file, $logins)) {
					
			$total = sizeof($logins[1]);

			for ($i = 0; $i < $total; $i++) {
				if ($user == $logins[1][$i]) {
					if (md5($pass) == $logins[2][$i]) {
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
		setcookie("user", $user, time()+14400);	
		print "<p>success!</p>";
	}
}

?>