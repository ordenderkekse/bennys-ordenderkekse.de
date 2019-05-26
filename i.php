<?php

session_start();
include 'includes/config.php';

if(isset($_SESSION['token'])){
	header("Location: $website_url/account/dashboard");
	exit;
}


?>
<!---------------------------------------------------------------------------------
  __  __           _        _             ______ _                 _____ ____  
 |  \/  |         | |      | |           |  ____| |               / ____/ __ \ 
 | \  / | __ _  __| | ___  | |__  _   _  | |__  | | __ _ _ __ ___| |   | |  | |
 | |\/| |/ _` |/ _` |/ _ \ | '_ \| | | | |  __| | |/ _` | '__/ _ \ |   | |  | |
 | |  | | (_| | (_| |  __/ | |_) | |_| | | |    | | (_| | | |  __/ |___| |__| |
 |_|  |_|\__,_|\__,_|\___| |_.__/ \__, | |_|    |_|\__,_|_|  \___|\_____\____/ 
                                   __/ |                                       
                                  |___/                                        
Company: Flare Media (Holdings) Corp. [US].
Support: support@flareco.net
Contact: https://www.flareco.net/legal/contact-us
Impressum: https://www.flareco.net/legal/imprint
Spenden: https://www.flareco.net/donate

--------------------------------------------------------------------------------->
<head>
	<link rel="shortcut icon" href="images/5696favicon.ico">
	<title><?php echo $website_title; ?> - Authentication</title>
	<meta name="author" value="FlareCO">
	<meta name="publisher" value="Flare Media (Holdings), Corp.">
	<link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.css"/>
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="https://bootswatch.com/3/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo $website_url; ?>/assets/css/auth.bg.css"/>
</head>
<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="/"><?php echo $website_title; ?></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="<?php echo $website_url; ?>">Home</a></li>
		  </ul>
		</div>
	  </div>
	</nav>
	<div id="background">
		<img src="<?php echo $website_url; ?>/images/bgtest.png" class="stretch" alt=""/>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel panel-heading"><center>Authentication</center></div>
					<div class="panel panel-body">
						<center>
						<div class="alert alert-dismissible alert-info">
							<strong>Admin Login</strong></a>
						</div>
						</center>
						<ul class="nav nav-tabs">
							<li class="active"><a href="#login-modal" data-toggle="tab">Login</a></li>
							<li><a href="#register-modal" data-toggle="tab">Register</a></li>
						</ul>
						</br>
						<div class="tab-content tpl-tabs-cont">
							<div class="tab-pane fade active in" id="login-modal">
								<center><img src="<?php echo $website_url; ?>/images/bennys.png" width="35%"></center>
								</br>
								<?php if($login_status == "disabled"){ ?>
									<div id="event"><center><p class="alert alert-danger">Login Deaktiviert</p></center></div>
								<?php } else { ?>
									<div id="login-event"></div>
									<form action="<?php echo $website_url; ?>/api/authentication.php" method="POST">
										<input type="hidden" name="service" value="login">
										<div class="form-group">
											<label>Email or Name</label>
											<input type="text" value="" name="user" id="login-user" class="form-control"/>
										</div>
										
										<div class="form-group">
											<label>Password</label>
											<input type="password" name="password" value="" id="login-password" class="form-control"/>
										</div>
										
										<div class="form-group">
											<center><a href="#" class="btn btn-success login" id="login">Login</a></center>
										</div>
									</form>
								<?php } ?>
							</div>
							<div class="tab-pane fade" id="register-modal">
								<center><img src="<?php echo $website_url; ?>/images/bennys.png" width="35%"></center>
								</br>
								<?php if($register_status == "disabled"){ ?>
									<div id="event"><center><p class="alert alert-danger">Registration Deaktiviert</p></center></div>
								<?php } else { ?>
									<div id="register-event"></div>
									<form action="<?php echo $website_url; ?>/api/authentication.php" method="POST">
									
										<div class="form-group">
											<label>Email</label>
											<input type="email" value="" id="email" class="form-control"/>
										</div>
									
										<div class="form-group">
											<label>Name</label>
											<input type="text" value="" id="username" class="form-control"/>
										</div>
										
										<div class="form-group">
											<label>Password</label>
											<input type="password" value="" id="password" class="form-control"/>
										</div>
										
										<div class="form-group">
											<label>Re-Type Password</label>
											<input type="password" value="" id="repass" class="form-control"/>
										</div>
									
										<div class="form-group">
											<input type="checkbox" type="text" id="agreement" name="agreement"> <font color="red">*</font>I agree to the <a href="https://ordenderkekse.de/pages/terms.php" target="_blank">Terms of Services</a>, <a href="https://ordenderkekse.de/pages/privacy.php" target="_blank">Privacy Policy</a> and to the <a href="https://www.flareco.net/legal/developer-agreement" target="_blank">Developer</a> Agreement.</input>
										</div>
										
										<div class="form-group">
											<center><a href="#" class="btn btn-success register" id="register">Register</a></center>
										</div>
									</form>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="panel panel-footer"><center>Service provided by <a href="https://ordendenderkekse.de/pages/impressum.php" target="_blank">ODK</a> | Development by <a href="https://www.flareco.net/legal/contact-us" target="_blank">FlareCO</a></center></div>
				</div>
				<center><a href="https://www.flareco.net/donate?amount=2.00" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/black_img.png" alt="Buy Me A Coffee" style="height: auto !important;width: auto !important;" ></a></center>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
	<div id="scripts">
		<script src="<?php echo $website_url; ?>/api/flaremedia.php?token=<?php echo hash("sha1", md5(time().rand("1", "99999999").".flareco.net")); ?>"></script>
	</div>
</body>