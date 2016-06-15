<!--
  function validatelogin() {
 
    var errorFree = true;
	
    if(isEmpty(document.getElementById('user').value)) {
      errorFree = false;
    }
	
	if(isEmpty(document.getElementById('pass').value)) {
      errorFree = false;
    }
		
    if (errorFree == true) {
	  document.getElementById('login').value = "Log...";
      document.getElementById('login').disabled = true;
      login();	
    }
    else {
      alert('Invalid!');
    }
  }
  
  function isEmpty(val) {
    return val.length == 0;
  }

  var loginurl = "login.php";
 
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
 
  var httplogin = createRequestObject();
  var httplogout = createRequestObject();
  
  function login() {    
    var login = "user=" + encodeURIComponent(document.getElementById('user').value) + "&pass=" + encodeURIComponent(document.getElementById('pass').value);

    httplogin.onreadystatechange = handlelogin;
    httplogin.open('post',loginurl,true);
    httplogin.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    httplogin.setRequestHeader("Content-length", login.length);
    httplogin.setRequestHeader("Connection", "close");
    httplogin.send(login);
  }
  
  function handlelogin() {
    if(httplogin.readyState == 4) {
      if (httplogin.status == 200) {
        var loginresponse = httplogin.responseText;

        if (loginresponse == "") {
          alert('failed to login');
        }
		else {
		  document.getElementById('loggedin').innerHTML = "<p class=\"yellow\">Welcome, " + document.getElementById('user').value + "</p>";
 		  document.getElementById('login').innerHTML = "";
		}
      }
      else {
        alert('There was a problem with the request.');
      }
    }
  }
  
  function logout() {
    document.getElementById('logout').value = "...";
    document.getElementById('logout').disabled = true;
	
	document.cookie = "user" + "=" + "; expires=Thu, 01-Jan-70 00:00:01 GMT";
	
	document.getElementById('logout').style.visible = false;
	document.getElementById('loggedin').innerHTML = "";
	// should delete cookie
  }
	
// -->

