<?php
$title = "Ajout Utilisateur";
ob_start();
?>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <h3 class="page-title"><?= $title;?></h3>
        <div class="row">
            <div class="col-md-12">
                <form method="POST">
                <!-- INPUTS -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Renseigner les informations</h3>
                    </div>
                    <div class="panel-body">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" name="pseudo" placeholder="Pseudo de l'utilisateur" type="text">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control" name="email" placeholder="aaaaa@aaaa.com" type="text">
                        </div>
                        <br>
                        <label for="">Type utilisateur</label>
                        <select class="form-control">
                            <option value="cheese">Administrateur</option>
                            <option value="tomatoes">Entreprise</option>
                        </select>
                        <br>
                    </div>
                    <div class="panel-footer">
						<button type="button" class="btn btn-primary btn-block">Ajouter</button>
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