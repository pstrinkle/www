<?php include("data/root.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?
$area = "main";
$false = 0;

switch($area)
{
	case "pc":
		$area2 = "pc";
		break;
	case "tech":
		$area2 = "tech";
		break;
	case "linux":
		$area2 = "linux";
		break;
	case "gamer":
		$area2 = "gamer";
		break;
	case "activities":
		$area2 = "team";
		break;
	default:
		$area2 = $area;
		break;
}

if ($area == "activities") {
	$area2 = "team";
}

?>
<head>
<title>Network Stability Resource</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/main.css" charset="iso-8859-1" type="text/css">
<link rel="alternate" type="application/rss+xml" title="Network Stability Resources [10 Most Recent]" href="http://www.thensr.com/rss/rss.php">
<script language="Javascript">
<!--

  function validateComment() {
 
    var errorFree = true;
	
    if(isEmpty(document.getElementById('comment').value)) {
      errorFree = false;
    }
	
	
    if (errorFree == true) {
	  document.getElementById('commentgo').value = "Adding";
          document.getElementById('commentgo').disabled = true;
          addcomment();	
    }
    else {
      alert('Invalid!');
    }
  }
  
  function isEmpty(val) {
    return val.length == 0;
  }

  var CommentURL = "general_add.php";

  function createRequestObject() {
    var ro;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
      ro = new ActiveXObject("Microsoft.XMLHTTP");
    } else {
      ro = new XMLHttpRequest();
    }
    return ro;
    }
  
  var httpcom = createRequestObject();
  
  function addcomment() {
    var comment = "comment=" + encodeURIComponent(document.getElementById('comment').value) + "&name=" + encodeURIComponent(document.getElementById('namego').value);

    httpcom.onreadystatechange = handlecomment;
    httpcom.open('post',CommentURL,true);
    httpcom.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    httpcom.setRequestHeader("Content-length", comment.length);
    httpcom.setRequestHeader("Connection", "close");
    httpcom.send(comment);
  }
  
  function handlecomment() {
    if(httpcom.readyState == 4) {
      if (httpcom.status == 200) {
        var response = httpcom.responseText;
        document.getElementById('commentgo').disabled = false;
        document.getElementById('commentgo').value = "Add";
        document.getElementById('comment').value = '';
        document.getElementById('namego').value = '';

        if (response != "") {
          document.getElementById('after').innerHTML = document.getElementById('after').innerHTML + response;
        }
        else {
          alert('failed to add');
        }
      }
      else {
        alert('There was a problem with the request.');
      }
    }
  }
	
// -->
</script>
<script language="Javascript">
<!--
//functions

function roll(img1, img2)
{
  if(document.images)
  {
    document[img1].src=eval(img2+".src");
  }
}

function window_load(url, width, height)
{
  var Options = "toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=1,width="+width+",height="+height+",left=20,top=20";
  
    popup = window.open("", "", Options);
	
	popup.creator = top;
	popup.document.writeln("<html><head><title>Viewfinder</title></head>")
	popup.document.writeln("<body marginheight='0' marginwidth='0' topmargin='0' leftmargin='0'>");
	popup.document.writeln("<p><a href='javascript:window.close()'><img border='0' src="+url+" onclick='window.close()' width="+width+" height="+height+"></a></p>");
	popup.document.writeln("</body></html>");
}

function nothing()
{
}

// -->
</script>
<script language="JavaScript1.2" src="js/video.js" type="text/javascript"></script>
<script language="JavaScript1.2" src="js/newsletter.js" type="text/javascript"></script>
</head>
<body bgcolor="#666666">
<!-- body layout table -->
<table border="0" bgcolor="#333333" align="center">
  <tr><td colspan="2" class="mainheader">Network Stability Resource, NSR Article</td></tr>
  <tr> 
    <td width="170" valign="top"><br> 
      <!-- begin left layout cell -->
      <!-- left menu table -->
      <?php include("submenus/left.php"); ?> 
      <!-- end menu table -->
      <!-- end left layout cell -->
    </td>
    <td class="lftseperator" width="650" align="center" valign="top"><br> 
      <!-- begin right layout cell -->
          <div class="mainheader">Post General Comments for the Site</div>		  
      <br>
	  <div class="post" id="after"> 
<?


	$filename = $root . 'data/general_comments.xml';

	if (file_exists($filename)) {

		if ($fp = fopen($filename, "r")) {
			$file = file_get_contents($filename);

			if (preg_match_all('/<name>(.*?)<\/name><comment>(.*?)<\/comment>/s', $file, $comments)) {
					
				$total = sizeof($comments[1]);

				for ($i = 0; $i < $total; $i++) {
					print "<p class=\"comment\">Name: " . htmlspecialchars($comments[1][$i]) . "<br>Comment: " . htmlspecialchars($comments[2][$i]) . "<br></p>\n";
				}
			}

			fclose($fp);
		}
		else {
			print "<p class=\"comment\">Add first comment</p>\n";
		}
	} else {
		print "<p class=\"comment\">Add first comment</p>\n";
	}
?>
      </div>
	  <br>
	  <div class="input"> 
        <label for="namego" class="white">Your Handle:</label>
        <input class="txtbox" type="text" onClick="value=''" value="enter handle here" size="35" id="namego">
        <br>
        <textarea class="txtbox" rows="6" cols="63" id="comment" value="enter comment here..." style="width: 600px;"></textarea>
        <br>
        <input type="button" value="post comment" size="4" onClick="validateComment();" id="commentgo" style="color: #FFFFFF; width: 100px; background-color: #7fb2df;">
      </div>

      <br>
      <br> 
      <!-- end right layout cell -->
    </td>
  </tr>
  <tr> 
    <td colspan="2" class="footer"> <?php include("submenus/footer.htm"); ?> 
      <!-- footer inside table -->
    </td>
  </tr>
</table>
</body>
</html>
