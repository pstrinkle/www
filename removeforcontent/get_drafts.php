<?php include("data/root.php"); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'GET') {

	$user = $_COOKIE["user"];
	$type = $_GET["type"];
	$foldername = md5($user);
	$filename = $root . 'data/rfc/' . $foldername . '/' . 'draft.xml';
	
	$bottomcode = '</div></fieldset>';
	$vardraft = "<select name=draft-list id=draft-list>";
	$editbutton = '<input type=submit id=editbtn value=edit onClick="editdraft();" style="font-weight: bold" /><br>';
	$delbutton = '<input type=submit id=deletebtn value=delete onClick="deldraft();" style="font-weight: bold" /><br>';
	$prebutton = '<input type=submit id=previewbtn value=preview onClick="viewdraft();" style="font-weight: bold" /><br>';
	$button = '';

	if ($type == "edit") {
		$button = $editbutton;
	}
	else if ($type == "delete") {
		$button = $delbutton;
	}
	else if ($type == "preview") {
		$button = $prebutton;
	}

	if ($fp = fopen($filename, "r")) {
		$file = file_get_contents($filename);

		$total = 0;
		
		if (preg_match_all('/<title>(.*?)<\/title>\n<draftid>(.*?)<\/draftid>\n/', $file, $drafts)) {		
			$total = sizeof($drafts[1]);

			$i = 0;
			while ($i < $total) {
				$vardraft .= "<option value=" . $drafts[2][$i] . ">" . $drafts[1][$i] . "</option>";				
				$i++;				
			}
			$vardraft .= "</select>";	
		}
		fclose($fp);
		
		$topcode = '<br><fieldset style="width: 350px;"><legend>Drafts</legend><div id=drafts>';

		if ($total > 0) {
			print $topcode . $vardraft . $bottomcode . $button;
		}
		else {
			print $topcode . "None Saved" . $bottomcode . "<br><br>";
		}
	}	
}
?>