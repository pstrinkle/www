<!--
  function validateForm() {
 
    var errorFree = true;
	
    if(isEmpty(document.getElementById('addr').value)) {
      errorFree = false;
    }
	
	if(!isEmailAddress(document.getElementById('addr').value)) {
      errorFree = false;
    }

    if (errorFree == true) {
	  document.getElementById('go').disabled = true;
      addemail();	
	}
	else {
	  alert('Please enter a valid email address');
	  document.getElementById('addr').value = 'newsletter';
	}
  }
  
  function isEmpty(val) {
    return val.length == 0;
  }
  
  function isEmailAddress(val) {
    return val.indexOf('@') != -1;
  }

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
  
  function addemail() {
    var addr = document.getElementById('addr').value;
    http.open('get', URL + addr);
    http.onreadystatechange = handleResponse;
    http.send(null);
  }
  
  function handleResponse() {
    if(http.readyState == 4) {
      var response = http.responseText;
	  document.getElementById('go').disabled = false; 
      document.getElementById('addr').value = 'newsletter';
	  document.getElementById('email').innerHTML = "<p class=\"yellow\">" + response + "</p>";
    }
  }
	
// -->