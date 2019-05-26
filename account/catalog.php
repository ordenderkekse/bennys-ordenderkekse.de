<?php
session_start();
include '../includes/config.php';
include '../includes/hasPerms.php';

include '../includes/header.authed.php';

?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="panel panel-primary">
					<center>
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#home" data-toggle="tab">Preislist</a>
							</li>
							<li>
								<a href="#farben" data-toggle="tab">Farbenkatalog</a>
							</li>
							<li>
								<a href="#sport" data-toggle="tab">Sport-Felgen</a>
							</li>
							<li>
								<a href="#muscle" data-toggle="tab">Muscle-Felgen</a>
							</li>
							<li>
								<a href="#lowrider" data-toggle="tab">Lowrider-Felgen</a>
							</li>
							<li>
								<a href="#suv" data-toggle="tab">SUV-Felgen</a>
							</li>
							<li>
								<a href="#offroad" data-toggle="tab">Offroad-Felgen</a>
							</li>
							<li>
								<a href="#tuner" data-toggle="tab">TunerFelgen</a>
							</li>
							<li>
								<a href="#highEnd" data-toggle="tab">HighEnd-Felgen</a>
							</li>
							<li>
								<a href="#lack" data-toggle="tab">Felgen-Lack</a>
							</li>
						</ul>
					</center>

					<div class="tab-content tpl-tabs-cont">
						<div class="tab-pane fade active in" id="home">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="home">
										<div class="container relative">
											<iframe width="100%" height="80%" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vRUaLEcg58hjDPKswaBSwreHaMx7vlVSpx9d0owGs8LSXNSHkGt30ey-Jnwputg5CwdZ0KzuxAkuoGj/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false"></iframe>
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="farben">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="farben">
										<div class="container relative">
											<iframe width="100%" height="100%" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vRUaLEcg58hjDPKswaBSwreHaMx7vlVSpx9d0owGs8LSXNSHkGt30ey-Jnwputg5CwdZ0KzuxAkuoGj/pubhtml?gid=1392710969&amp;single=true&amp;widget=true&amp;headers=false">"</iframe>
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="lack">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="lack">
										<div class="container relative">
											<img src="https://bennys-ordenderkekse.de/images/catalog/Farbkatalog.png" alt="felgen-lack face" height="100%" width="100%">
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="highEnd">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="highEnd">
										<div class="container relative">
											<img src="https://bennys-ordenderkekse.de/images/catalog/HighEnd.png" alt="felgen-lack face" height="100%" width="100%">
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="sport">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="sport">
										<div class="container relative">
											<img src="https://bennys-ordenderkekse.de/images/catalog/Sport.png" alt="felgen-lack face" height="100%" width="100%">
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="muscle">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="muscle">
										<div class="container relative">
											<img src="https://bennys-ordenderkekse.de/images/catalog/Muscle.png" alt="felgen-lack face" height="100%" width="100%">
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="lowrider">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="lowrider">
										<div class="container relative">
											<img src="https://bennys-ordenderkekse.de/images/catalog/Lowrider.png" alt="felgen-suv" height="100%" width="100%">
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="suv">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="suv">
										<div class="container relative">
											<img src="https://bennys-ordenderkekse.de/images/catalog/SUV.png" alt="felgen-suv" height="100%" width="100%">
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="offroad">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="offroad">
										<div class="container relative">
											<img src="https://bennys-ordenderkekse.de/images/catalog/Offroad.png" alt="felgen-offroad" height="100%" width="100%">
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="tuner">
							<div class="section-images">
								<div class="row">
									<section class="page-section" id="tuner">
										<div class="container relative">
											<img src="https://bennys-ordenderkekse.de/images/catalog/Tuner.png" alt="felgen-tuner" height="100%" width="100%">
										</div>
									</section>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>
<?php
include '../includes/footer.php';
?>