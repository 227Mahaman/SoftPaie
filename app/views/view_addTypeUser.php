<?php
$title = "Ajout Type Utilisateur";
ob_start();
$datas = "";
if (!empty($_GET['modif']) && ctype_digit($_GET['modif'])) {
$id = $_GET['modif'];
//var_dump($id);
$datas = file_get_contents(ROOT_PATH."index.php/getTypeUser/".$id);
$datas = json_decode($datas, true);
//var_dump($datas);
}
?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title"><?= $title;?></h3>
        <div class="row">
            <div class="col-md-12">
                <form role="form" method="post" enctype="multipart/form-data">
                <!-- INPUTS -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Renseigner les informations</h3>
                    </div>
                    <div class="panel-body">
                        <div class="input-group">
                            <label for="">Label</label>
                            <span class="input-group-addon"><i class="fa fa-"></i></span>
                            <input class="form-control" name="label" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['label'] : "" ?>" placeholder="Label du type" type="text">
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="">Rôle</label>
                            <span class="input-group-addon"><i class="fa fa-"></i></span>
                            <input class="form-control" value="<?= (is_array($datas) || is_object($datas))? $datas['0']['role'] : "" ?>" name="role" placeholder="aaaaa@aaaa.com" type="text">
                        </div>
                        <br>
                    </div>
                    <div class="panel-footer">
						<button type="sumit" class="btn btn-primary btn-block">Ajouter</button>
                    </div>
                </div>
                <!-- END INPUTS -->
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>