<?php
$title = "Liste des Commissions";
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
                                    <th>Montant début</th>
                                    <th>Montant fin</th>
                                    <th>Frais</th>
                                    <th>Taux</th>
                                    <th>Date Création</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getCommissions");
                                $datas = json_decode($datas, true);
                                //var_dump($datas);
                                //die();
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {  
                                    ?>
                                <tr>
                                    <td><?= $value['id_commission'];?></td>
                                    <td><?= $value['montant_debut'];?> F</td>
                                    <td><?= $value['montant_fin'];?> F</td>
                                    <td><?= $value['frais'];?> F</td>
                                    <td><?= $value['taux'];?> %</td>
                                    <td><?= $value['created_at'];?></td>
                                    <td>
                                        <a href="index.php?p=addCommission&modif=<?= $value['id_commission'] ?>" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form method="post">
                                            <input type="hidden" name="id_commission" value="<?= $value['id_commission'] ?>">
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
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