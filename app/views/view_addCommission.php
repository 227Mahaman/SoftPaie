<?php
$title = "Ajout Commission";
ob_start();
$datas = "";
if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {
$id = $_GET['modif'];
$datas = file_get_contents(ROOT_PATH."index.php/getCommission/".$id);
$datas = json_decode($datas, true);
}
//$typeUser = file_get_contents(ROOT_PATH."index.php/getTypeUser");
//$types = json_decode($typeUser, true);
?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title"><?= $title;?></h3>
        <div class="row">
            <div class="col-md-12">
                <form role="form" method="post" enctype="multipart/form-data">
                <!-- INPUTS -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Renseigner les informations</h3>
                    </div>
                    <div class="panel-body">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i> Montant Début</span>
                            <input class="form-control" name="montant_debut" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['montant_debut'] : "" ?>" placeholder="Montant" type="text">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i> Montant Fin</span>
                            <input class="form-control" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['montant_fin'] : "" ?>" name="montant_fin" placeholder="Montant" type="text">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i> Frais</span>
                            <input class="form-control" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['frais'] : "" ?>" name="frais" placeholder="Frais de la commission" type="text">
                        </div>
                        <br>
                        <label for="">Taux</label>
                        <select class="form-control" name="type_user">
                            <option value="0">Sans taux</option>
                            <option value="1">Avec taux</option>
                        </select>
                        <br>
                    </div>
                    <div class="panel-footer">
						<button type="sumit" class="btn btn-primary btn-block">Ajouter</button>
                    </div>
                </div>
                <!-- END INPUTS -->
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>