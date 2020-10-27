<?php
$title = "Liste des Pays";
ob_start();
$datas = "";
if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {
$id = $_GET['modif'];
$datas = file_get_contents(ROOT_PATH."index.php/getPays/".$id);
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
                                <span class="input-group-addon"><i class="fa fa-code">Code</i></span>
                                <input class="form-control" name="code" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['code'] : "" ?>" placeholder="+/00 ..." type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-name">Nom</i></span>
                                <input class="form-control" name="nom" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['nom'] : "" ?>" placeholder="Nom du Pays" type="text">
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
                                    <th>Code</th>
                                    <th>Nom</th>
                                    <th>Date Création</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getAllPays");
                                $datas = json_decode($datas, true);
                                //var_dump($datas);
                                //die();
                                $i=0;
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {  
                                    ?>
                                <tr>
                                    <td><?= ++$i;?></td>
                                    <td><?= $value['code'];?></td>
                                    <td><?= $value['nom'];?></td>
                                    <td><?= $value['created_at'];?></td>
                                    <td>
                                        <a href="index.php?p=lstPays&modif=<?= $value['id_pays'] ?>" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form method="post">
                                            <input type="hidden" name="id_pays" value="<?= $value['id_pays'] ?>">
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