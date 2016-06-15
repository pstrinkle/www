<?php include("data/root.php"); ?>

<?php 
if($_SERVER['REQUEST_METHOD'] == 'GET') {

	$title = $_GET['title'];
	$username = $_COOKIE["user"];
	$foldername = md5($username);				
	$filename = $root . 'data/rfc/' . $foldername . '/' . $title . '.xml';
	
  	if ($fp = fopen($filename, "r")) {
		$file = file_get_contents($filename);
		fclose($fp);

		$newtitle = '';
		$date = '';
		$category = '';
		$article = '';

		if (preg_match('/<title>(.*?)<\/title>\n<date>(.*?)<\/date>\n<category>(.*?)<\/category>\n<article>(.*?)<\/article>/s', $file, $elements)) {		
			$newtitle = $elements[1];
			$date = $elements[2];
			$category = $elements[3];
			$article = $elements[4];	
		}

		$pc = '';
		$tech = '';
		$linux = '';
		$gamer = '';
		$security = '';
		$random = '';

		switch($category) {
			case "pc":
				$pc = 'Checked';
				break;
			case "tech":
				$tech = 'Checked';			
				break;
			case "linux":
				$linux = 'Checked';
				break;
			case "gamer":
				$gamer = 'Checked';
				break;
			case "security":
				$security = 'Checked';
				break;
			case "random":
				$random = 'Checked';
				break;		
		}

		$output = '<table><tr><td><fieldset><legend>Title</legend>';
		$output .= $newtitle . '</fieldset></td></tr>';
		$output .= '<input type="hidden" id="title" name="title" value="' . $newtitle . '" />';
		$output .= '<input type="hidden" id="date" name="date" value="' . $date . '" />';
		$output .= '<input type="hidden" id="filehash" name="filehash" value="' . $title . '" />';
		$output .= '<tr><td><fieldset><legend>Categories</legend>';
		$output .= '<input type="radio" name="category" value="pc" id="pc" onClick="chgIcon(\'pc\');" ' . $pc . ' /><label for="pc">pc</label>';
		$output .= '<input type="radio" name="category" value="tech" id="tech" onClick="chgIcon(\'tech\');" ' . $tech . ' /><label for="tech">tech</label>';
		$output .= '<input type="radio" name="category" value="linux" id="linux" onClick="chgIcon(\'linux\');" ' . $linux . ' /><label for="linux">linux</label>';
		$output .= '<input type="radio" name="category" value="gamer" id="gamer" onClick="chgIcon(\'gamer\');" ' . $gamer . ' /><label for="gamer">gamer</label>';
		$output .= '<input type="radio" name="category" value="security" id="security" onClick="chgIcon(\'security\');" ' . $security . ' /><label for="security">security</label>';
		$output .= '<input type="radio" name="category" value="random" id="random" onClick="chgIcon(\'random\');" ' . $random . ' /><label for="random">random</label>';
		$output .= '</fieldset>';
		$output .= '<fieldset style="width: 85px; visibility: hidden;" id="iconcontainer"><legend>Icon</legend><div id="icon"></div></fieldset>';
		$output .= '</td></tr></table>';
		$output .= '<table><tr><td><fieldset><legend>Article Content</legend>';
		$output .= '<textarea id="article" name="article" value="" rows="30" cols="100" onKeyUp="document.getElementById(\'room\').value = (12000-this.value.length); document.getElementById(\'room\').size = 3;">' . $article . '</textarea>';
		$output .= '</fieldset></td></tr><tr><td align="right">';
		$output .= '<input type="submit" id="submitbtn" value="Save Changes" onClick="savechgdraft();" style="font-weight: bold" />';
		$output .= '</td></tr>';
		$output .= '<tr><td><input id="room" name="room" size="3" value="' . (12000 - strlen($article)) . '"></td></tr>';
		$output .= '</table>';

		print $output;
	}
}
?>