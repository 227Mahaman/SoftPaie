<?php
$title = "Liste des Types d'entreprise";
ob_start();
$datas = "";
if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {
$id = $_GET['modif'];
$datas = file_get_contents(ROOT_PATH."index.php/getTypeEntps/".$id);
$datas = json_decode($datas, true);
}
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
                                <input class="form-control" name="libelle" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['libelle'] : "" ?>" placeholder="Libellé de l'entreprise" type="text">
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
                        <h3 class="panel-title">Données <?= $title;?></h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Libellé</th>
                                    <th>Date Création</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getTypeEntreprise");
                                $datas = json_decode($datas, true);
                                //var_dump($datas);
                                //die();
                                $i=0;
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {  
                                    ?>
                                <tr>
                                    <td><?= ++$i;?></td>
                                    <td><?= $value['libelle'];?></td>
                                    <td><?= $value['created_at'];?></td>
                                    <td>
                                        <a href="index.php?p=lstTypeEnt&modif=<?= $value['id_type_entreprise'] ?>" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form method="post">
                                            <input type="hidden" name="id_type_entreprise" value="<?= $value['id_type_entreprise'] ?>">
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