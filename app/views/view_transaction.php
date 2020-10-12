<?php
$title = "Transactions";
ob_start();
?>
<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <!--<div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Weekly Overview</h3>
                <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-download"></i></span>
                            <p>
                                <span class="number">1,252</span>
                                <span class="title">Downloads</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                            <p>
                                <span class="number">203</span>
                                <span class="title">Sales</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-eye"></i></span>
                            <p>
                                <span class="number">274,678</span>
                                <span class="title">Visits</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-bar-chart"></i></span>
                            <p>
                                <span class="number">35%</span>
                                <span class="title">Conversions</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div id="headline-chart" class="ct-chart"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="weekly-summary text-right">
                            <span class="number">2,315</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 12%</span>
                            <span class="info-label">Total Sales</span>
                        </div>
                        <div class="weekly-summary text-right">
                            <span class="number">$5,758</span> <span class="percentage"><i class="fa fa-caret-up text-success"></i> 23%</span>
                            <span class="info-label">Monthly Income</span>
                        </div>
                        <div class="weekly-summary text-right">
                            <span class="number">$65,938</span> <span class="percentage"><i class="fa fa-caret-down text-danger"></i> 8%</span>
                            <span class="info-label">Total Income</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- END OVERVIEW -->
        <div class="row">
            <div class="col-md-12">
                <!-- RECENT PURCHASES -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Les <?= $title;?> effectuées sur mon compte</h3>
                        <!--<div class="right">
                            <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                        </div>-->
                    </div>
                    <div class="panel-body no-padding">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Numéro client</th>
                                    <th>Montant</th>
                                    <th>Date &amp; Heure</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$id = $_SESSION['user-auth']['entreprise'];
                                $datas = file_get_contents(ROOT_PATH."index.php/getMyTransaction/".$id);
                                $datas = json_decode($datas, true);
                                if (is_array($datas) || is_object($datas)) {
                                    foreach ($datas as $value) {  
                                    ?>
                                    <tr>
                                        <td><a href="#"><?= $value['id_transaction'];?></a></td>
                                        <td><?= $value['codeclient'];?></td>
                                        <td><?= $value['montant_transaction'];?> FCFA</td>
                                        <td><?= $value['created_at'];?></td>
                                        <?php if($value['statut'] == 1){?>
                                            <td><span class="label label-success">Succès</span></td>
                                        <?php } else {?>
                                            <td><span class="label label-danger">Echec</span></td>
                                        <?php }?>
                                    </tr>
                                    <?php }
                                }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Tout</span></div>
                            <div class="col-md-6 text-right"><a href="#" class="btn btn-primary">Transactions</a></div>
                        </div>
                    </div>
                </div>
                <!-- END RECENT PURCHASES -->
            </div>
            <!--<div class="col-md-6">-->
                <!-- MULTI CHARTS -->
                <!--<div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Projection vs. Realization</h3>
                        <div class="right">
                            <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="visits-trends-chart" class="ct-chart"></div>
                    </div>
                </div>-->
                <!-- END MULTI CHARTS -->
            <!--</div>-->
        </div>
        
    </div>
</div>
<!-- END MAIN CONTENT -->
<?php
$content = ob_get_clean();
require('template.php');
?>