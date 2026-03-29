<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 >The Dashboard</h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=""><?php 
                    
                    if(USER_ROLE==5 || USER_ROLE==3  || USER_ROLE==1 || USER_ROLE==4 || USER_ROLE==8){ 
                        ?>
                        <h2>CC- Application Form</h2>
                        <br>
                        <?php
                        $jei=new User_infoController();
                        $db=$jei->GetModel();
$whereWard = "";
if (USER_ROLE != 8 && USER_ROLE != 1) {
    $wards = explode(",", get_active_user("ward"));
    $wards = array_map('trim', $wards);
    $whereWard = " AND ward IN ('" . implode("','", $wards) . "')";
}

$sql = "
    SELECT
        ward,
        CASE
            WHEN status = 1 THEN 'auth1'
            WHEN status = 2 THEN 'auth2'
            WHEN (status = 3 AND paid != '') OR status = 4 THEN 'auth3'
            WHEN (status = 3 AND paid = '')  THEN 'auth3cp'
            WHEN status = 5 THEN 'completed'
            WHEN status = -2 THEN 'reverted'
            WHEN status = -1 THEN 'rejected'
            WHEN status = 0 THEN 'citizen'
        END AS bucket,
        COUNT(id) AS c
    FROM application_form
    WHERE 1=1
    $whereWard
    GROUP BY ward, bucket
";

$records = $db->rawQuery($sql);


/* Re-arrange data ward-wise */ 
$report = [];
foreach ($records as $r) {
    $ward   = $r['ward'];
    $bucket = $r['bucket'];
    $count  = (int)$r['c'];

    if (!isset($report[$ward])) {
        $report[$ward] = [ 
            'auth1'=>0,'auth2'=>0,'auth3'=>0,
            'reverted'=>0,'rejected'=>0,
            'citizen'=>0,'completed'=>0,'total'=>0
        ];
    }

    if ($bucket !== null) {
        $report[$ward][$bucket] += $count;
        $report[$ward]['total'] += $count;
    }
}

if(true){
    $arr=['A','B','C','D','E','F','G','H','I','J'];
    
if(USER_ROLE!=8 && USER_ROLE!=1){
    $arr=explode(",",get_active_user("ward"));
}
    foreach($arr as $a){
        if(!isset($report[$a])){
            $report[$a] = [
                'auth1' => 0,
                'auth2' => 0,
                'auth3' => 0,
                'reverted' => 0,
                'cert_pending' => 0,
                'completed' => 0,
                'total' => 0
            ];
        }
    }
}
?>

<style>
.table-report {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.table-report th, .table-report td {
    border: 1px solid #ccc;
    padding: 6px;
    text-align: center;
}
.table-report th {
    background: #f5f5f5;
}
.text-left { text-align: left; }
.badge { padding: 3px 7px; border-radius: 4px; color: #fff; }
.b1 { background:#f39c12; } /* auth */
.b2 { background:#e67e22; }
.b3 { background:#d35400; }
.b4 { background:#c0392b; } /* reverted */
.b5 { background:#8e44ad; } /* cert pending */
.b6 { background:#27ae60; } /* completed */
</style>
<table class="table-report">
    <thead>
        <tr>
            <th class="text-left">Ward</th>
            <th>Auth 1</th>
            <th>Auth 2</th>
            <th>Auth 3</th>
            <th>Citzen Payment </th>
            <th>Reverted</th>
            <th>Certificate Upload Pending</th>
            <th>Completed</th>
            <!--<th>Total</th>-->
        </tr>
    </thead>

    <tbody>
        <?php
        // Initialize column totals
        $totals = [
            'auth1' => 0,
            'auth2' => 0,
            'auth3' => 0,
            'auth3cp' => 0,
            'reverted' => 0,
            'cert_pending' => 0,
            'completed' => 0,
            'total' => 0
        ];

        foreach ($report as $ward => $r):
            // Add to column totals
            foreach ($totals as $key => $val) {
                $totals[$key] += (int)$r[$key];
            }
        ?>
        <tr>
            <td class="text-left"><strong><?= htmlspecialchars($ward) ?></strong></td>
            <td><span class="badge b1"><?= $r['auth1']+0 ?></span></td>
            <td><span class="badge b2"><?= $r['auth2']+0 ?></span></td>
            <td><span class="badge b3"><?= $r['auth3']+0 ?></span></td>
            <td><span class="badge b3"><?= $r['auth3cp']+0 ?></span></td>
            <td><span class="badge b4"><?= $r['reverted']+0 ?></span></td>
            <td><span class="badge b5"><?= $r['cert_pending']+0 ?></span></td>
            <td><span class="badge b6"><?= $r['completed']+0 ?></span></td>
            <!--<td><strong><?= $r['total']+0 ?></strong></td>-->
        </tr>
        <?php endforeach; ?>
    </tbody>

    <tfoot>
        <tr class="table-total">
            <th class="text-left">Grand Total</th>
            <th><?= $totals['auth1'] ?></th>
            <th><?= $totals['auth2'] ?></th>
            <th><?= $totals['auth3'] ?></th>
            <th><?= $totals['auth3cp'] ?></th>
            <th><?= $totals['reverted'] ?></th>
            <th><?= $totals['cert_pending'] ?></th>
            <th><?= $totals['completed'] ?></th>
            <!--<th><?= $totals['total'] ?></th>-->
        </tr>
    </tfoot>
</table>

<br>
<br>

<h2>OC - Application Form</h2>
<br>
<?php $whereWard = "";
if (USER_ROLE != 8 && USER_ROLE != 1) {
    $wards = explode(",", get_active_user("ward"));
    $wards = array_map('trim', $wards);
    $whereWard = " AND ward IN ('" . implode("','", $wards) . "')";
}

$sql = "
    SELECT
        ward,
        CASE
            WHEN status = 1 THEN 'auth1'
            WHEN status = 2 THEN 'auth2'
            WHEN (status = 3 AND paid != '') OR status = 4 THEN 'auth3'
            WHEN (status = 3 AND paid = '')  THEN 'auth3cp'
            WHEN status = 5 THEN 'completed'
            WHEN status = -2 THEN 'reverted'
            WHEN status = -1 THEN 'rejected'
            WHEN status = 0 THEN 'citizen'
        END AS bucket,
        COUNT(id) AS c
    FROM application_form_oc
    WHERE 1=1
    $whereWard
    GROUP BY ward, bucket
";

$records = $db->rawQuery($sql);


/* Re-arrange data ward-wise */ 
$report = [];
foreach ($records as $r) {
    $ward   = $r['ward'];
    $bucket = $r['bucket'];
    $count  = (int)$r['c'];

    if (!isset($report[$ward])) {
        $report[$ward] = [ 
            'auth1'=>0,'auth2'=>0,'auth3'=>0,
            'reverted'=>0,'rejected'=>0,
            'citizen'=>0,'completed'=>0,'total'=>0
        ];
    }

    if ($bucket !== null) {
        $report[$ward][$bucket] += $count;
        $report[$ward]['total'] += $count;
    }
}

if(true){
    $arr=['A','B','C','D','E','F','G','H','I','J'];
    
if(USER_ROLE!=8 && USER_ROLE!=1){
    $arr=explode(",",get_active_user("ward"));
}
    foreach($arr as $a){
        if(!isset($report[$a])){
            $report[$a] = [
                'auth1' => 0,
                'auth2' => 0,
                'auth3' => 0,
                'reverted' => 0,
                'cert_pending' => 0,
                'completed' => 0,
                'total' => 0
            ];
        }
    }
}
?>

<style>
.table-report {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.table-report th, .table-report td {
    border: 1px solid #ccc;
    padding: 6px;
    text-align: center;
}
.table-report th {
    background: #f5f5f5;
}
.text-left { text-align: left; }
.badge { padding: 3px 7px; border-radius: 4px; color: #fff; }
.b1 { background:#f39c12; } /* auth */
.b2 { background:#e67e22; }
.b3 { background:#d35400; }
.b4 { background:#c0392b; } /* reverted */
.b5 { background:#8e44ad; } /* cert pending */
.b6 { background:#27ae60; } /* completed */
</style>
<table class="table-report">
    <thead>
        <tr>
            <th class="text-left">Ward</th>
            <th>Auth 1</th>
            <th>Auth 2</th>
            <th>Auth 3</th>
            <th>Citzen Payment </th>
            <th>Reverted</th>
            <th>Certificate Upload Pending</th>
            <th>Completed</th>
            <!--<th>Total</th>-->
        </tr>
    </thead>

    <tbody>
        <?php
        // Initialize column totals
        $totals = [
            'auth1' => 0,
            'auth2' => 0,
            'auth3' => 0,
            'auth3cp' => 0,
            'reverted' => 0,
            'cert_pending' => 0,
            'completed' => 0,
            'total' => 0
        ];

        foreach ($report as $ward => $r):
            // Add to column totals
            foreach ($totals as $key => $val) {
                $totals[$key] += (int)$r[$key];
            }
        ?>
        <tr>
            <td class="text-left"><strong><?= htmlspecialchars($ward) ?></strong></td>
            <td><span class="badge b1"><?= $r['auth1']+0 ?></span></td>
            <td><span class="badge b2"><?= $r['auth2']+0 ?></span></td>
            <td><span class="badge b3"><?= $r['auth3']+0 ?></span></td>
            <td><span class="badge b3"><?= $r['auth3cp']+0 ?></span></td>
            <td><span class="badge b4"><?= $r['reverted']+0 ?></span></td>
            <td><span class="badge b5"><?= $r['cert_pending']+0 ?></span></td>
            <td><span class="badge b6"><?= $r['completed']+0 ?></span></td>
            <!--<td><strong><?= $r['total']+0 ?></strong></td>-->
        </tr>
        <?php endforeach; ?>
    </tbody>

    <tfoot>
        <tr class="table-total">
            <th class="text-left">Grand Total</th>
            <th><?= $totals['auth1'] ?></th>
            <th><?= $totals['auth2'] ?></th>
            <th><?= $totals['auth3'] ?></th>
            <th><?= $totals['auth3cp'] ?></th>
            <th><?= $totals['reverted'] ?></th>
            <th><?= $totals['cert_pending'] ?></th>
            <th><?= $totals['completed'] ?></th>
            <!--<th><?= $totals['total'] ?></th>-->
        </tr>
    </tfoot>
</table>


                        <?php
                    }
                    
                        if(USER_ROLE == 28){
                    ?></div>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $rec_count = $comp_model->getcount_totalapplications();  ?>
                    <a class="animated zoomIn record-count alert alert-secondary"  href="<?php print_link("application_form/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Total Applications</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_completedapplications();  ?>
                    <a class="animated zoomIn record-count alert alert-success"  href="<?php print_link("application_form?status=5") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Completed Applications</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_pendingapplications();  ?>
                    <a class="animated zoomIn record-count alert alert-warning"  href="<?php print_link("application_form?status=0") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Pending Applications</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_rejectedapplications();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("application_form?status=-1") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Rejected Applications</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=""><?php 
                        }if(USER_ROLE == 28){
                    ?></div>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $rec_count = $comp_model->getcount_totalapplicationsreceived();  ?>
                    <a class="animated zoomIn record-count alert alert-success"  href="<?php print_link("application_form/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Total Applications Received </div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_pendingapplications_2();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("application_form?status=1") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Pending Applications</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=""><?php 
                        }if(USER_ROLE==28){
                    ?></div>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $rec_count = $comp_model->getcount_totalapplicationsreceived_2();  ?>
                    <a class="animated zoomIn record-count alert alert-success"  href="<?php print_link("application_form/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Total Applications Received </div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_pendingapplications_2_2();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("application_form?status=2") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Pending Applications</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=""><?php 
                        }if(USER_ROLE == 28){
                    ?></div>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $rec_count = $comp_model->getcount_totalapplicationsreceived();  ?>
                    <a class="animated zoomIn record-count alert alert-success"  href="<?php print_link("application_form/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Total Applications Received </div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                    <?php $rec_count = $comp_model->getcount_pendingapplications_2_2_2();  ?>
                    <a class="animated zoomIn record-count alert alert-danger"  href="<?php print_link("application_form?status=3") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Pending Applications</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=""><?php 
                        } 
                    ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
