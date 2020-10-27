<!doctype html>
<html lang="en">

<head>
	<title>2iPaie</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.php?p=dashboard"><!--<img src="assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo">-->2iSoft | 2iPaie</a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Search dashboard...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
					</div>
				</form>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-circle" alt="Avatar"> <span><?= $_SESSION['user-auth']['pseudo'];?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="index.php?p=profil"><i class="lnr lnr-user"></i> <span>Mon Profile</span></a></li>
								<li><a href="index.php?p=deconnexion"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php?p=<?= ($_SESSION['user-auth']['typeUser'] == "Administrateur") ? 'dashBoard' : 'dashboard' ?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<?//php if($_SESSION['user-auth']['typeUser'] == "Administrateur"):?>
						<!--Vérifier si l'user a accès au menu de ce bloc_administration-->
						<?php if(sizeof($_SESSION['bloc_administration'])!=0):?>
						<li>
							<a href="#subPages1" data-toggle="collapse" class="collapsed"><i class="lnr lnr-flag"></i> <span>Administration</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages1" class="collapse ">
								<ul class="nav">
									<!--liens bloc "administration"-->
									<?php
									$id_current_group = 0;
									$tab_longueur = sizeof($_SESSION['bloc_administration']);
									for($i=0; $i<$tab_longueur; $i++) {
									$tab_simple = $_SESSION['bloc_administration'][$i];
									//condition d'ouverture d'un nouveau menu
									//if( $id_current_group != $tab_simple['id_groupe']){
									//if($id_current_group > 0)
									//	echo '</ul> </li>'; //fermeture du groupe precedent
									?>
									<?php if(!empty($tab_simple['libelle_action'])):?>
									<li><a href="index.php?p=<?= $tab_simple['url_action'];?>" class="<?= $tab_simple['icon_groupe']; ?>"><?= $tab_simple['libelle_action'];?></a></li>
									<?php endif;?>
									<?php
									$id_current_group = $tab_simple['id_groupe'];
									}//fin for
									?>
								</ul>
							</div>
						</li>
						<?php endif;?>
						<!--Vérifier si l'user a accès au menu de ce bloc_config-->
						<?php if(sizeof($_SESSION['bloc_config'])!=0):?>
						<li>
							<a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-briefcase"></i> <span>Configuration</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse ">
								<ul class="nav">
									<!--liens bloc "config"-->
									<?php
									$id_current_group = 0;
									$tab_longueur = sizeof($_SESSION['bloc_config']);
									for($i=0; $i<$tab_longueur; $i++) {
									$tab_config = $_SESSION['bloc_config'][$i];
									//condition d'ouverture d'un nouveau menu
									//if( $id_current_group != $tab_simple['id_groupe']){
									//if($id_current_group > 0)
									//	echo '</ul> </li>'; //fermeture du groupe precedent
									?>
									<?php if(!empty($tab_config['libelle_action'])):?>
										<li><a href="index.php?p=<?= $tab_config['url_action'];?>" class="<?= $tab_config['icon_groupe']; ?>"><?= $tab_config['libelle_action']; ?></a></li>
										<?php endif;?>
									<?php
									$id_current_group = $tab_config['id_groupe'];
									}//fin for
									?>
								</ul>
							</div>
						</li>
						<?//php endif;?>
						<?//php 
							//$_SESSION['user-auth']['typeUser'] == "Administrateur" || 
							//if($_SESSION['user-auth']['typeUser'] == "Entreprise"):?>
						<?php endif;?>
						<!--Vérifier si l'user a accès au menu de ce bloc_compte-->
						<?php if(sizeof($_SESSION['bloc_compte'])!=0):?>
						<li>
							<a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-store"></i> <span>Compte</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages3" class="collapse ">
								<ul class="nav">
									<!--liens bloc "compte"-->
									<?php
									$id_current_group = 0;
									$tab_longueur = sizeof($_SESSION['bloc_compte']);
									for($i=0; $i<$tab_longueur; $i++) {
									$tab_compte = $_SESSION['bloc_compte'][$i];
									//condition d'ouverture d'un nouveau menu
									//if( $id_current_group != $tab_simple['id_groupe']){
									//if($id_current_group > 0)
									//	echo '</ul> </li>'; //fermeture du groupe precedent
									?>
									<?php if(!empty($tab_compte['libelle_action'])):?>
										<li><a href="index.php?p=<?= $tab_compte['url_action'];?>" class="<?= $tab_compte['icon_action']; ?>"><?= $tab_compte['libelle_action']; ?></a></li>
									<!--<li><a href="index.php?p=transaction" class="">Transaction</a></li>
									<li><a href="index.php?p=solde" class="">Solde</a></li>
									<li><a href="index.php?p=paiement" class="">Page de paiement</a></li>-->
									<?php endif;?>
									<?php
									$id_current_group = $tab_compte['id_groupe'];
									}//fin for
									?>
								</ul>
							</div>
						</li>
						<?php endif;?>
						<!--Vérifier si l'user a accès au menu de ce bloc_parametre-->
						<?php if(sizeof($_SESSION['bloc_parametre'])!=0):?>
						<li>
							<a href="#subPages4" data-toggle="collapse" class="collapsed"><i class="lnr lnr-code"></i> <span>Paramètre</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages4" class="collapse ">
								<ul class="nav">
									<!--liens bloc "parametre"-->
									<?php
									$id_current_group = 0;
									$tab_longueur = sizeof($_SESSION['bloc_parametre']);
									for($i=0; $i<$tab_longueur; $i++) {
									$tab_parametre = $_SESSION['bloc_parametre'][$i];
									//condition d'ouverture d'un nouveau menu
									//if( $id_current_group != $tab_simple['id_groupe']){
									//if($id_current_group > 0)
									//	echo '</ul> </li>'; //fermeture du groupe precedent
									?>
									<?php if(!empty($tab_parametre['libelle_action'])):?>
										<li><a href="index.php?p=index.php?p=<?= $tab_parametre['url_action'];?>" class="<?= $tab_parametre['icon_action']; ?>"><?= $tab_parametre['libelle_action']; ?></a></li>
									<!--<li><a href="index.php?p=api_cle" class="">Api</a></li>
									<li><a href="index.php?p=#" class="">#</a></li>
									<li><a href="index.php?p=#" class="">#</a></li>-->
									<?php endif;?>
									<?php
									$id_current_group = $tab_parametre['id_groupe'];
									}//fin for
									?>
								</ul>
							</div>
						</li>
						<?//php endif;?>
						<?php endif;?>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
        <?php
            echo $content;
        ?>
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2020 <a href="https://www.2isoft.com" target="_blank">2iSoft</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
	<!--AJAX-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
	<script src="assets/scripts/data_handler.js"></script>
	<!--AJAX-->
	<script>
	$(function() {
		var data, options;

		// headline charts
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[23, 29, 24, 40, 25, 24, 35],
				[14, 25, 18, 34, 29, 38, 44],
			]
		};

		options = {
			height: 300,
			showArea: true,
			showLine: false,
			showPoint: false,
			fullWidth: true,
			axisX: {
				showGrid: false
			},
			lineSmooth: false,
		};

		new Chartist.Line('#headline-chart', data, options);


		// visits trend charts
		data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [{
				name: 'series-real',
				data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
			}, {
				name: 'series-projection',
				data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
			}]
		};

		options = {
			fullWidth: true,
			lineSmooth: false,
			height: "270px",
			low: 0,
			high: 'auto',
			series: {
				'series-projection': {
					showArea: true,
					showPoint: false,
					showLine: false
				},
			},
			axisX: {
				showGrid: false,

			},
			axisY: {
				showGrid: false,
				onlyInteger: true,
				offset: 0,
			},
			chartPadding: {
				left: 20,
				right: 20
			}
		};

		new Chartist.Line('#visits-trends-chart', data, options);


		// visits chart
		data = {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			series: [
				[6384, 6342, 5437, 2764, 3958, 5068, 7654]
			]
		};

		options = {
			height: 300,
			axisX: {
				showGrid: false
			},
		};

		new Chartist.Bar('#visits-chart', data, options);


		// real-time pie chart
		var sysLoad = $('#system-load').easyPieChart({
			size: 130,
			barColor: function(percent) {
				return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
			},
			trackColor: 'rgba(245, 245, 245, 0.8)',
			scaleColor: false,
			lineWidth: 5,
			lineCap: "square",
			animate: 800
		});

		var updateInterval = 3000; // in milliseconds

		setInterval(function() {
			var randomVal;
			randomVal = getRandomInt(0, 100);

			sysLoad.data('easyPieChart').update(randomVal);
			sysLoad.find('.percent').text(randomVal);
		}, updateInterval);

		function getRandomInt(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

	});
	</script>
</body>

</html>
