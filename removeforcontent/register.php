<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript">
<!--
	
	function createRequestObject() {
		var ro;
		var browser = navigator.appName;
		
		if (browser == "Microsoft Internet Explorer") {
			ro = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			ro = new XMLHttpRequest();
		}
		
		return ro;
	}
	
	var userurl = "add_user.php";	
	var httpuser = createRequestObject();
	
	function adduser() {
		var userlink = "?user=" + encodeURIComponent(document.getElementById('user').value)
			+ "&pass=" + encodeURIComponent(document.getElementById('pass').value) 
			+ "&repass=" + encodeURIComponent(document.getElementById('repass').value)
			+ "&email=" + encodeURIComponent(document.getElementById('email').value);
		
		var acttype = "";
		
		if (document.getElementById('author').Checked) {
			acttype = "author";
		}
		else {
			acttype = "normal";
		}
		
		userlink += "&acttype=" + acttype;		

    	httpuser.onreadystatechange = handleadduser;
   		httpuser.open('post',userurl,true);
    	httpuser.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    	httpuser.setRequestHeader("Content-length", userlink.length);
    	httpuser.setRequestHeader("Connection", "close");
    	httpuser.send(userlink);
	}
	
	function handleadduser() {
		if (httpuser.readyState == 4) {
			if (httpuser.status == 200) {
				if (httpuser.responseText != "success") {
					alert(httpuser.responseText);
					document.getElementById("user").style.border = '1px solid #ff0000';
					document.getElementById("register").disabled = false;
				}
				else {
					alert(httpuser.responseText);
					document.getElementById('main').innerHTML = "<p>You have successfully registered, but are not yet logged in.</p>";
				}
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
	
	var valid = true;
	
	function validateForm() {
		document.getElementById("register").disabled = true;

		if (document.getElementById("email").value == "") {
			document.getElementById("email").style.border = '1px solid #ff0000';
			valid = false;
		}
		
		if (document.getElementById("email").value.indexOf("@") == -1) {
			document.getElementById("email").style.border = '1px solid #ff0000';
			valid = false;
		}

	    if (document.getElementById("user").value == "") {
			document.getElementById("user").style.border = '1px solid #ff0000';
			valid = false;
	    }

	    if (document.getElementById("pass").value == "" ) {
			document.getElementById("pass").style.border = '1px solid #ff0000';
			valid = false;
	    }
		
		if (document.getElementById("repass").value == "" ) {
			document.getElementById("repass").style.border = '1px solid #ff0000';
			valid = false;
	    }
		
		if (document.getElementById("pass").value != document.getElementById("repass").value) {
			document.getElementById("pass").style.border = '1px solid #ff0000';
			document.getElementById("repass").style.border = '1px solid #ff0000';
			valid = false;
		}
		
		if (document.getElementById("user").value.indexOf(':') != -1) {
			document.getElementById("user").style.border = '1px solid #ff0000';
			valid = false;
		}
			
	    if (valid == false) {
			document.getElementById("valid").innerHTML = '<span style="color: #ff0000;">There have been some errors!</span>';
			document.getElementById("register").disabled = false;
	    }
		
		if (valid == true) {
			adduser();
		}
	}

	  // -->
</script>
</head>

<body>
<div id="valid"></div>
<div id="main" style="width: 300px; border-top: 1px solid #333; border-right: 1px solid #333; border-bottom: 1px solid #333; border-left: 1px solid #333;">
    <table width="300">
		<tr>
            <td><label for="email">Email Address:</label></td>
            <td><input id="email" name="email" value="" /></td>
        </tr>
        <tr>
            <td><label for="user">Username:</label></td>
            <td><input id="user" name="user" value="" /></td>
        </tr>
        <tr>
            <td><label for="pass">Password:</label></td>
            <td><input type="password" id="pass" name="pass" value="" /></td>
        </tr>
		<tr>
            <td><label for="repass">Reenter Password:</label></td>
            <td><input type="password" id="repass" name="repass" value="" /></td>
        </tr>
	</table>
	<table width="300">
		<tr>
			<td colspan="2">
			<fieldset>
			<legend>Type of Account</legend>
			<input type="radio" name="acttype" value="normal" id="normal" onClick="document.getElementById('info').innerHTML = ''" Checked/><label for="normal">normal account</label>
			<input type="radio" name="acttype" value="author" id="author" onClick="document.getElementById('info').innerHTML = 'Author accounts are special and have certain settings.  After 1 month of inactivity the account will be automatically deleted.'" /><label for="author">author account</label>			
			<div id="info" style="width: 100%; border-top: 1px solid #333;"></div>
			</fieldset>
			</td>
		</tr>	
        <tr>
            <td colspan="2" align="right">
                <input type="button" value="Register" id="register" style="font-weight: bold" onClick="validateForm();"/>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
