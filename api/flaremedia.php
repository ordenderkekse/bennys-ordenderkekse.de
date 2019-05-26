<?php

session_start();
include '../includes/config.php';
header('Content-Type: application/javascript');

?>

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function auth() {
  await sleep(2000);
  window.location.href = "<?php echo $website_url; ?>/account/dashboard";
}

$(document).ready(function() {        
	$("#login").click(function(event) {
		var user = document.getElementById("login-user").value;
		var password = document.getElementById("login-password").value;
		
		var data = "service=login&user=" + user + "&password=" + password;
		$.post( "/api/authentication.php", data, function( data ) {
		  var obj = JSON.parse(data);
		  if(obj.status === "error"){
			document.getElementById("login-event").innerHTML = '<center><p class="alert alert-danger">' + obj.message + '</p></center>';
		  }
		  if(obj.status === "success"){
			document.getElementById("login-event").innerHTML = '<center><p class="alert alert-success">' + obj.message + '</p></center>';
			auth();
		  }
		  console.log(data);
		});
		
		
	});
	
	$("#register").click(function(event) {
		var email = document.getElementById("email").value;
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;
		var repass = document.getElementById("repass").value;
		var agreement = document.getElementById("agreement").value;
		
		var data = "service=registration&email=" + email + "&username=" + username + "&password=" + password + "&repass=" + repass + "&agreement=checked";
		$.post( "/api/authentication.php", data, function( data ) {
		  var obj = JSON.parse(data);
		  if(obj.status === "error"){
			document.getElementById("register-event").innerHTML = '<center><p class="alert alert-danger">' + obj.message + '</p></center>';
		  }
		  if(obj.status === "success"){
			document.getElementById("register-event").innerHTML = '<center><p class="alert alert-success">' + obj.message + '</p></center>';
		  }
		  console.log(data);
		});
		
		
	});
	
});