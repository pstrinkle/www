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

		$img = '';
		// have this change the img url end

		switch($category) {
			case "pc":
				$img = 'pc';
				break;
			case "tech":
				$img = 'tech';			
				break;
			case "linux":
				$img = 'linux';
				break;
			case "gamer":
				$img = 'gamer';
				break;
			case "security":
				$img = 'security';
				break;
			case "random":
				$img = 'random';
				break;		
		}
		
		$fixed = preg_replace('/\n/', '<br>', $article);
		
		$output = '<div id="title" style="border-left: 10px solid #FFF;">Title: ' . $newtitle . '</div><br>';		
		$output .= '<img src=http://www.removeforcontent.com/_smalls/' . $img . '.gif  border="0" alt="' . $img . '" />';		
		$output .= '<div id="article" style="border-left: 10px solid #FFF;">' . $fixed . '</div>';

		print $output;
	}
}
?>