<?php
$title = "Module";
if (isset($_GET['role'])){
    extract($_GET);
    $profil = file_get_contents(ROOT_PATH."index.php/getTypeUser/".$role);
    $profil = json_decode($profil, true);
} else {
    //Récuperation des profils
    $profils = file_get_contents(ROOT_PATH."index.php/getTypeUser");
    $profils = json_decode($profils, true);
    $datas= '';
}
ob_start();
?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title"></h3>
        <div class="row">
            <?php if (!isset($_GET['role'])) : ?>
            <div class="col-md-4">
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Renseigner les informations</h3>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Libellé</i></span>
                                <input class="form-control" name="libelle_action" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['libelle_action'] : "" ?>" placeholder="Libellé du module (action)" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Description</i></span>
                                <input class="form-control" name="description_action" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['description_action'] : "" ?>" placeholder="Description du module" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">URL</i></span>
                                <input class="form-control" name="url_action" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['url_action'] : "" ?>" placeholder="URL du module" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Ordre</i></span>
                                <input class="form-control" name="ordre_affichage_action" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['ordre_affichage_action'] : "" ?>" placeholder="Ordre d'affichage d'action" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Icon</i></span>
                                <input class="form-control" name="icon_action" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['icon_action'] : "" ?>" placeholder="lnr lnr-icon / fa fa-icon" type="text">
                            </div>
                            <br>
                            <label for="profil">Profil</label>
                            <select class="form-control" name="type_user">
                                <?php
                                    if(is_array($profils) || is_object($profils)) {
                                        foreach ($profils as $value) {  
                                        ?>
                                        <option <?= (is_array($datas) || is_object($datas))? ($value['id_typeuser'] == $datas['0']['type_user'])? "selected" : "" : "" ?> value="<?= $value['id_typeuser']?>"><?= $value['label']?></option>
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
            </div>
            <?php endif; ?>
            <div class="<?= (isset($_GET['role'])) ? 'col-md-12' : 'col-md-8' ?>">
                <!-- CONDENSED TABLE -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Module: <?= isset($_GET['role']) ? "Profil ".$profil['0']['label'] : 'Module' ?></h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Module</th>
                                    <th>Description</th>
                                    <th>Date Création</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getActions");
                                $datas = json_decode($datas, true);
                                //var_dump($datas);
                                //die();
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {  
                                    ?>
                                <tr>
                                    <td><?= $value['id_action'];?></td>
                                    <td><?= $value['libelle_action'];?></td>
                                    <td><?= $value['description_action'];?></td>
                                    <td><?= $value['created_at'];?></td>
                                    <td>
                                        <?php if (!isset($_GET['role'])) : ?>
                                            <a href="index.php?p=module&modif=<?= $value['id_action'] ?>" class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        <?php else : ?>
                                            <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                <label>
                                                    <input class="module_is_checked" onchange="addPermissionRole(this)" value="<?= $value['id_action'] ?>" type="checkbox" <?= ($value['id_groupe']==$role) ? 'checked' : '';?>> ajouter au profil
                                                </label>
                                                </div>
                                            </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                    <?php }
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END CONDENSED TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->
<?php
$content = ob_get_clean();
require('template.php');
?>