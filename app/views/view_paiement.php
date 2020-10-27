<?php
$title = "Page de Paiement";
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
                                    <th>Order No.</th>
                                    <th>Numéro client</th>
                                    <th>Montant</th>
                                    <th>Date &amp; Heure</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getMyPaiement/".$id);
                                $datas = json_decode($datas, true);
                                $i = 0;
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {
                                        $client =  file_get_contents(ROOT_PATH."index.php/getClient/".$value['id_client']);
                                        $client = json_decode($client, true);
                                    ?>
                                    <tr>
                                        <td><a href="#"><?= ++$i;?></a></td>
                                        <td><?= $client['0']['tel'];?></td>
                                        <td><?= $value['montant_transaction'];?> FCFA</td>
                                        <td><?= $value['created_at'];?></td>
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