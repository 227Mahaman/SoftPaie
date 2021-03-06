<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Se connecter</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
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
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="assets/img/logo.png" alt="Logo 2iSoft"></div>
								<p class="lead">Création de compte utilisateur</p>
							</div>
							<form class="form-auth-small" method="POST">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Pseudo</label>
									<input type="text" class="form-control" id="signin-email" name="pseudo" placeholder="Votre pseudo nom">
								</div>
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" id="signin-email" name="email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Mot de passe</label>
									<input type="password" class="form-control" id="signin-password" name="mot_pass" placeholder="Password">
								</div>
								<select name="type_user" class="form-control">
									<option value="2">Entreprise</option>
									<option value="3">Client</option>
								</select>
								<button type="submit" class="btn btn-primary btn-lg btn-block">Inscription</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-user"></i> J'ai déjà un compte, <a href="index.php?p=login">Me connecter</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Plateforme de paiement en ligne</h1>
							<p>par 2iSoft</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
