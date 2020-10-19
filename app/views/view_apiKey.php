<?php
$title = "Génération ApiKey";
ob_start();
?>

<div class="main-content">
	<div class="container-fluid">
		<h3 class="page-title"></h3>
		<div class="panel panel-headline">
			<div class="panel-body">
				<p><code><?= $title;?></code></p>
				<p class="lead">L'api à utiliser sur votre plateforme.</p>
				<hr>
				<div class="well">
					<form method="post">
					<p class="text-center"><button type="submit" class="btn btn-primary">Générer</button></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END MAIN CONTENT -->
<?php
$content = ob_get_clean();
require('template.php');
?>