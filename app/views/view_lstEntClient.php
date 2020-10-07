<?php
$title = "Liste des Entreprises Clients";
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
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    <th>BP</th>
                                    <th>TEL</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getEntClients");
                                $datas = json_decode($datas, true);
                                //var_dump($datas);
                                //die();
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {  
                                    ?>
                                <tr>
                                    <td><?= $value['id_entreprise'];?></td>
                                    <td><?= $value['nom'];?></td>
                                    <td><?= $value['adresse'];?></td>
                                    <td><?= $value['email'];?></td>
                                    <td><?= $value['bp'];?></td>
                                    <td><?= $value['tel'];?></td>
                                    <td><?= $value['description'];?></td>
                                    <td><?= $value['created_at'];?></td>
                                    <td>
                                        <a href="index.php?action=addEntreprise&modif=<?= $value['id_entreprise'] ?>" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form method="post">
                                            <input type="hidden" name="id_entreprise" value="<?= $value['id_entreprise'] ?>">
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <!--<a href="index.php?action=lstUser&delete=<?//= $value['id'] ?>" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>-->
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