<?php include("data/root.php"); ?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'GET') {

	$title = $_GET['title'];
	$username = $_COOKIE["user"];
	
	$foldername = md5($username);				

	$filename = $root . 'data/rfc/' . $foldername . '/' . $title . '.xml';
	$draftfilename = $root . 'data/rfc/' . $foldername . '/' . 'draft.xml';
	
	if(unlink($filename)) {
		print "Success!";
	}
	
	if ($fp = fopen($draftfilename, "r")) {
		$file = file_get_contents($draftfilename);

		if (preg_match_all('/<title>(.*?)<\/title>\n<draftid>(.*?)<\/draftid>\n/', $file, $drafts)) {		
			$total = sizeof($drafts[1]);
	
			if ($op = fopen($draftfilename, "w")) {
	
				$i = 0;
				while ($i < $total) {
	
					if ($drafts[2][$i] != $title) {
						fwrite($op, "<title>" . $drafts[1][$i] . "</title>\n<draftid>" . $drafts[2][$i] . "</draftid>\n");										
					}
					
					$i++;
				}
			}
				
		}
		fclose($fp);

		print $vardraft;
	}	
}
?>