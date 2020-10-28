<?php
$title = "Génération ApiKey";
ob_start();
$id = $_SESSION['user-auth']['entreprise'];
$datas = file_get_contents(ROOT_PATH."index.php/getMyAPI/".$id);
$datas = json_decode($datas, true);
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
					<?php if(isset($datas) && $datas!=NULL):?>
						API généré :
						<p class="text-center"><a href="<?= $datas['0']['apikey'];?>" target="_blank"><?= $datas['0']['apikey'];?></a></p>
					<?php else :?>
					<form method="post">
						<input type="hidden" name="entreprise" value="<?= $_SESSION['user-auth']['entreprise'];?>">
						<p class="text-center"><button type="submit" class="btn btn-primary">Générer</button></p>
					</form>
					<?php endif;?>
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