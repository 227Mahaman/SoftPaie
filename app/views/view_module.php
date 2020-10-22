<?php
$title = "Module";
// if (isset($_GET['role'])){
//     extract($_GET);
//     $profil = file_get_contents(ROOT_PATH."index.php/getTypeUser/".$role);
//     $profil = json_decode($profil, true);
//     //$actionProfil = file_get_contents(ROOT_PATH."index.php/getActionProfil/".$role);
//     //$actionProfil = json_decode($actionProfil, true);
// } else {
    //Récuperation des profils
    $profils = file_get_contents(ROOT_PATH."index.php/getTypeUser");
    $profils = json_decode($profils, true);
    $datas= '';
//}
ob_start();
?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title"></h3>
        <div class="row">
            <div class="col-md-4">
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Renseigner les informations</h3>
                        </div>
                        <div class="panel-body">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Libellé</i></span>
                                <input class="form-control" name="libelle_groupe" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['libelle_groupe'] : "" ?>" placeholder="Libellé du module (groupe)" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Icon</i></span>
                                <input class="form-control" name="icon_groupe" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['icon_groupe'] : "" ?>" placeholder="lnr lnr-icon / fa fa-icon" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Bloc</i></span>
                                <input class="form-control" name="bloc_menu" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['bloc_menu'] : "" ?>" placeholder="Bloc pour menu" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Ordre</i></span>
                                <input class="form-control" name="ordre_affichage_groupe" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['ordre_affichage_groupe'] : "" ?>" placeholder="Ordre d'affichage module" type="text">
                            </div>
                            <br>
                        </div>
                        <div class="panel-footer">
                            <button type="sumit" class="btn btn-primary btn-block">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <!-- CONDENSED TABLE -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Données: Module (GROUPE)</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Module</th>
                                    <th>Icon</th>
                                    <th>Bloc</th>
                                    <th>Ordre</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getModules");
                                $datas = json_decode($datas, true);
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {
                                    ?>
                                <tr>
                                    <td><?= $value['id_groupe'];?></td>
                                    <td><?= $value['libelle_groupe'];?></td>
                                    <td><?= $value['icon_groupe'];?></td>
                                    <td><?= $value['bloc_menu'];?></td>
                                    <td><?= $value['ordre_affichage_groupe'];?></td>
                                    <td>
                                        <a href="index.php?p=module&modif=<?= $value['id_groupe'] ?>" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="index.php?p=menu&module=<?= $value['id_groupe'] ?>" class="btn btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
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