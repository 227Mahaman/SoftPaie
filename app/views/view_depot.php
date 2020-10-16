<?php
$title = "Liste Société de Transfert d'Argent";
ob_start();
$datas = "";
if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {
$id = $_GET['modif'];
$datas = file_get_contents(ROOT_PATH."index.php/getSta/".$id);
$datas = json_decode($datas, true);}
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
                                <span class="input-group-addon"><i class="fa fa-">Nom</i></span>
                                <input class="form-control" name="nom" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['nom'] : "" ?>" placeholder="Nom" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Adresse</i></span>
                                <input class="form-control" name="adresse" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['adresse'] : "" ?>" placeholder="adresse" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">Email</i></span>
                                <input class="form-control" name="email" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['email'] : "" ?>" placeholder="email@email.com" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-number">Tel</i></span>
                                <input class="form-control" name="tel" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['tel'] : "" ?>" placeholder="tel" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-">BP</i></span>
                                <input class="form-control" name="bp" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['bp'] : "" ?>" placeholder="bp" type="text">
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
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    <th>Tel</th>
                                    <th>BP</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datas = file_get_contents(ROOT_PATH."index.php/getStas");
                                $datas = json_decode($datas, true);
                                //var_dump($datas);
                                //die();
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {  
                                    ?>
                                <tr>
                                    <td><?= $value['id_sta'];?></td>
                                    <td><?= $value['nom'];?></td>
                                    <td><?= $value['adresse'];?></td>
                                    <td><?= $value['email'];?></td>
                                    <td><?= $value['tel'];?></td>
                                    <td><?= $value['bp'];?></td>
                                    <td><?= $value['created_at'];?></td>
                                    <td>
                                        <a href="index.php?p=sta&modif=<?= $value['id_sta'] ?>" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form method="post">
                                            <input type="hidden" name="id_sta" value="<?= $value['id_sta'] ?>">
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