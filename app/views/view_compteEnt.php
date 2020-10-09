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
$typeEnt = file_get_contents(ROOT_PATH."index.php/getTypeEntreprise");
$typeEnt = json_decode($typeEnt, true);
$identites = file_get_contents(ROOT_PATH."index.php/getIdentites");
$identites = json_decode($identites, true);
$pays = file_get_contents(ROOT_PATH."index.php/getPays");
$pays = json_decode($pays, true);
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
                            <h3 class="panel-title">Compte (Profil) Entreprise</h3>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-store">Nom</i></span>
                                <input class="form-control" name="nom" placeholder="Nom de l'entreprise" type="text">
							</div>
							<br>
                            <div class="input-group">
                                <input class="form-control" name="adresse" placeholder="Adresse de l'entreprise" type="text">
                                <span class="input-group-addon"><i class="fa fa-map">Adresse</i></span>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-store">Email</i></span>
                                <input class="form-control" name="email" placeholder="Email de l'entreprise" type="text">
							</div>
							<br>
                            <div class="input-group">
                                <input class="form-control" name="bp" placeholder="BP de l'entreprise" type="text">
                                <span class="input-group-addon"><i class="">BP</i></span>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tel">TEL</i></span>
                                <input class="form-control" name="tel" placeholder="TEL de l'entreprise" type="text">
							</div>
							<br>
                            <div class="input-group">
                                <input class="form-control" name="nidentite" placeholder="N°Identité du gérant de l'entreprise" type="text">
                                <span class="input-group-addon"><i class="">N°Identité</i></span>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tel">Référence</i></span>
                                <input class="form-control" name="reference" placeholder="Référence de l'entreprise" type="text">
							</div>
							<br>
                            <div class="input-group">
                                <input class="form-control" name="description" placeholder="Description de l'entreprise" type="text">
                                <span class="input-group-addon"><i class="">Description</i></span>
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tel">N°Registration</i></span>
                                <input class="form-control" name="nregistration" placeholder="N°Registration de l'entreprise" type="text">
							</div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-link">WebSite</i></span>
                                <input class="form-control" name="website" placeholder="Lien du Site de l'entreprise" type="text">
							</div>
							<br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="">Localisation</i></span>
                                <input class="form-control" name="localisation" placeholder="Localisation de l'entreprise" type="text">
							</div>
                            <br>
                            <label for="">Type de l'Entreprise</label>
                            <select class="form-control" name="type_entreprise">
                                <?php
                                    if(is_array($typeEnt) || is_object($typeEnt)) {
                                        foreach ($typeEnt as $value) {  
                                        ?>
                                        <option <?//= (is_array($datas) || is_object($datas))? ($value['id_entreprise'] == $datas['0']['type_entreprise'])? "selected" : "" : "" ?> value="<?= $value['id_entreprise']?>"><?= $value['libelle']?></option>
                                        <?php }
                                    }
                                ?>
                            </select>
                            <br>
                            <label for="">Type d'Identité</label>
                            <select class="form-control" name="identite">
                                <?php
                                    if(is_array($identites) || is_object($identites)) {
                                        foreach ($identites as $value) {  
                                        ?>
                                        <option <?//= (is_array($datas) || is_object($datas))? ($value['id_identite'] == $datas['0']['identite'])? "selected" : "" : "" ?> value="<?= $value['id_identite']?>"><?= $value['libelle']?></option>
                                        <?php }
                                    }
                                ?>
                            </select>
                            <br>
                            <label for="">Pays</label>
                            <select class="form-control" name="pays">
                                <?php
                                    if(is_array($pays) || is_object($pays)) {
                                        foreach ($pays as $value) {  
                                        ?>
                                        <option <?//= (is_array($datas) || is_object($datas))? ($value['id_pays'] == $datas['0']['pays'])? "selected" : "" : "" ?> value="<?= $value['id_pays']?>"><?= $value['nom']?></option>
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