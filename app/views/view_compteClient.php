<?php
$title = "Compte Entreprise";
ob_start();
$datas = "";
if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {
$id = $_GET['modif'];
//var_dump($id);
$datas = file_get_contents(ROOT_PATH."index.php/getUser/".$id);
$datas = json_decode($datas, true);
//var_dump($datas);
}
$sta = file_get_contents(ROOT_PATH."index.php/getStas");
$sta = json_decode($sta, true);
?>
<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <div class="panel panel-profile">
            <div class="clearfix">
                <!-- INPUT GROUPS -->
                <form method="post">
					<div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Compte Client</h3>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Nom</i></span>
                                <input class="form-control" name="nom" placeholder="Nom du client" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <input class="form-control" name="prenom" placeholder="Prénom du client" type="text">
                                <span class="input-group-addon"><i class="fa fa-">Prénom</i></span>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tel">TEL</i></span>
                                <input class="form-control" name="tel" placeholder="TEL du client" type="text">
							</div>
							<br>
                            <div class="input-group">
                                <input class="form-control" name="adresse" placeholder="Adresse du client" type="text">
                                <span class="input-group-addon"><i class="fa fa-">Adresse</i></span>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-store">Email</i></span>
                                <input class="form-control" name="email" placeholder="Email du client" type="text">
							</div>
                            <br>
                            <label for="">Société de Transfert d'Argent</label>
                            <select class="form-control" name="id_sta">
                                <?php
                                    if(is_array($sta) || is_object($sta)) {
                                        foreach ($sta as $value) {  
                                        ?>
                                        <option <?//= (is_array($datas) || is_object($datas))? ($value['id_pays'] == $datas['0']['pays'])? "selected" : "" : "" ?> value="<?= $value['id_sta']?>"><?= $value['nom']?></option>
                                        <?php }
                                    }
                                ?>
                            </select>
                            <br>
                        </div>
                        <div class="panel-footer">
						    <button type="sumit" class="btn btn-primary btn-block">Ajouter</button>
                        </div>
                    </div>
                </form>
                <!-- END INPUT GROUPS -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->
<?php
$content = ob_get_clean();
require('template.php');
?>