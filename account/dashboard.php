<?php

session_start();
include '../includes/config.php';
include '../includes/hasPerms.php';
include '../includes/calculation.php';

include '../includes/header.authed.php';

?>
<meta http-equiv="refresh" content="1680; URL=?">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">
                        <center>Infomation</center>
                    </div>
                    <div class="panel panel-body">
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel panel-heading">
                                    <center>Aufträge Bearbeitet</center>
                                </div>
                                <div class="panel panel-body">
                                    <center>
                                        <p>
                                            <h3>Privat: <?php echo $total_orders_private; ?></h3>
										</p>
                                        <p>
                                            <h3>Staatlich: <?php echo $total_orders_staat; ?></h3>
										</p>
                                    </center>
                                </div>
                                <div class="panel-footer">
                                    <center>
                                        <p></p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel panel-heading">
                                    <center>Bestellungen</center>
                                </div>
                                <div class="panel panel-body">

                                    <center>
                                        <p>Aktuelle Bestellung</p>
										<p>Total : 0 $</p>
                                    </center>
                                    </br>
                                    <center>
									<a href="<?php echo $website_url; ?>/account/order/rechner" class="btn btn-primary">Bestellen</a>
									<a href="<?php echo $website_url; ?>/account/aufträge/order" class="btn btn-primary">Bestell-Liste</a>
                                    </center>
                                    </br>
                                </div>
                                <div class="panel-footer">
                                    <center>
                                        <p></p>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel panel-heading">
                                    <center>Firmen Gewinn</center>
                                </div>
                                <div class="panel panel-body">

                                    <center>
                                        <p><h2>Umsatz</h2></p>
                                    </center>
                                    <center>
										<h3>Total : <?php echo $profit; ?>$</h3>
                                    </center>

                                </div>
                                <div class="panel-footer">
                                    <center>
                                        <p></p>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reihe drunter-->

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">
                        <center>Team Chat</center>
                    </div>
                    <div class="panel panel-body">
                        <iframe src='https://minnit.chat/Bennys?embed&dark' width='100%' height='50%' style='border:none;' allowTransparency='true'></iframe>
                        <br>
                    </div>
					<div class="panel-footer">
						<center>
							<p><a href="<?php echo $website_url; ?>/account/changelogs">Alpha Version: <?php echo $version?></a></p>
						</center>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">
                        <center>Information</center>
                    </div>
                    <div class="panel panel-body">
					<center>		
						<p>Wichtig Infomation</p>
						</br>
						<h4>- Schränke 1-3 checken</h4>
							<p>• Farbdosen [rot, grün, blau, schwarz, weiß] - 50x</p>
							<p>• Felgenlack - 50x</p>
							<p>• Repairkits - 100x / 150x</p>
							<p>• Pumpen - 25x</p>
							<p>• Diagnosetools - 25x</p>
							<p>• Dieselmotoren - 5x</p>
							<p>• Kleidung [Arbeitshosen, Arbeits-Shirts orange, Arbeitsstiefel]</p>
							<p>• Eisen</p>
							<p>• Unterbodenbeleuchtungen - 40x / 50x</p>
							<p>• Fahrzeugschlösser - 40x / 50x</p>

						</br><h4>- Warenbestellungen</h4>
							<p>• rechtzeitig nachbestellen [bei Highway Express Logistic]</p>
							<p>• Bestellungen im Infobuch eintragen</p>

						</br><h4>- Kontostand überprüfen</h4>
							<p>• hoffen, dass das Geld reicht. Ansonsten bei mir melden...</p>

						</br><h4>- Alle Fahrzeuge checken</h4>
							<p>• tanken</p>
							<p>• Repairkits - 10x</p>
							<p>• Funkgerät 1x</p>
							<p>• Pumpe 1x</p>
							<p>• Messer 1x</p>
							<p>• Diagnosegerät 1x</p>
							<p>> XLS</p>
							<p>• Repairkits - 20x</p>
							<p>• Untebodenbeleuchtung - 2x</p>
							<p>• Fahrzeugschlösser - 2x</p>

						</br><h4>- Auftragsbücher pflegen</h4>
							<p>• Mitarbeiter auf's zeitige Eintragen hinweisen</p>
							<p>• Staatliche Aufträge überprüfen - fehlende Dienstnummer und Kennzeichen erfragen</p>

						</br><h4>- Präsenz zeigen</h4>
							<p>• Arbeitskleidung tragen</p>
							<p>• mit Dienstfahrzeugen fahren</p>
							<p>• Leistelle besetzen</p>
							<p>• in der Werkstatt präsent sein und Laufkundschaft empfangen</p>
							<p>• Kundenaquise - Hilfe anbieten, werben, Kontakte knüpfen</p>

						</br><h4>- Sicherheit</h4>
							<p>• Waffenverbot auf dem Gelände durchsetzen - Ausnahme "Brotherhood" / direkter Angriff</p>
							<p>• Schrittgeschwindigkeit auf dem Hof</p>
							<p>• Maskierungen in der Werkstatt nicht gerne gesehen</p>
							<p>• jeder Mitarbeiter hat das Haus - und Hofrecht</p>
					</center>
                    </div>
                </div>
            </div>
        </div>
    </div>
<body>
<?php
include '../includes/footer.php';
?>