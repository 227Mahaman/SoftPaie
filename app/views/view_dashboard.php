<?php
$title = "Dashboard";
ob_start();
$id =  $_SESSION['user-auth']['entreprise'];
$datas = file_get_contents(ROOT_PATH."index.php/getSolde/".$id);
$datas = json_decode($datas, true);
?>
<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Weekly Overview</h3>
                <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-money"></i></span>
                            <p>
                                <span class="number"><?= $datas['0']['solde'];?> FCFA</span>
                                <span class="title">Solde</span>
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
        </div>
        <!-- END OVERVIEW -->
        <div class="row">
            <div class="col-md-6">
                <!-- RECENT PURCHASES -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Recent Purchases</h3>
                        <div class="right">
                            <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                        </div>
                    </div>
                    <div class="panel-body no-padding">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order No.</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date &amp; Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#">763648</a></td>
                                    <td>Steve</td>
                                    <td>$122</td>
                                    <td>Oct 21, 2016</td>
                                    <td><span class="label label-success">COMPLETED</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#">763649</a></td>
                                    <td>Amber</td>
                                    <td>$62</td>
                                    <td>Oct 21, 2016</td>
                                    <td><span class="label label-warning">PENDING</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#">763650</a></td>
                                    <td>Michael</td>
                                    <td>$34</td>
                                    <td>Oct 18, 2016</td>
                                    <td><span class="label label-danger">FAILED</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#">763651</a></td>
                                    <td>Roger</td>
                                    <td>$186</td>
                                    <td>Oct 17, 2016</td>
                                    <td><span class="label label-success">SUCCESS</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#">763652</a></td>
                                    <td>Smith</td>
                                    <td>$362</td>
                                    <td>Oct 16, 2016</td>
                                    <td><span class="label label-success">SUCCESS</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 24 hours</span></div>
                            <div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All Purchases</a></div>
                        </div>
                    </div>
                </div>
                <!-- END RECENT PURCHASES -->
            </div>
            <div class="col-md-6">
                <!-- MULTI CHARTS -->
                <div class="panel">
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
                </div>
                <!-- END MULTI CHARTS -->
            </div>
        </div>
        
    </div>
</div>
<!-- END MAIN CONTENT -->
<?php
$content = ob_get_clean();
require('template.php');
?>