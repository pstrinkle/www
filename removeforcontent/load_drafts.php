<?php include("data/root.php"); ?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'GET') {

	$user = $_COOKIE["user"];
	$foldername = md5($user);
	$filename = $root . 'data/rfc/' . $foldername . '/' . 'draft.xml';
	$xmlstring = '';

	if ($fp = fopen($filename, "r")) {
		$file = file_get_contents($filename);

		$total = 0;

		if (preg_match_all('/<title>(.*?)<\/title>\n<draftid>(.*?)<\/draftid>\n/', $file, $drafts)) {		
			$total = sizeof($drafts[1]);

			$xmlstring .= "<size>" . $total . "</size>";

			$i = 0;
			while ($i < $total) {
				$xmlstring .= "<title>" . $drafts[1][$i] . "</title>";				
				$i++;						
			}	
		}
		fclose($fp);

		if ($total > 0) {
			print $xmlstring;
		}
	}	
}
?>