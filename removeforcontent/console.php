<?php include("data/root.php"); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
	$user = $_COOKIE["user"];
	
	
	if ($user != "") {
	/* below will only show up if you have a valid cookie */
?>
<style>
a.main {
	color: #000;
	text-decoration: none;
}
a.secmain {
	color: #FFF;
	text-decoration: none;
}
</style>
<?

print "<script language=\"JavaScript\">\n";
print "var user = \"$user\";\n";
print "</script>\n";

?>
<script language="JavaScript">
	function createRequestObject() {
		var ro;
		var browser = navigator.appName;
		
		if(browser == "Microsoft Internet Explorer") {
			ro = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			ro = new XMLHttpRequest();
		}
		
		return ro;
	}
</script>
<script language="JavaScript">
	var httpdraftlist = createRequestObject();
	var httploaddraftlist = createRequestObject();

	var getdraftlisturl = "get_drafts.php";
	var loaddrafturl = "load_drafts.php";
	
	function getdraftlist(type) {
		var draftitem = "";
		
		if (type == "edit") {
			draftitem = "?type=edit";
		}
		else if (type == "delete") {
			draftitem = "?type=delete";
		}
		else {
			draftitem = "?type=preview";
		}
				
		httpdraftlist.open('get', getdraftlisturl + draftitem);
    	httpdraftlist.onreadystatechange = handledraftlist;
    	httpdraftlist.send(null);				
	}
	
	function handledraftlist() {
		if(httpdraftlist.readyState == 4) {
			if (httpdraftlist.status == 200) {
				if (httpdraftlist.responseText != "") {
					document.getElementById('inner').innerHTML += httpdraftlist.responseText;
					document.getElementById('temp').style.visibility = 'hidden';
				}
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
	
	function loaddrafts() {	
		httploaddraftlist.open('get', loaddrafturl);
    	httploaddraftlist.onreadystatechange = handleloaddrafts;
    	httploaddraftlist.send(null);				
	}
	
	function handleloaddrafts() {
		if(httploaddraftlist.readyState == 4) { 
			if (httploaddraftlist.status == 200) {
				if (httploaddraftlist.responseText != "") {
					var sizeex = new RegExp('<size>(.*?)</size>');
					var regex = new RegExp('<title>(.*?)</title>', "g");
					var data = new Array();
					var buildstring = '';
					
					var size = sizeex.exec(httploaddraftlist.responseText);
					buildstring += "<fieldset style=\"width: 300px; \"><legend>Currently Saved Drafts</legend><ul>";
					
					for (i = 0; i < size[1]; i++) {
					
						data = regex.exec(httploaddraftlist.responseText);						
				
						for (j = 1; j < data.length; j++) {
							buildstring += "<li>" + data[j] + "</li>";
						}
					}
					
					buildstring += "</ul></fieldset>";
					document.getElementById('inner').innerHTML += buildstring;					
					document.getElementById('temp').style.visibility = 'hidden';
				}
				else {
					document.getElementById('inner').innerHTML += "None Saved";
					document.getElementById('temp').style.visibility = 'hidden';
				}
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
</script>
<script language="JavaScript">
	var httpchgpasswd = createRequestObject();
	var httpchgemail = createRequestObject();
	var httpgetemail = createRequestObject();
	
	var chgpasswdurl = "change_password.php";
	var chgemailurl = "change_email.php";
	var chggetemailurl = "get_email.php";
	
	function changepassword() {
		document.getElementById('passwdbtn').disabled = true;
		document.getElementById('oldpass').disabled = true;
		document.getElementById('pass').disabled = true;
		document.getElementById('repass').disabled = true;
		
		if (document.getElementById('oldpass').value == "" || document.getElementById('pass').value == "" || document.getElementById('repass').value == "") {
			alert('no blank passwords');
			chgpasswd();
		}		
		else if (document.getElementById('pass').value == document.getElementById('repass').value) {
		
			var submit_chgpass = "oldpass=" + encodeURIComponent(document.getElementById('oldpass').value)
				+ "&pass=" + encodeURIComponent(document.getElementById('pass').value);

	    	httpchgpasswd.onreadystatechange = handlepasschg;
	    	httpchgpasswd.open('post',chgpasswdurl,true);
    		httpchgpasswd.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    		httpchgpasswd.setRequestHeader("Content-length", submit_chgpass.length);
	    	httpchgpasswd.setRequestHeader("Connection", "close");
    		httpchgpasswd.send(submit_chgpass);
		}
		else {
			alert('passwords don\'t match');
			chgpasswd();
		}
	}
	
	function handlepasschg() {
		if(httpchgpasswd.readyState == 4) {
			if (httpchgpasswd.status == 200) {
				alert(httpchgpasswd.responseText);				
				account();
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
	
	function chgemailaddr() {
		document.getElementById("emailaddr").style.border = '';
		document.getElementById('emailaddr').disabled = true;
		document.getElementById('chgemailbtn').disabled = true;
		
		if (document.getElementById('emailaddr').value == "") {
			alert('no blank email addresses');
			document.getElementById("emailaddr").style.border = '1px solid #ff0000';
			document.getElementById('emailaddr').disabled = false;
			document.getElementById('chgemailbtn').disabled = false;
		}
		else if (document.getElementById("emailaddr").value.indexOf("@") == -1) {
			alert('apparently invalid');
			document.getElementById("emailaddr").style.border = '1px solid #ff0000';
			document.getElementById('emailaddr').disabled = false;
			document.getElementById('chgemailbtn').disabled = false;
		}
		else {
			var submit_chgemail = "newemail=" + encodeURIComponent(document.getElementById('emailaddr').value);

	    	httpchgemail.onreadystatechange = handleemailchg;
	    	httpchgemail.open('post',chgemailurl,true);
    		httpchgemail.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    		httpchgemail.setRequestHeader("Content-length", submit_chgemail.length);
	    	httpchgemail.setRequestHeader("Connection", "close");
    		httpchgemail.send(submit_chgemail);
		}
	}
	
	function handleemailchg() {
		if(httpchgemail.readyState == 4) {
			if (httpchgemail.status == 200) {
				alert(httpchgemail.responseText);				
				account();
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
	
	function getemailaddr() {
		httpgetemail.open('get', chggetemailurl);
    	httpgetemail.onreadystatechange = handlegetemailaddr;
    	httpgetemail.send(null);				
	}
	
	function handlegetemailaddr() {
		if(httpgetemail.readyState == 4) {
			if (httpgetemail.status == 200) {			
				if (httpgetemail.responseText == "") {
					document.getElementById('emailaddr').value = "none on file";
				}
				else if (httpgetemail.responseText == "failure!") {
					document.getElementById('emailaddr').value = "failed to read file";
				}
				else {
					document.getElementById('emailaddr').disabled = false;
					document.getElementById('chgemailbtn').disabled = false;
					document.getElementById('emailaddr').value = httpgetemail.responseText;
				}
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
</script>
<script language="JavaScript">
	var httpdraft = createRequestObject();
	
	var drafturl = "save_draft.php";
	
	function savenewdraft() {
		if (document.getElementById('article').value.length > 0 && document.getElementById('title').value != "enter title here...") {
		
			document.getElementById('title').disabled = true;
			document.getElementById('article').disabled = true;	
			document.getElementById('submitbtn').disabled = true;
	
			var category = "";
			
			if (document.getElementById('pc').checked) {
				category = document.getElementById('pc').value;			
			}
			else if (document.getElementById('tech').checked) {
				category = document.getElementById('tech').value;
			}
			else if (document.getElementById('linux').checked) {
				category = document.getElementById('linux').value;
			}
			else if (document.getElementById('gamer').checked) {
				category = document.getElementById('gamer').value;
			}
			else if (document.getElementById('random').checked) {
				category = document.getElementById('random').value;
			}
			else {
				category = document.getElementById('pc').value;
			}
		
			document.getElementById('pc').disabled = true;
			document.getElementById('tech').disabled = true;
			document.getElementById('linux').disabled = true;
			document.getElementById('gamer').disabled = true;
			document.getElementById('security').disabled = true;
			document.getElementById('random').disabled = true;
	    
    		var submit_draft = "title=" + encodeURIComponent(document.getElementById('title').value)
				+ "&category=" + encodeURIComponent(category)			
				+ "&article=" + encodeURIComponent(document.getElementById('article').value);

	    	httpdraft.onreadystatechange = handledraft;
    		httpdraft.open('post',drafturl,true);
	    	httpdraft.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    		httpdraft.setRequestHeader("Content-length", submit_draft.length);
	    	httpdraft.setRequestHeader("Connection", "close");
    		httpdraft.send(submit_draft);
		}
		else {
			alert('bad!');
		}
	}
	
	function handledraft() {
		if(httpdraft.readyState == 4) {
			if (httpdraft.status == 200) {
				alert(httpdraft.responseText);
				articles();
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
</script>
<script language="JavaScript">		
	var deldrafturl = "del_draft.php";

	var httpdeldraft = createRequestObject();

	function deldraft() {
		var deldraftitem = "?title=" + document.getElementById('draft-list').value;
		document.getElementById('draft-list').disabled = true;
		document.getElementById('deletebtn').disabled = true;
		httpdeldraft.open('get', deldrafturl + deldraftitem);
    	httpdeldraft.onreadystatechange = handledeldraft;
    	httpdeldraft.send(null);
	}
	
	function handledeldraft() {
		if(httpdeldraft.readyState == 4) {
			if (httpdeldraft.status == 200) {			
				if (httpdeldraft.responseText != "") {
					alert(httpdeldraft.responseText);
					articles();
				}
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
</script>
<script language="JavaScript">
	var editdrafturl = "edit_draft.php";

	var httpeditdraft = createRequestObject();
	
	function editdraft() {
		var editdraftitem = "?title=" + document.getElementById('draft-list').value;
		document.getElementById('draft-list').disabled = true;
		document.getElementById('editbtn').disabled = true;
		httpeditdraft.open('get', editdrafturl + editdraftitem);
    	httpeditdraft.onreadystatechange = handleeditdraft;
    	httpeditdraft.send(null);
	}
	
	function handleeditdraft() {
		if(httpeditdraft.readyState == 4) {
			if (httpeditdraft.status == 200) {
				if (httpeditdraft.responseText != "") {
					document.getElementById('inner').innerHTML = httpeditdraft.responseText;
				}
				else {
					alert('error');
					editart();
				}
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
</script>
<script language="JavaScript">
	var saveeditdrafturl = "change_draft.php";

	var httpsaveeditdraft = createRequestObject();

	function savechgdraft() {
		if (document.getElementById('article').value.length > 0) {
		
			document.getElementById('title').disabled = true;
			document.getElementById('article').disabled = true;	
			document.getElementById('submitbtn').disabled = true;
	
			var category = "";
			
			if (document.getElementById('pc').checked) {
				category = document.getElementById('pc').value;			
			}
			else if (document.getElementById('tech').checked) {
				category = document.getElementById('tech').value;
			}
			else if (document.getElementById('linux').checked) {
				category = document.getElementById('linux').value;
			}
			else if (document.getElementById('gamer').checked) {
				category = document.getElementById('gamer').value;
			}
			else if (document.getElementById('random').checked) {
				category = document.getElementById('random').value;
			}
			else {
				category = document.getElementById('pc').value;
			}
		
			document.getElementById('pc').disabled = true;
			document.getElementById('tech').disabled = true;
			document.getElementById('linux').disabled = true;
			document.getElementById('gamer').disabled = true;
			document.getElementById('security').disabled = true;
			document.getElementById('random').disabled = true;
    
    		var submit_draft = "title=" + encodeURIComponent(document.getElementById('title').value)
				+ "&date=" + encodeURIComponent(document.getElementById('date').value)
				+ "&filehash=" + encodeURIComponent(document.getElementById('filehash').value)
				+ "&category=" + encodeURIComponent(category)			
				+ "&article=" + encodeURIComponent(document.getElementById('article').value);

	    	httpsaveeditdraft.onreadystatechange = handlechgdraft;
    		httpsaveeditdraft.open('post',saveeditdrafturl,true);
	    	httpsaveeditdraft.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    		httpsaveeditdraft.setRequestHeader("Content-length", submit_draft.length);
	    	httpsaveeditdraft.setRequestHeader("Connection", "close");
    		httpsaveeditdraft.send(submit_draft);
		}
		else {
			alert('bad!');
		}
	
	}
	
	function handlechgdraft() {
		if(httpsaveeditdraft.readyState == 4) {
			if (httpsaveeditdraft.status == 200) {			
				if (httpsaveeditdraft.responseText != "") {
					alert(httpsaveeditdraft.responseText);
					articles();
				}
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
</script>
<script language="JavaScript">
	var viewdrafturl = "view_draft.php";

	var httpviewdraft = createRequestObject();

	function viewdraft() {
		var viewdraftitem = "?title=" + document.getElementById('draft-list').value;
		document.getElementById('draft-list').disabled = true;
		document.getElementById('previewbtn').disabled = true;
		document.getElementById('inner').innerHTML = "";
		document.getElementById('temp').style.visibility = 'visible';
		document.getElementById('temp').innerHTML = "<i>loading...</i>";
		
		httpviewdraft.open('get', viewdrafturl + viewdraftitem);
    	httpviewdraft.onreadystatechange = handleviewdraft;
    	httpviewdraft.send(null);
	}
	
	function handleviewdraft() {
		if(httpviewdraft.readyState == 4) {
			if (httpviewdraft.status == 200) {			
				if (httpviewdraft.responseText != "") {
					document.getElementById('inner').innerHTML = httpviewdraft.responseText;
					document.getElementById('temp').style.visibility = 'hidden';
				}
				else {
					articles();
				}
			}
			else {
				alert('There was a problem with the request.');
			}
		}
	}
</script>
<script language="JavaScript">
	function chgIcon(name) {
		document.getElementById('icon').innerHTML = "<img src=http://www.thensr.com/removeforcontent/_smalls/" + name + ".gif" + " border=\"0\" alt=\"" + name + "\" />";
		document.getElementById('iconcontainer').style.visibility = 'visible';	
	}

	var mainArea = "<p>Welcome, " + user + " like who you are</p>";

	var acctArea = "<p>Change password, email address, etc</p>";

	var mainLinks = "<a href=\"javascript:main();\" class=\"main\">main</a> | <a href=\"javascript:articles();\" class=\"main\">articles</a> | <a href=\"javascript:account();\" class=\"main\">account</a><span id=\"inlinks\"></span>";
	
	var artLinks = ' | <a href="javascript:newart();" class="secmain">new draft</a> | <a href="javascript:editart();" class="secmain">edit draft</a> | <a href="javascript:deleteart();" class="secmain">delete draft</a> | <a href="javascript:previewart();" class="secmain">preview draft</a>';

	var acctLinks = ' | <a href="javascript:chgpasswd();" class="secmain">change password</a> | <a href="javascript:chgemail();" class="secmain">change email address</a>';
	
	var artArea = "<p>This is the main area for access to articles.  Here you can create new articles, which you can save as drafts.<br>"
		+ "  You can also post the draft as an article, edit drafts, or delete drafts.</p>";
		
	// article stuff
	var newArea = "<br><table><tr><td><fieldset>"
		+ "<legend>Title</legend>"
		+ "<input id=\"title\" name=\"title\" value=\"enter title here...\" size=\"50\" />"
		+ "</fieldset></td></tr>"
		+ "<tr><td><fieldset><legend>Categories</legend>"
		+ "<input type=\"radio\" name=\"category\" value=\"pc\" id=\"pc\" onClick=\"chgIcon('pc');\" /><label for=\"pc\">pc</label>"
		+ "<input type=\"radio\" name=\"category\" value=\"tech\" id=\"tech\" onClick=\"chgIcon('tech');\" /><label for=\"tech\">tech</label>"
		+ "<input type=\"radio\" name=\"category\" value=\"linux\" id=\"linux\" onClick=\"chgIcon('linux');\" /><label for=\"linux\">linux</label>"
		+ "<input type=\"radio\" name=\"category\" value=\"gamer\" id=\"gamer\" onClick=\"chgIcon('gamer');\" /><label for=\"gamer\">gamer</label>"
		+ "<input type=\"radio\" name=\"category\" value=\"security\" id=\"security\" onClick=\"chgIcon('security');\" /><label for=\"security\">security</label>"
		+ "<input type=\"radio\" name=\"category\" value=\"random\" id=\"random\" onClick=\"chgIcon('random');\" /><label for=\"random\">random</label>"
		+ "</fieldset>"
		+ "<fieldset style=\"width: 85px; visibility: hidden;\" id=\"iconcontainer\"><legend>Icon</legend><div id=\"icon\"></div></fieldset>"
		+ "</td></tr></table>"
		+ "<table><tr><td><fieldset><legend>Article Content</legend>"
		+ "<textarea id=\"article\" name=\"article\" value=\"\" rows=\"30\" cols=\"100\" onKeyUp=\"document.getElementById('room').value = (12000-this.value.length); document.getElementById('room').size = 3;\"></textarea>"
		+ "</fieldset></td></tr><tr><td align=\"right\">"
		+ "<input type=\"submit\" id=\"submitbtn\" value=\"Save Draft\" onClick=\"savenewdraft();\" style=\"font-weight: bold\" />"
		+ "</td></tr>"
		+ "<tr><td><input id=\"room\" name=\"room\" size=\"17\" value=\"characters available\"></td></tr>"
		+ "</table>";
	
	function account() {
		document.getElementById('title').innerHTML = "::account::";
		document.getElementById('links').style.width = "550px";
		document.getElementById('inlinks').innerHTML = acctLinks;
        document.getElementById('inner').innerHTML = acctArea;	
	}
	
    function main() {
		document.getElementById('temp').style.visibility = "hidden";
		document.getElementById('title').innerHTML = "::main::";
		document.getElementById('links').style.width = "205px";
		document.getElementById('links').innerHTML = mainLinks;
        document.getElementById('inner').innerHTML = mainArea;
	}

	function articles() {
		document.getElementById('title').innerHTML = "::articles::";
		document.getElementById('links').style.width = "620px";
		document.getElementById('inlinks').innerHTML = artLinks;		
		document.getElementById('inner').innerHTML = artArea;
		document.getElementById('temp').style.visibility = 'visible';
		document.getElementById('temp').innerHTML = "<i>loading...</i>";
		
		loaddrafts();
	}
		
	function newart() {
		document.getElementById('title').innerHTML = "::articles(new)::";
		document.getElementById('inner').innerHTML = newArea;
	}
		
	function editart() {	
		document.getElementById('title').innerHTML = "::articles(edit)::";
		document.getElementById('inner').innerHTML = "";
		document.getElementById('temp').style.visibility = 'visible';
		document.getElementById('temp').innerHTML = "<i>loading...</i>";
		
		getdraftlist("edit");
	}
	
	function deleteart() {
		document.getElementById('title').innerHTML = "::articles(delete)::";		
		document.getElementById('inner').innerHTML = "";
		document.getElementById('temp').style.visibility = 'visible';
		document.getElementById('temp').innerHTML = "<i>loading...</i>";
		
		getdraftlist("delete");
	}
	
	function previewart() {
		document.getElementById('title').innerHTML = "::articles(preview)::";		
		document.getElementById('inner').innerHTML = "";
		document.getElementById('temp').style.visibility = 'visible';
		document.getElementById('temp').innerHTML = "<i>loading...</i>";

		getdraftlist("preview");
	}
	
	function chgpasswd() {
		var chgpwdArea = "<br><fieldset style=\"width: 300px;\"><legend>Password</legend><table width=300>"
			+ "<tr><td><label for=oldpass>Old Password:</label></td><td><input type=password id=oldpass name=oldpassr /></td></tr>"
        	+ "<tr><td><label for=pass>New Password:</label></td><td><input type=password id=pass name=pass /></td></tr>"
			+ "<tr><td><label for=repass>Reenter New Password:</label></td><td><input type=password id=repass name=repass /></td></tr>"
			+ "</table></fieldset>"
			+ "<input type=\"submit\" id=\"passwdbtn\" value=\"Change Password\" onClick=\"changepassword();\" style=\"font-weight: bold\" />"
			+ "<br><br>";
			
		document.getElementById('title').innerHTML = "::account(change password)::";
		document.getElementById('inner').innerHTML = chgpwdArea;
	}
	
	function chgemail() {
		var chgemailArea = "<br><fieldset style=\"width: 300px;\"><legend>Email Address</legend><div id=email>"
			+ "<input id=emailaddr name=emailaddr value=\"loading...\" size=\"40\" /><br>"
			+ "<input type=submit id=chgemailbtn value=\"Change Emaill Address\" onClick=\"chgemailaddr();\" style=\"font-weight: bold\" /><br>"
			+ "</div></fieldset><br>";
	
		document.getElementById('title').innerHTML = "::account(change email address)::";
		document.getElementById('inner').innerHTML = chgemailArea;
		document.getElementById('emailaddr').disabled = true;
		document.getElementById('chgemailbtn').disabled = true;
		
		getemailaddr();
	}
        
</script>
</head>
<body onLoad="main();">
<div id="main" style="width: 900px;	border-top: 1px solid #333333; border-right: 1px solid #333333; border-bottom: 1px solid #333333; border-left: 1px solid #333333;">
	<div id="title" style="text-indent: 10px; width: 100%; background-color: #7fb2df; color: #FFF; font-size: 12pt; letter-spacing: 2px; vertical-align: middle; line-height: 20pt;"></div>
	<div id="links" style="background-color: #7fb2df; width: 205px; color: #000; text-indent: 10px; font-size: 12pt; letter-spacing: 2px; vertical-align: middle; line-height: 20pt; border-top: 1px solid #000; border-right: 1px solid #000;"></div>
	<div id="inner" style="border-left: 10px solid #FFF; width: 100%;"></div>
	<div id="temp" style="border-left: 10px solid #FFF;"></div>
</div>
</body>
<?php
	}
?>
</html>
