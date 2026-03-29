<?php

/**
 * Info Contoller Class
 * @category  Controller 
 */

class ApiController extends BaseController
{

	/**
	 * call model action to retrieve data
	 * @return json data
	 */
	 
	
	 function save_data($table){ 
	    $db=$this->GetModel();
	    foreach($_POST as $field=>$value){
	        if(is_array($field) || is_array($value)){
	            continue;
	        }
        $data = [
            "value" => $value
        ];
    
        $db->where("user_id", USER_ID); 
        $db->where("tablename", $table);
        $db->where("field", $field);
    
        if ($db->getOne("temp_data")) { 
    
        $db->where("user_id", USER_ID); 
        $db->where("tablename", $table);
        $db->where("field", $field);
            $db->update("temp_data", $data);
        } else {
            print_r([
                "user_id"  => USER_ID,
                "tablename"=> $table,
                "field"    => $field,
                "value"    => $value,
            ]);
            $db->insert("temp_data", [
                "user_id"  => USER_ID,
                "tablename"=> $table,
                "field"    => $field,
                "value"    => $value,
            ]);
        }
        }
	 }
	 function get_data($table){
	     $db = $this->GetModel();

$db->where("user_id", USER_ID);
$db->where("tablename", $table);

$rows = $db->get("temp_data", 9999, "field, value");

$data = [];

foreach ($rows as $row) {
    if ($row['value'] !== '' && $row['value'] !== null) {
        $data[$row['field']] = $row['value'];
    }
}

render_json($data);

     
	 }
	function viewreasonALL($id, $dbname){
	    $db=$this->GetModel();
	    $db->where("rec_id",$id);
	    $db->where("db_name",$dbname); 
	    $reason =$db->get('accept_reject',99999,"*");
	 ?>
	 <html>
	     <body>
	         <table class="table"> 
	             <tr>
	                 <th>Action</th> 
	                 <th>Remark</th>  
	             </tr>
	             <?php foreach($reason as $r){
	                echo "<tr>";
	                    echo "<td>".$r['action']."</td>";
	                    echo "<td>".$r['remark']."</td>";
	                echo "</tr>";
	             } ?>
	         </table>
	     </body>
	 </html>
	 <?php    
	}

	 function water_oc_paid($txn,$id,$txnname){
	     
	    $db=$this->GetModel();
	   
	   if($id==12){
	       $appl=6;
	   }else{
	       $appl=13;
	       
	   }
	   $db->where("id",$appl);
	   $db->update("payments",["payment_cash_collection_center"=>$txn]);
	   
	   $db->where("id",$id);
	   $db->update("application_form_oc",["paid"=>$appl]); 
	 }
	  
	 function offlineredirect(){
	     $allow=1;
	     if($allow){
	         $_SESSION['home']=SITE_ADDR;
	         echo "<script>location.href='https://singlewindowsystemkdmc.in/offline_noc/integratelogin/?mob=water&link=application_form';</script>";
	     }else{
	         echo "<script>alert('You are not authorized');location.href='".SITE_ADDR."'";
	     }
	 }
	
	 function cc_report(){
	    $db=$this->GetModel();
	   
	   
	    
	    $rec=$db->get("application_form",99999,"*,DATEDIFF(CURDATE(), timestamp) AS diff_days");
	    
	    $auth1=0;
	    $auth2=0;
	    $auth3=0;
	    $complete=0;
	    $rejected=0;$reverted=0;
	     
	    $p_wt_sla=0;
	    $p_w_sla=0;
	    
	    $c_wt_sla=0;
	    $c_w_sla=0;
	    $citizen=0;
	    foreach($rec as $r){
	        if($r['status']+0==1){
	            $auth1++;
	            if($r['diff_days']+0>10){$p_wt_sla++;}else{$p_w_sla++;}
	        }    
	        if($r['status']+0==2){
	            $auth2++;
	            if($r['diff_days']+0>10){$p_wt_sla++;}else{$p_w_sla++;}
	        }    
	        if($r['status']+0==3 || $r['status']+0==4){
	            
                if($r['paid']==0){
                    $citizen++;
                }else{
	            $auth3++;
	            if($r['diff_days']+0>10){$p_wt_sla++;}else{$p_w_sla++;}
                }
	        }       
	        if($r['status']+0==5){ 
	            $complete++; 
	                if($r['diff_days']+0>10){$c_wt_sla++;}else{$c_w_sla++;}
	        } 
	        if($r['status']+0==-1){
	            $rejected++;
	        }  
	        if($r['status']+0==-2){
	            $reverted++;
	        } 
	    }
	    
	    render_json([
	            'auth_1'=>$auth1,
	            'auth_2'=>$auth2,
	            'auth_3'=>$auth3,
	            'complete'=>$complete,
	            'citizenpay'=>$citizen,
	            'reverted'=>$reverted,
	            'rejected'=>$rejected,
	            "sla_p"=>[$p_w_sla,$p_wt_sla],
	            "sla_c"=>[$c_w_sla,$c_wt_sla],
	        ]);
	    
	 }
	 function oc_report(){
	    $db=$this->GetModel();
	   
	   
	    
	    $rec=$db->get("application_form_oc",99999,"*,DATEDIFF(CURDATE(), timestamp) AS diff_days");
	    
	    $auth1=0;
	    $auth2=0;
	    $auth3=0;
	    $complete=0;
	    $rejected=0;$reverted=0;
	    $p_wt_sla=0;
	    $p_w_sla=0;
	    
	    $c_wt_sla=0;
	    $c_w_sla=0;
	    $citizen=0;
	     
	    foreach($rec as $r){
	        if($r['status']+0==1){
	            $auth1++;
	            if($r['diff_days']+0>10){$p_wt_sla++;}else{$p_w_sla++;}
	        }    
	        if($r['status']+0==2){
	            $auth2++;
	            if($r['diff_days']+0>10){$p_wt_sla++;}else{$p_w_sla++;}
	        }    
	        if($r['status']+0==3 || $r['status']+0==4){
                if($r['paid']==0){
                    $citizen++;
                }else{
	            $auth3++;
	            if($r['diff_days']+0>10){$p_wt_sla++;}else{$p_w_sla++;}
                }
	        }       
	        if($r['status']+0==5){ 
	            $complete++; 
	                if($r['diff_days']+0>10){$c_wt_sla++;}else{$c_w_sla++;}
	        }    
	        if($r['status']+0==-1){
	            $rejected++;
	        }    
	        if($r['status']+0==-2){
	            $reverted++;
	        } 
	    }
	    
	    render_json([
	            'auth_1'=>$auth1,
	            'auth_2'=>$auth2,
	            'auth_3'=>$auth3,
	            'complete'=>$complete,
	            'citizenpay'=>$citizen,
	            'reverted'=>$reverted,
	            'rejected'=>$rejected,
	            "sla_p"=>[$p_w_sla,$p_wt_sla],
	            "sla_c"=>[$c_w_sla,$c_wt_sla],
	        ]);
	    
	 }
	 
	 function make_paymentcc($txnid,$id,$amount,$name){
	    $db=$this->GetModel(); 
	    echo $rec_id=$db->insert("payments",[
	            "amount"=>$amount,
                "payment_mode"=>"ONLINE",
                "payment_cash_collection_center"=>"$txnid",
                "payment_person"=>$name,
	         ]);
		$db->where("id",$id);
$db->update("application_form",["paid"=>$rec_id]);
	 }	 function make_paymentcc2($txnid,$id,$amount,$name){
	    $db=$this->GetModel(); 
	    echo $rec_id=$db->insert("payments",[
	            "amount"=>$amount,
                "payment_mode"=>"ONLINE",
                "db_name"=>"oc",
                "payment_cash_collection_center"=>"$txnid",
                "payment_person"=>$name,
	         ]);
		$db->where("id",$id);
$db->update("application_form_oc",["paid"=>$rec_id]);
	 }
	 
	function update_label($cahe=0){
	    $db=$this->GetModel();
		$lables=$db->get("label_names",99999,"*");
		$pages=['add','list','edit'];
		foreach($lables as $l){
			foreach($pages as $p){
				if(file_exists("app/views/partials/".$l['db_name']."/".$p."_old.php") && $cahe==0){
					$file="app/views/partials/".$l['db_name']."/".$p."_old.php";
				}else{
					$file="app/views/partials/".$l['db_name']."/".$p.".php"; 
				}
	
				$content=file_get_contents($file);
				$fval=str_replace("_"," ",$l['field']);
				  $fval=ucwords(strtolower($fval), '\',. ');
	
				$newval=$l['label_name'];
	
				if($p=="list"){  
					$contentnew=str_replace('<th  class="td-'.$l['field'].'"> '.$fval.'</th>',
					'<th  class="td-'.$l['field'].'"> '.$newval.'</th>',$content);
					$contentnew=str_replace($fval.':',$newval.':',$content);
				}else{ 

					$contentnew=str_replace('<label class="control-label" for="'.$l['field'].'">'.$fval.' <span class="text-danger">*</span></label>',
					'<label class="control-label" for="'.$l['field'].'">'.$newval.' <span class="text-danger">*</span></label>',$content);
					$contentnew=str_replace('<label class="control-label" for="'.$l['field'].'">'.$fval.' </label>',
					'<label class="control-label" for="'.$l['field'].'">'.$newval.' </label>',$contentnew);

				}
	
				file_put_contents("app/views/partials/".$l['db_name']."/".$p."_old.php",$content);
				file_put_contents("app/views/partials/".$l['db_name']."/".$p.".php",$contentnew);
	            echo "<br><hr>app/views/partials/".$l['db_name']."/".$p.".php";
			}
			
		}
		echo "Done"; 
	}
	
	
	function viewreason($dbname,$id){
	    $db=$this->GetModel();
	    $db->where("rec_id",$id);
	    
	    $db->where("db_name",$dbname=="application_form_oc"?"oc":"cc");
	    $db->orderby('id','DESC');
	    $reason =$db->getOne('accept_reject',"*")['remark'];
	 ?>
	 <html>
	     <body> 
	         <table class="table">
	             <!--<tr>-->
	             <!--    <th>Rec ID</th>-->
	             <!--    <td> <?php echo $id ?> </td>-->
	             <!--</tr>-->
	             <tr>
	                 <th>Remark</th>
	                 <td> <?php echo $reason ?> </td>
	             </tr>
	         </table>
	     </body>
	 </html>
	 <?php    
	}
	function json($action, $arg1 = null, $arg2 = null)
	{
		$model = new SharedController;
		$args = array($arg1, $arg2);
		$data = call_user_func_array(array($model, $action), $args);
		render_json($data);
	}
	
	
function final_report() {
    $db = $this->GetModel();

    // get selected table (default = drainage_noc_jal_cc)
    $table = isset($_GET['form']) ? $_GET['form'] : 'application_form';

    // safety check (only allow these 4 tables)
    $allowedTables = [
        'application_form'
    ];
    if (!in_array($table, $allowedTables)) {
        $table = 'application_form';
    }

    // fetch main report
    $rec = $db->rawQuery("
        SELECT
            SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS auth1,
            SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS auth2,
            SUM(
                CASE 
                    WHEN (status = 3 AND paid != '') OR status = 4
                    THEN 1 
                    ELSE 0 
                END
            ) AS auth3,
            SUM(CASE WHEN status = '5' THEN 1 ELSE 0 END) AS completed,
            SUM(CASE WHEN status = '-2' THEN 1 ELSE 0 END) AS reverted,
            SUM(CASE WHEN status = '-1' THEN 1 ELSE 0 END) AS rejected,
            SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) AS citizen
        FROM $table
    ")[0];

    // daily applications
    $dailyData = $db->rawQuery("
        SELECT DATE(timestamp) AS date, COUNT(*) AS total
        FROM $table
        GROUP BY DATE(timestamp)
        ORDER BY DATE(timestamp) DESC
    ");

    $dates = [];
    $totals = [];
    foreach ($dailyData as $row) {
        $dates[] = $row['date'];
        $totals[] = $row['total'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>KDMC WATER DEPARTMENT REPORT CC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Chart.js -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
      /* ===== General Reset ===== */
    @import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300..700&display=swap');

    * {
      font-family: "Signika Negative", serif;
      font-optical-sizing: auto;
      font-weight: 400;
      font-style: normal;
    }
    
    body {
      background: linear-gradient(135deg, #eef2f3, #dfe9f3);
      color: #212529;
      min-height: 100vh;
    }
    
    .dashboard-title {
        font-family: "Signika Negative", sans-serif;
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        color: #0077b6; /* fallback dark water blue */
        margin-bottom: 2rem;
        margin-top: 2px;
        padding-top: 20px;
        position: relative;
        display: block;
        background: linear-gradient(90deg, #0077b6, #0096c7); /* darker water gradient */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Animated underline */
    .dashboard-title::after {
        content: '';
        display: block;
        width: 0;
        height: 4px;
        margin: 6px auto 0;
        background: linear-gradient(90deg, #0077b6, #0096c7); /* matching underline */
        border-radius: 2px;
        transition: width 0.4s ease-in-out;
    }
    .dashboard-title:hover::after {
        width: 50%;
    }

    
    /* ===== Status Table Styling ===== */
    .status-table {
        font-family: "Signika Negative", sans-serif;
        font-size: 14px;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: 2px solid #28a745;
    }
    
    .status-table thead {
        background: linear-gradient(90deg, #28a745, #218838);
        color: #fff;
        text-transform: uppercase;
        font-weight: 600;
    }
    
    .status-table th, .status-table td {
        padding: 12px 15px;
        border: 1px solid #c8e6c9;
        transition: all 0.3s ease;
        font-weight: bold;
    }
    
    .status-table tbody tr:nth-child(even) {
        background-color: #f3f8f4;
    }
    .status-table tbody tr:hover {
        background: #d4edda;
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    /* Badges */
    .status-table td span.badge {
        display: inline-block;
        min-width: 40px;
        padding: 5px 10px;
        border-radius: 20px;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    .status-table td span.citizen { background-color: #007bff; }
    .status-table td span.cg { background-color: #6f42c1; }
    .status-table td span.gs { background-color: #cd08e4; }
    .status-table td span.gs-tippni { background-color: #ffc107; color: #212529; }
    .status-table td span.dmc { background-color: #17a2b8; }
    .status-table td span.completed { background-color: #28a745; }
    .status-table td span.rejected { background-color: #dc3545; }
    .status-table td span.cancelled { background-color: #6c757d; }
    
    /* ===== Animations ===== */
    .fade-up {
      opacity: 0;
      transform: translateY(25px);
      transition: all 0.8s ease-out;
    }
    .fade-up.show {
      opacity: 1;
      transform: translateY(0);
    }
    .status-table tbody tr {
      opacity: 0;
      transform: translateY(15px);
      animation: fadeInUpRow 0.6s ease forwards;
    }
    .status-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .status-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .status-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .status-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .status-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
    .status-table tbody tr:nth-child(6) { animation-delay: 0.6s; }
    .status-table tbody tr:nth-child(7) { animation-delay: 0.7s; }
    .status-table tbody tr:nth-child(8) { animation-delay: 0.8s; }
    
    @keyframes fadeInUpRow {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

  </style>
</head>
<body>

<!-- Navbar Menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info shadow-sm my-navbar">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">KDMC Water NOC Reports</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
                    <a class="nav-link " href="final_report">APPLICATION FORM CC</a>
                  </li><li class="nav-item">
                    <a class="nav-link " href="final_report2">APPLICATION FORM OC</a>
                  </li> 
                  </ul>
    </div>
  </div>
</nav>

<!--<h1 class="dashboard-title">   -->
<!--  <small style="font-size:18px;">(<?= strtoupper(str_replace("_"," ",str_replace("drainage_noc_", "", $table))) ?>)</small>-->
<!--</h1>-->


<h1 class="dashboard-title">WATER DEPARTMENT KDMC REPORT CC</h1>


<!-- Data Table -->
<div class="container mb-4">
  <div class="table-responsive">
      <table class="table status-table text-center align-middle">
          <thead>
              <tr>
                  <th>Auth Level 1</th>
                  <th>Auth Level 2</th>
                  <th>Auth Level 3</th>
                  <th>Completed</th>
                  <th>Reverted</th>
                  <th>Rejected</th>
                  <th>Citizen</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                    <td><span class="badge cg"><?= $rec['auth1'] ?></span></td>
                    <td><span class="badge gs"><?= $rec['auth2'] ?></span></td>
                    <td><span class="badge gs-tippni"><?= $rec['auth3'] ?></span></td>
                    <td><span class="badge completed"><?= $rec['completed'] ?></span></td>
                    <td><span class="badge cancelled"><?= $rec['reverted'] ?></span></td>
                    <td><span class="badge rejected"><?= $rec['rejected'] ?></span></td>
                    <td><span class="badge dmc"><?= $rec['citizen'] ?></span></td>
              </tr>
          </tbody>
      </table>
  </div>
</div>

<!-- Charts -->
<div class="container">
  <div class="row fade-up">
      <div class="col-2"></div>
      <div class="col-md-4 mb-4">
          <canvas id="barChart" height="300"></canvas>
      </div>
      <div class="col-md-4 mb-4">
          <canvas id="pieChart" height="300"></canvas>
      </div>
  </div>
  <div class="row fade-up">
      <div class="col-2"></div>
      <div class="col-8">
          <h4 class="text-center text-success mb-3">Daily Applications Trend</h4>
          <canvas id="dailyChart" height="120"></canvas>
      </div>
  </div>
</div>

<script>
  const dailyLabels = <?= json_encode($dates) ?>;
  const dailyCounts = <?= json_encode($totals) ?>;
  const labels = ['Auth 1', 'Auth 2', 'Auth 3',  'Completed', 'Reverted', 'Rejected' ];
  const values = [
      <?= $rec['auth1'] ?>,
      <?= $rec['auth2'] ?>,
      <?= $rec['auth3'] ?>, 
      <?= $rec['completed'] ?>,
      <?= $rec['reverted'] ?>,
      <?= $rec['rejected'] ?>,
      <?= $rec['citizen'] ?>,
  ];
//   const baseColors = ['#007bff', '#20c997', '#17a2b8', '#28a745' , '#dc3545' ];
  
    const baseColors = [
        "#6f42c1","#cd08e4","#ffc107","#28a745","#dc3545","#ff9da7", "#17a2b8"
    ];
    Chart.defaults.font.family = "'Signika Negative', sans-serif";
    Chart.defaults.font.size = 14;

  // Line Chart
  new Chart(document.getElementById('dailyChart'), {
      type: 'line',
      data: { labels: dailyLabels, datasets: [{
          label: 'Applications per Day',
          data: dailyCounts,
          borderColor: '#28a745',
          backgroundColor: '#28a745',
          tension: 0.3,
          pointRadius: 4
      }]},
      options: { responsive: true }
  });

  // Pie Chart
  new Chart(document.getElementById('pieChart'), {
      type: 'pie',
      data: { labels: labels, datasets: [{ data: values, backgroundColor: baseColors }] },
      options: { responsive: true }
  });

  // Bar Chart
  new Chart(document.getElementById('barChart'), {
      type: 'bar',
      data: { labels: labels, datasets: [{ data: values, backgroundColor: baseColors }] },
      options: { responsive: true },
      
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "Status Counts",
                    font: { size: 18, weight: "bold" },
                    padding: { bottom: 20 }
                },
                legend: { display: false },
                tooltip: {
                    backgroundColor: "#000",
                    padding: 10,
                    bodyFont: { size: 13 },
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed.y}`;
                        }
                    }
                }
            },
            interaction: { mode: "index", intersect: false },
            scales: {
                x: {
                    ticks: { font: { size: 13 } }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { size: 13 } },
                    grid: { color: "rgba(0,0,0,0.05)" }
                }
            },
            animation: {
                duration: 1200,
                easing: "easeOutBounce"
            }
        }
  });
  
  document.addEventListener('DOMContentLoaded', () => {
      const faders = document.querySelectorAll('.fade-up');
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('show');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.25 });
      faders.forEach(el => observer.observe(el));
    });
</script>

</body>
</html>

<?php
}


function final_report2() {
    $db = $this->GetModel();

    // get selected table (default = drainage_noc_jal_cc)
    $table = isset($_GET['form']) ? $_GET['form'] : 'application_form_oc';

    // safety check (only allow these 4 tables)
    $allowedTables = [
        'application_form_oc'
    ];
    if (!in_array($table, $allowedTables)) {
        $table = 'application_form_oc';
    }

    // fetch main report
    $rec = $db->rawQuery("
        SELECT
            SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS auth1,
            SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS auth2,
            SUM(
                CASE 
                    WHEN status = 3 OR status = 4
                    THEN 1 
                    ELSE 0 
                END
            ) AS auth3,
            SUM(CASE WHEN status = '5' THEN 1 ELSE 0 END) AS completed,
            SUM(CASE WHEN status = '-2' THEN 1 ELSE 0 END) AS reverted,
            SUM(CASE WHEN status = '-1' THEN 1 ELSE 0 END) AS rejected,
            SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) AS citizen
        FROM $table
    ")[0];

    // daily applications
    $dailyData = $db->rawQuery("
        SELECT DATE(timestamp) AS date, COUNT(*) AS total
        FROM $table
        GROUP BY DATE(timestamp)
        ORDER BY DATE(timestamp) DESC
    ");

    $dates = [];
    $totals = [];
    foreach ($dailyData as $row) {
        $dates[] = $row['date'];
        $totals[] = $row['total'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>KDMC WATER DEPARTMENT REPORT OC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Chart.js -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
      /* ===== General Reset ===== */
    @import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300..700&display=swap');

    * {
      font-family: "Signika Negative", serif;
      font-optical-sizing: auto;
      font-weight: 400;
      font-style: normal;
    }
    
    body {
      background: linear-gradient(135deg, #eef2f3, #dfe9f3);
      color: #212529;
      min-height: 100vh;
    }
    
    .dashboard-title {
        font-family: "Signika Negative", sans-serif;
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        color: #0077b6; /* fallback dark water blue */
        margin-bottom: 2rem;
        margin-top: 2px;
        padding-top: 20px;
        position: relative;
        display: block;
        background: linear-gradient(90deg, #0077b6, #0096c7); /* darker water gradient */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Animated underline */
    .dashboard-title::after {
        content: '';
        display: block;
        width: 0;
        height: 4px;
        margin: 6px auto 0;
        background: linear-gradient(90deg, #0077b6, #0096c7); /* matching underline */
        border-radius: 2px;
        transition: width 0.4s ease-in-out;
    }
    .dashboard-title:hover::after {
        width: 50%;
    }

    
    /* ===== Status Table Styling ===== */
    .status-table {
        font-family: "Signika Negative", sans-serif;
        font-size: 14px;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: 2px solid #28a745;
    }
    
    .status-table thead {
        background: linear-gradient(90deg, #28a745, #218838);
        color: #fff;
        text-transform: uppercase;
        font-weight: 600;
    }
    
    .status-table th, .status-table td {
        padding: 12px 15px;
        border: 1px solid #c8e6c9;
        transition: all 0.3s ease;
        font-weight: bold;
    }
    
    .status-table tbody tr:nth-child(even) {
        background-color: #f3f8f4;
    }
    .status-table tbody tr:hover {
        background: #d4edda;
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }
    
    /* Badges */
    .status-table td span.badge {
        display: inline-block;
        min-width: 40px;
        padding: 5px 10px;
        border-radius: 20px;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }
    .status-table td span.citizen { background-color: #007bff; }
    .status-table td span.cg { background-color: #6f42c1; }
    .status-table td span.gs { background-color: #cd08e4; }
    .status-table td span.gs-tippni { background-color: #ffc107; color: #212529; }
    .status-table td span.dmc { background-color: #17a2b8; }
    .status-table td span.completed { background-color: #28a745; }
    .status-table td span.rejected { background-color: #dc3545; }
    .status-table td span.cancelled { background-color: #6c757d; }
    
    /* ===== Animations ===== */
    .fade-up {
      opacity: 0;
      transform: translateY(25px);
      transition: all 0.8s ease-out;
    }
    .fade-up.show {
      opacity: 1;
      transform: translateY(0);
    }
    .status-table tbody tr {
      opacity: 0;
      transform: translateY(15px);
      animation: fadeInUpRow 0.6s ease forwards;
    }
    .status-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .status-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .status-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .status-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .status-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
    .status-table tbody tr:nth-child(6) { animation-delay: 0.6s; }
    .status-table tbody tr:nth-child(7) { animation-delay: 0.7s; }
    .status-table tbody tr:nth-child(8) { animation-delay: 0.8s; }
    
    @keyframes fadeInUpRow {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

  </style>
</head>
<body>

<!-- Navbar Menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info shadow-sm my-navbar">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">KDMC Water NOC Reports</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
                    <a class="nav-link " href="final_report">APPLICATION FORM CC</a>
                  </li><li class="nav-item">
                    <a class="nav-link " href="final_report2">APPLICATION FORM OC</a>
                  </li> 
                  </ul>
    </div>
  </div>
</nav>

<!--<h1 class="dashboard-title">   -->
<!--  <small style="font-size:18px;">(<?= strtoupper(str_replace("_"," ",str_replace("drainage_noc_", "", $table))) ?>)</small>-->
<!--</h1>-->


<h1 class="dashboard-title">WATER DEPARTMENT KDMC REPORT OC</h1>


<!-- Data Table -->
<div class="container mb-4">
  <div class="table-responsive">
      <table class="table status-table text-center align-middle">
          <thead>
              <tr>
                  <th>Auth Level 1</th>
                  <th>Auth Level 2</th>
                  <th>Auth Level 3</th>
                  <th>Completed</th>
                  <th>Reverted</th>
                  <th>Rejected</th>
                  <th>Citizen</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                    <td><span class="badge cg"><?= $rec['auth1'] ?></span></td>
                    <td><span class="badge gs"><?= $rec['auth2'] ?></span></td>
                    <td><span class="badge gs-tippni"><?= $rec['auth3'] ?></span></td>
                    <td><span class="badge completed"><?= $rec['completed'] ?></span></td>
                    <td><span class="badge cancelled"><?= $rec['reverted'] ?></span></td>
                    <td><span class="badge rejected"><?= $rec['rejected'] ?></span></td>
                    <td><span class="badge dmc"><?= $rec['citizen'] ?></span></td>
              </tr>
          </tbody>
      </table>
  </div>
</div>

<!-- Charts -->
<div class="container">
  <div class="row fade-up">
      <div class="col-2"></div>
      <div class="col-md-4 mb-4">
          <canvas id="barChart" height="300"></canvas>
      </div>
      <div class="col-md-4 mb-4">
          <canvas id="pieChart" height="300"></canvas>
      </div>
  </div>
  <div class="row fade-up">
      <div class="col-2"></div>
      <div class="col-8">
          <h4 class="text-center text-success mb-3">Daily Applications Trend</h4>
          <canvas id="dailyChart" height="120"></canvas>
      </div>
  </div>
</div>

<script>
  const dailyLabels = <?= json_encode($dates) ?>;
  const dailyCounts = <?= json_encode($totals) ?>;
  const labels = ['Auth 1', 'Auth 2', 'Auth 3',  'Completed', 'Reverted', 'Rejected' ];
  const values = [
      <?= $rec['auth1'] ?>,
      <?= $rec['auth2'] ?>,
      <?= $rec['auth3'] ?>, 
      <?= $rec['completed'] ?>,
      <?= $rec['reverted'] ?>,
      <?= $rec['rejected'] ?>,
      <?= $rec['citizen'] ?>,
  ];
//   const baseColors = ['#007bff', '#20c997', '#17a2b8', '#28a745' , '#dc3545' ];
  
    const baseColors = [
        "#6f42c1","#cd08e4","#ffc107","#28a745","#dc3545","#ff9da7", "#17a2b8"
    ];
    Chart.defaults.font.family = "'Signika Negative', sans-serif";
    Chart.defaults.font.size = 14;

  // Line Chart
  new Chart(document.getElementById('dailyChart'), {
      type: 'line',
      data: { labels: dailyLabels, datasets: [{
          label: 'Applications per Day',
          data: dailyCounts,
          borderColor: '#28a745',
          backgroundColor: '#28a745',
          tension: 0.3,
          pointRadius: 4
      }]},
      options: { responsive: true }
  });

  // Pie Chart
  new Chart(document.getElementById('pieChart'), {
      type: 'pie',
      data: { labels: labels, datasets: [{ data: values, backgroundColor: baseColors }] },
      options: { responsive: true }
  });

  // Bar Chart
  new Chart(document.getElementById('barChart'), {
      type: 'bar',
      data: { labels: labels, datasets: [{ data: values, backgroundColor: baseColors }] },
      options: { responsive: true },
      
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "Status Counts",
                    font: { size: 18, weight: "bold" },
                    padding: { bottom: 20 }
                },
                legend: { display: false },
                tooltip: {
                    backgroundColor: "#000",
                    padding: 10,
                    bodyFont: { size: 13 },
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed.y}`;
                        }
                    }
                }
            },
            interaction: { mode: "index", intersect: false },
            scales: {
                x: {
                    ticks: { font: { size: 13 } }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { size: 13 } },
                    grid: { color: "rgba(0,0,0,0.05)" }
                }
            },
            animation: {
                duration: 1200,
                easing: "easeOutBounce"
            }
        }
  });
  
  document.addEventListener('DOMContentLoaded', () => {
      const faders = document.querySelectorAll('.fade-up');
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('show');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.25 });
      faders.forEach(el => observer.observe(el));
    });
</script>

</body>
</html>

<?php
}


}
