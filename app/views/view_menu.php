<?php
$title = "Menu (Action)";
if (isset($_GET['module'])){
    extract($_GET);
    $module = file_get_contents(ROOT_PATH."index.php/getModule/".$module);
    $module = json_decode($profil, true);
} elseif (isset($_GET['role'])){//Rôle (Profil)
    extract($_GET);
    $profil = file_get_contents(ROOT_PATH."index.php/getTypeUser/".$role);
    $profil = json_decode($profil, true);
    if(!empty($_POST)){
        $data = $_POST;
        $url = ROOT_PATH."index.php/addMenuToProfil/".$role;
        $add = App::file_post_contents($url, $data);
        var_dump($add);die;
        if($add){
            header('Location: index.php?p=menu&role='.$role);
        }
    }
    //$actionProfil = file_get_contents(ROOT_PATH."index.php/getActionProfil/".$role);
    //$actionProfil = json_decode($actionProfil, true);
} elseif(!empty($_GET['modif']) && ctype_digit($_GET['modif'])){
    $id = $_GET['modif'];
    $datas = file_get_contents(ROOT_PATH."index.php/getMenu/".$id);
    $datas = json_decode($datas, true);
} else {
    $datas= '';
}
//Récuperation des modules
$modules = file_get_contents(ROOT_PATH."index.php/getModules");
$modules = json_decode($modules, true);
ob_start();
?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title"></h3>
        <div class="row">
            <?php if (!isset($_GET['module']) && !isset($_GET['role'])) : ?>
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
                            <label for="profil">Module (Groupe)</label>
                            <select class="form-control" name="id_groupe">
                                <?php
                                    if(is_array($modules) || is_object($modules)) {
                                        foreach ($modules as $value) {  
                                        ?>
                                        <option <?= (is_array($datas) || is_object($datas))? ($value['id_groupe'] == $datas['0']['id_groupe'])? "selected" : "" : "" ?> value="<?= $value['id_groupe']?>"><?= $value['libelle_groupe']?></option>
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
                        <h3 class="panel-title">Menu: <?= isset($_GET['role']) ? "Profil ".$profil['0']['label'] : '' ?></h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getActions");
                                $datas = json_decode($datas, true);
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {
                                        if(isset($_GET['role'])){//Vérification
                                            $actProfil = file_get_contents(ROOT_PATH."index.php/getActionProfil/".$value['id_action']."/".$role);
                                            $actProfil = json_decode($actProfil, true);
                                        }
                                    ?>
                                <tr>
                                    <td><?= $value['id_action'];?></td>
                                    <td><?= $value['libelle_action'];?></td>
                                    <td><?= $value['description_action'];?></td>
                                    <td><?= $value['url_action'];?></td>
                                    <td>
                                        <?php if (isset($_GET['role'])) : ?>
                                            <form method="post">
                                            <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                <label>
                                                    <input type="hidden" name="profil" value="<?= $_GET['role']; ?>">
                                                    <!-- name="menu" onchange="submit()" -->
                                                    <input class="module_is_checked" onchange="addMenuRole(this)" value="<?= $value['id_action'] ?>" type="checkbox" <?//= (isset($actProfil['0']['id_action']) && $actProfil['0']['id_action']==$value['id_action']) ? 'checked' : '';?> > ajouter au profil
                                                </label>
                                                </div>
                                            </div>
                                            </div>
                                            </form>
                                        <?php else : ?>
                                            <a href="index.php?p=menu&modif=<?= $value['id_action'] ?>" class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form method="post">
                                                <input type="hidden" name="id_action" value="<?= $value['id_action'] ?>">
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
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