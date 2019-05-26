<head>
	<link rel="shortcut icon" href="../images/5696favicon.ico">
	<meta http-equiv="refresh" content="1680; URL=?">
    <title><?php echo $website_title; ?> | Service Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Wir sind eine Gruppe von jungen Menschen und Erwachsenen, die neue
											Grenzen setzen und in ihrer Freizeit am PC zocken. Seitdem das Zocken 
											in kleineren Gruppen uns zu langweilig wurde, entschieden wir uns
											eine Community aufzubauen und diese auf unserem Server zusammen zu bringen.">
    <meta name="keywords" content="ODK;TSODK;ODKTS;CG_ODK;Xteam_ODK">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="author" value="FlareCO">
	<meta name="publisher" value="Flare Media (Holdings), Corp.">
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="https://bootswatch.com/3/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="//bennys-ordenderkekse.de/assets/bootstrap-hover-dropdown.min.js"></script>
    <link rel="stylesheet" href="https://cdn.flareco.net/bootswatch/cosmo/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.flareco.net/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $website_url; ?>/assets/css/auth.bg.css"/>
</head>
<body>
	<div id="background">
		<img src="<?php echo $website_url; ?>/images/bgtest.png" class="stretch" alt="" />
	</div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $website_url; ?>/account/dashboard"><?php echo $website_title; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
				
                    <li><a href="<?php echo $website_url; ?>/account/infobuch">Schwarzbrett</a></li>
					<li><a href="<?php echo $website_url; ?>/account/catalog">Katalog</a></li>
					
					<ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">Aufträge (Privat)<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $website_url; ?>/account/rechner/privat">Auftragsrechner Privat</a></li>
                                <li><a href="<?php echo $website_url; ?>/account/aufträge/privat">Auftragsbuch Privat</a></li>
                            </ul>
                        </li>
                    </ul>
					
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="true">Aufträge (Staat)<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a disabled href="<?php echo $website_url; ?>/account/rechner/staat">Auftragsrechner Staat</a></li>
                                <li><a disabled href="<?php echo $website_url; ?>/account/aufträge/staat">Auftragsbuch Staat</a></li>
                            </ul>
                        </li>
                    </ul>
					
					<ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">Mitarbeiter & Urlaub<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo $website_url; ?>/account/members">Mitarbeiter Liste</a></li>
								<li><a href="<?php echo $website_url; ?>/account/vacation">Urlaubsplan</a></li>
                            </ul>
                        </li>
                    </ul>
					
					<li><a href="<?php echo $website_url; ?>/account/funk">Funk-Regeln</a></li>
					
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">Einstellungen<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo $website_url; ?>/account/profile">Persönliche Daten</a></li>
                                <li><a href="<?php echo $website_url; ?>/account/boss/panel">Chef Panel</a></li>
                                <li><a href="<?php echo $website_url; ?>/account/admin/panel">Admin Panel</a></li>
                            </ul>
                        </li>
                    </ul>
                </ul>

                <ul class="nav navbar-nav navbar-right">
					<li><a href="#"><i class="fa fa-star"></i> Rang: <?php echo $rank; ?></a></li>
                    <li><a href="<?php echo $website_url; ?>/account/logout"><i class="fa fa-power-off"></i> Feierabend</a></li>
                </ul>
            </div>
        </div>
    </nav>
	