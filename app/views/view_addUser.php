<?php
$title = "Ajout Utilisateur";
ob_start();
$datas = "";
if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {
$id = $_GET['modif'];
//var_dump($id);
$datas = file_get_contents(ROOT_PATH."index.php/getUser/".$id);
$datas = json_decode($datas, true);
//var_dump($datas);
}
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
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" name="pseudo" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['pseudo'] : "" ?>" placeholder="Pseudo de l'utilisateur" type="text">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['email'] : "" ?>" name="email" placeholder="aaaaa@aaaa.com" type="text">
                        </div>
                        <br>
                        <label for="">Type utilisateur</label>
                        <select class="form-control" name="type_user">
                            <option value="1">Administrateur</option>
                            <option value="2">Entreprise</option>
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