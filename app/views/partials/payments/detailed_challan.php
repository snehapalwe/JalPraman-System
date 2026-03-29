<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("payments/add");
$can_edit = ACL::is_allowed("payments/edit");
$can_view = ACL::is_allowed("payments/view");
$can_delete = ACL::is_allowed("payments/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class="">
                        <!-- Page bread crumbs components-->
                        <?php
                        if(!empty($field_name) || !empty($_GET['search'])){
                        ?>
                        <hr class="sm d-block d-sm-none" />
                        <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                            <ul class="breadcrumb m-0 p-1">
                                <?php
                                if(!empty($field_name)){
                                ?>
                                <li class="breadcrumb-item">
                                    <a class="text-decoration-none" href="<?php print_link('payments'); ?>">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                </li>
                                <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                    <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                </li>
                                <?php 
                                }   
                                ?>
                                <?php
                                if(get_value("search")){
                                ?>
                                <li class="breadcrumb-item">
                                    <a class="text-decoration-none" href="<?php print_link('payments'); ?>">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item text-capitalize">
                                    Search
                                </li>
                                <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                        <!--End of Page bread crumbs components-->
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class=" animated fadeIn page-content">
                        <?php
                        $today = date('Y-m-d');
                        $from_date = $_GET['from_date'] ?? $today;
                        $to_date   = $_GET['to_date']   ?? $today;
                        $service = $_GET['service'] ?? '';
                        $jei = new User_infoController();
                        $db = $jei->GetModel();
                        $db->where("DATE(timestamp)", $from_date, ">=");
                        $db->where("DATE(timestamp)", $to_date, "<=");
                        $db->where("payment_mode","","!=");
                        if(!empty($service)){
                        $db->where("db_name", $service);
                        }
                        $services = $jei->GetModel()->rawQuery("SELECT DISTINCT db_name FROM payments ORDER BY db_name");
                        $records = $db->get("payments");
                        function service_name_display($name){
                        if($name == "cc"){
                        return "WATER TECHNICAL CC";
                        }
                        if($name == "oc"){
                        return "WATER TECHNICAL OC";
                        }
                        return strtoupper(str_replace('_',' ',$name));
                        }
                        ?>
                        <!DOCTYPE html>
                        <html lang="mr">
                            <head>
                                <meta charset="UTF-8">
                                    <title>KDMC Water Detailed Challan Report</title>
                                    <style>
                                        body{
                                        font-family: Arial,"Noto Sans Devanagari",sans-serif;
                                        font-size:14px;
                                        margin:20px;
                                        line-height:1.5;
                                        }
                                        .report-form{
                                        background:#f9f9f9;
                                        padding:15px;
                                        border:1px solid #ccc;
                                        border-radius:5px;
                                        margin-bottom:25px;
                                        display:inline-block;
                                        }
                                        .report-form label{
                                        font-weight:bold;
                                        color:#003366;
                                        margin-right:8px;
                                        }
                                        .report-form input[type="date"]{
                                        padding:6px 10px;
                                        border:1px solid #ccc;
                                        border-radius:4px;
                                        }
                                        .report-form button{
                                        background:#003366;
                                        color:white;
                                        padding:8px 16px;
                                        border:none;
                                        border-radius:4px;
                                        cursor:pointer;
                                        font-weight:bold;
                                        }
                                        .challan-table{
                                        width:100%;
                                        border-collapse:collapse;
                                        font-size:14px;
                                        margin-top:15px;
                                        }
                                        .challan-table th,
                                        .challan-table td{
                                        border:1px solid #000;
                                        padding:10px;
                                        }
                                        .challan-table th{
                                        background:#003366;
                                        color:white;
                                        text-align:center;
                                        }
                                        .center{text-align:center;}
                                        .right{text-align:right;}
                                        .bold{font-weight:bold;}
                                        .receipt-link{
                                        color:#003366;
                                        font-weight:bold;
                                        text-decoration:underline;
                                        cursor:pointer;
                                        }
                                        .receipt-link:hover{
                                        color:#d63384;
                                        }
                                        @media print{
                                        .report-form{display:none;}
                                        body{margin:15mm;}
                                        .receipt-link{
                                        text-decoration:none;
                                        color:black;
                                        }
                                        }
                                    </style>
                                </head>
                                <body>
                                    <h2 style="color:#003366;">वसुली चलन तपशील अहवाल</h2>
                                    <br>
                                        <form method="GET" class="report-form">
                                            <label>दिनांकापासून :</label>
                                            <input type="date" name="from_date" value="<?= htmlspecialchars($from_date) ?>">
                                                <label style="margin-left:15px;">दिनांकापर्यंत :</label>
                                                <input type="date" name="to_date" value="<?= htmlspecialchars($to_date) ?>">
                                                    <label style="margin-left:15px;">Service :</label>
                                                    <select name="service" style="padding:6px 10px;border:1px solid #ccc;border-radius:4px;">
                                                        <option value="">All Services</option>
                                                        <?php
                                                        $priority = ["cc","oc"];
                                                        $sorted_services = [];
                                                        foreach($priority as $p){
                                                        foreach($services as $srv){
                                                        if($srv['db_name'] == $p){
                                                        $sorted_services[] = $srv;
                                                        }
                                                        }
                                                        }
                                                        foreach($services as $srv){
                                                        if(!in_array($srv['db_name'],$priority)){
                                                        $sorted_services[] = $srv;
                                                        }
                                                        }
                                                        foreach($sorted_services as $srv){
                                                        ?>
                                                        <option value="<?= $srv['db_name'] ?>"
                                                            <?= ($service == $srv['db_name']) ? 'selected' : '' ?>>
                                                            <?= service_name_display($srv['db_name']) ?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                    <button type="submit">अहवाल दाखवा</button>
                                                </form>
                                                <table class="challan-table">
                                                    <tr>
                                                        <td colspan="6" class="center">
                                                            <div style="margin-bottom:10px;">
                                                                <img src="<?php echo SITE_ADDR ?>assets/images/logo.png" style="height:80px;">
                                                                </div>
                                                                <h2 style="margin:0;color:#003366;">कल्याण डोंबिवली महानगरपालिका</h2>
                                                                <h5 style="margin:0;">पाणी पुरवठा विभाग</h5>
                                                                <p style="margin:5px 0;">
                                                                    दिनांकापासून :
                                                                    <?= date('d-m-Y',strtotime($from_date)) ?>
                                                                    &nbsp;&nbsp;
                                                                    दिनांकापर्यंत :
                                                                    <?= date('d-m-Y',strtotime($to_date)) ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Service Name</th>
                                                            <th>Software Application No.</th>
                                                            <th>Transaction ID</th>
                                                            <th>Receipt No.</th>
                                                            <th class="right">Amount (₹)</th>
                                                        </tr>
                                                        <?php
                                                        $total_amount = 0;
                                                        if(!empty($records)){
                                                        foreach($records as $data){
                                                        $total_amount += $data['amount'];
                                                        /* Fetch SW Code */
                                                        $jei2 = new User_infoController();
                                                        $db2 = $jei2->GetModel();
                                                        $db2->where("paid", $data['id']);
                                                        $table_name = 'application_form'.($data['db_name']=="oc" ? "_oc" : "");
                                                        $prefixDetails = $db2->getOne($table_name, "*");
                                                        if($prefixDetails){
                                                        $sw_code = $prefixDetails['application_no'] ?? 'N/A';
                                                        }else{
                                                        $sw_code = 'N/A';
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td class="center">
                                                                <?= date("d-m-Y",strtotime($data['timestamp'])) ?>
                                                            </td>
                                                            <td>
                                                                <?= service_name_display($data['db_name']) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= htmlspecialchars($sw_code) ?>
                                                            </td>
                                                            <td class="center">
                                                                <?= $data['payment_cash_collection_center'] ?>
                                                            </td>
                                                            <td class="center">
                                                                <a class="receipt-link" href="<?= SITE_ADDR ?>payments/view/<?= $data['id'] ?>" target="_blank">
                                                                    <?= $data['id'] ?>
                                                                </a>
                                                            </td>
                                                            <td class="right bold">
                                                                <?= number_format($data['amount'],2) ?> /-
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                        <tr style="background:#e6ffe6;font-weight:bold;">
                                                            <td colspan="5" class="right">Total</td>
                                                            <td class="right" style="color:green;font-weight:bold;">
                                                                <?= number_format($total_amount,2) ?> /-
                                                            </td>
                                                        </tr>
                                                        <?php } else { ?>
                                                        <tr>
                                                            <td colspan="6" class="center" style="padding:40px;">
                                                                या कालावधीत कोणताही रेकॉर्ड सापडला नाही
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </table>
                                                    <div style="margin-top:25px;">
                                                        <button onclick="window.print()" style="padding:10px 20px;background:#28a745;color:white;border:none;border-radius:5px;cursor:pointer;">
                                                            प्रिंट / Print
                                                        </button>
                                                    </div>
                                                </body>
                                            </html>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
