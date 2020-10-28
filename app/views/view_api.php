<?php
$title = "Liste des API";
ob_start();
?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title"><?= $title;?></h3>
        <div class="row">
            <div class="col-md-12">
                <!-- CONDENSED TABLE -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Données</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Entreprise</th>
                                    <th>API</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getAPI");
                                $datas = json_decode($datas, true);
                                //var_dump($datas);
                                //die();
                                $i=0;
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {
                                        $datas = file_get_contents(ROOT_PATH."index.php/getEntreprise/".$value['id_entreprise']);
                                        $datas = json_decode($datas, true);
                                    ?>
                                <tr>
                                    <td><?= ++$i;?></td>
                                    <td><?= $datas['0']['nom'];?></td>
                                    <td><?= $value['apikey'];?></td>
                                    <td><?= $value['created_at'];?></td>
                                    <td>
                                        <a href="index.php?p=api&bloquer=<?= $value['id_cle'] ?>" class="btn btn-danger">
                                            <i class="fa fa-pencil"></i>
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