<?php
$title = "Module";
if (isset($_GET['role'])) extract($_GET);
$profil = file_get_contents(ROOT_PATH."index.php/getTypeUser/".$role);
$profil = json_decode($profil, true);
ob_start();
?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title"></h3>
        <div class="row">
            <div class="col-md-12">
                <!-- CONDENSED TABLE -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Données: <?= isset($_GET['role']) ? "Profil ".$profil['0']['label'] : 'Module' ?></h3>
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
                                        <a href="index.php?p=module&role=<?= $value['id_action'] ?>" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
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