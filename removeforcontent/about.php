<?php include("data/root.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?
$page = $_GET['page'];

switch($page)
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
	default:
		$area2 = $area;
		break;
}
?>

<head>
<title>Network Stability Resource, <? echo $page ?> the NSR</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/main.css" charset="iso-8859-1" type="text/css">
<script type="text/javascript">
  function validateForm() {
    var errorFree = true;
	
    if(isEmpty(document.newsletter.txtEmail.value)) {
      alert('Please enter a valid email address');
      errorFree = false;
    }
	
	if(!isEmailAddress(document.newsletter.txtEmail.value)) {
      alert('Please enter a valid email address');
      errorFree = false;
    }
	
	return errorFree;
  }
  
  function isEmpty(val) {
    return val.length == 0;
  }
  
  function isEmailAddress(val) {
    return val.indexOf('@') != -1;
  }
  
  function submitInfo() {
    var URL = "newsletter_add.php?addr=";

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
  
    var http = createRequestObject();
  
    function updateCityState() {
      var addr = document.getElementById('addr').value;
      http.open('get', URL + addr);
      http.onreadystatechange = handleResponse;
      http.send(null);
    }
  
    function handleResponse() {
      if(http.readyState == 4){
        var response = http.responseText;
        alert(response);
        }
      }
    }
	  
  }
</script>
</head>

<body bgcolor="#666666">

<!-- body layout table -->
<table border="0" bgcolor="#333333" align="center">
<tr>
<td colspan="2" class="mainheader">Network Stability Resource, About the NSR
</td>
</tr>
<tr>
<td width="170" valign="top"><br>
<!-- begin left layout cell -->
<!-- left menu table -->
<?php include("rfcsubsubmenus/left.php"); ?>
<!-- end menu table -->
<!-- end left layout cell -->
</td>
    <td class="lftseperator" width="650" align="center" valign="top"><br>
        <!-- begin right layout cell -->

<?
$filename = $root . 'content/' . $page . '.txt';

if ($fp = fopen($filename, "r")) {
	$file = file_get_contents($filename);
	print $file;
	fclose($fp);
	} else {
    	print "<p class=\"alert\">Page doesn't exist.</p>";
}

if ($page == "team") {
	$submenu = $root . 'rfcsubsubmenus/team.htm';
}
else {
	$submenu = $root . 'rfcsubsubmenus/about.htm';
}

if ($fp = fopen($submenu, "r")) {
	$file = file_get_contents($submenu);
	print $file;
	fclose($fp);
    } else {
    	print "<p class=\"alert\">Page doesn't exist.</p>";
}
?>
<!-- end right layout cell -->
</td>
</tr>
<tr>
<td colspan="2" class="footer">
<?php include("rfcsubsubmenus/footer.htm"); ?>
<!-- footer inside table -->
</td>
</tr>
</table>

</body>
</html>
