<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("application_form/add");
$can_edit = ACL::is_allowed("application_form/edit");
$can_view = ACL::is_allowed("application_form/view");
$can_delete = ACL::is_allowed("application_form/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $jei=new User_infoController();
                        $db=$jei->GetModel();
                        $db->where("id",$data['paid']);
                        $appl=$db->getOne('payments',"*");
                        $fee_id = "WATER/" . $appl['id'];
                        $db->where("rec_id", $data['id']); 
                        $plan = $db->getOne("information_of_plan", "*");
                        $pipe_line_info = $plan['extending_or_laying_new_pipe_lines_of'];
                        $additioanl_sump_pump = $plan['additional_sump_and_pump_house_of_society'];
                        ?>
                        <!doctype html>
                        <html lang="en">
                            <head>
                                <meta charset="utf-8">
                                    <meta name="viewport" content="width=device-width,initial-scale=1">
                                        <title>KDMC Tippani - Water Supply</title>
                                     
                                    </head>
                                    <body>
                                        <!-- Everything outside this wrapper will be hidden in print -->
                                        
                                                    <style>
                            @media print {
                            body *, #main * { display:none; }
                            #main, #main #printarea, #main #printarea * { display:block ; }
                            }
                        </style>
                        <div>
                            <button onclick="toggleEdit(true)" class="btn btn-primary no-print">Edit</button>
<button onclick="toggleEdit(false)" class="btn btn-success no-print">Lock</button>


                            <a href="#"  class="btn btn-danger" onclick="printDiv('printarea')"  >PRINT</a>
                        </div>
                        <div id="main" class>
                            <div id="printarea">
                                
                                
                                          <style>
                                            @page { 
                                            size: A4; 
                                            margin: 15mm 20mm; 
                                            }
                                            body {
                                            font-family: "Times New Roman", Arial, Helvetica, sans-serif;
                                            font-size: 13px;
                                            line-height: 1.6;
                                            color: #000;
                                            background: #fdfdfd;
                                            margin: 0;
                                            padding: 0;
                                            -webkit-print-color-adjust: exact;
                                            }
                                            .page {
                                            width: 100%;
                                            max-width: 1000px;
                                            margin: 20px auto;
                                            background: #fff;
                                            padding: 25px 35px;
                                            border: 1px solid #000;
                                            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
                                            box-sizing: border-box;
                                            }
                                            .page * {
                                            border: none !important;
                                            box-sizing: border-box;
                                            }
                                            .center {
                                            text-align: center;
                                            margin-bottom: 15px;
                                            }
                                            .center strong {
                                            display: block;
                                            font-size: 15px;
                                            text-transform: uppercase;
                                            letter-spacing: 0.5px;
                                            }
                                            .subject {
                                            text-decoration: underline;
                                            font-weight: bold;
                                            margin: 18px 0;
                                            font-size: 14px;
                                            }
                                            p { margin: 6px 0; }
                                            .indent { margin-left: 25px; text-align: justify; }
                                            .signature {
                                            margin-top: 50px;
                                            text-align: right;
                                            font-weight: bold;
                                            font-size: 13px;
                                            }
                                            .copies {
                                            margin-top: 40px;
                                            font-size: 13px;
                                            }
                                            .copies strong {
                                            display: block;
                                            margin-bottom: 8px;
                                            text-decoration: underline;
                                            }
                                            .copies ol { margin: 0; padding-left: 25px; }
                                            .infra { margin: 10px 0 10px 40px; }
                                            .infra li { margin-bottom: 3px; }
                                            .placeholder {
                                            text-decoration: underline dotted;
                                            color: #555;
                                            font-style: italic;
                                            }
                                            /* Hide unwanted UI elements during print */
                                            @media print {
                                            body { background: #fff; margin: 0; padding: 0; }
                                            .page {
                                            border: none;
                                            box-shadow: none;
                                            width: 100%;
                                            margin: 0;
                                            padding: 15mm 20mm;
                                            }
                                            button,
                                            .no-print {
                                            display: none !important;
                                            visibility: hidden !important;
                                            height: 0 !important;
                                            }
                                            }
                                        </style>
                                        <!-- ✅ Tippani content starts -->
                                        <div class="page">
                                            <div class="center">
                                                <div><strong>KALYAN DOMBIVLI MUNICIPAL CORPORATION</strong></div>
                                                <div><strong>WATER SUPPLY DEPARTMENT</strong></div>
                                            </div>
                                            <p><br>TO, <br><br>
                                                <?php echo $data['landowner_or_applicant_name']; ?> (DEVELOPERS)<br>
                                                    <?php echo $data['licensed_architect_or_engineers_name']; ?> (ARCHITECTS)<br>
                                                    </p>
                                                    <p class="subject">
                                                        SUB: TECHNICAL NOC OF WATER SUPPLY FOR DEVELOPMENT PROPOSAL ON LAND BEARING
                                                        S.NO. <?php echo $data['survey_no']; ?> H.NO. <?php echo $data['house_no']; ?> 
                                                        CTS NO. <?php echo $data['cts_no']; ?> VILLAGE <?php echo $data['village_name']; ?> 
                                                        TAL. <?php echo $data['taluka_name']; ?>
                                                    </p>
                                                    <p>
                                                        REF : 1. YOUR APPLICATION NO. <?php echo $data['application_no']; ?> DATE <?php echo date("d-m-Y", strtotime($data['timestamp'])); ?><br>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. SCRUTINY FEE RECEIPT NO. <span><?php echo $fee_id ; ?></span> DATE <span><?php echo (!empty($appl['timestamp']) && strtotime($appl['timestamp']) > 0) ? date("d-m-Y", strtotime($appl['timestamp'])): "___________"; ?></span>
                                                        </p>
                                                        <p>SIR,</p>
                                                        <div id="editableSection" contenteditable="true" class="editable-block">
                                                            
                                                        <p class="indent">REGARDING YOUR APPLICATION UNDER REFERENCE NO 1. THIS IS TO INFORM THAT</p>
                                                        <p class="indent">A) AT PRESENT SUFFICIENT KDMC WATER SUPPLY IS AVAILABLE / NOT AVAILABLE FOR THE DEVELOPMENT PROPOSAL.</p>
                                                        <p class="indent">B) AT PRESENT ADEQUATE INFRASTRUCTURE OF KDMC WATER SUPPLY IS AVAILABLE / NOT AVAILABLE FOR THE AREA UNDER DEVELOPMENT PROPOSAL.</p>
                                                        <p class="indent">C) DUE TO NON AVAILABILITY / INADEQUATE INFRASTRUCTURE IN THE AREA UNDER DEVELOPMENT PROPOSAL, KDMC WATER SUPPLY HAS TO BE IMPROVED BY PROVIDING THE INFRASTRUCTURE AS SHOWN IN THE ENCLOSED DRAWING / PLAN BY CONSTRUCTING :</p>
                                                        <ul class="infra">
                                                            <li>ADDITIONAL SUMP & PUMP HOUSE OF CAPACITY <span><?php echo $additioanl_sump_pump ?></span> MLD</li>
                                                            <li>GROUND SERVICE RESERVOIR OF CAPACITY <span><?php echo $data['size_and_capcity_of_ug_tank_proposed']; ?></span> MLD</li>
                                                            <li>ELEVATED SERVICE RESERVOIR OF CAPACITY <span><?php echo $data['size_and_capcity_of_oh_tank_proposed']; ?></span> MLD</li>
                                                            <li>EXTENDING & / OR LAYING NEW PIPE LINES OF <span><?php echo $pipe_line_info; ?></span> MM DIA</li>
                                                            <li>ADDITIONAL CROSS CONNECTIONS</li>
                                                            <li>RAIN WATER HARVESTING STRUCTURES</li>
                                                            <li>SEPARATE OVER HEAD BOREWELL WATER TANK FOR TOILETS FLUSHING</li>
                                                        </ul>
                                                        <p class="indent">D) IT MAY PLEASE BE NOTED THAT SPACE / LAND FOR ABOVE IMPROVEMENT MEASURES IS REQUIRED TO BE RESERVED / DESIGNATED AT SUITABLE PLACES AS SHOWN & MARKED IN THE ENCLOSED DRAWING / PLAN.</p>
                                                        <p class="indent">E) IT IS SPECIFICALLY INFORMED THAT KDMC WILL CARRY OUT THE ABOVE IMPROVEMENT MEASURES AS PER THE AVAILABILITY OF MUNICIPAL FUNDS.</p>
                                                        <p class="indent">F) IN CASE OF URGENCY DEVELOPER MAY CARRY OUT THESE INFRASTRUCTURE DEVELOPMENT / IMPROVEMENT MEASURES AT HIS OWN COST IN LIEU OF AMENITY TDR IF PERMISSIBLE AS PER UDCPR & IN CONSULTATION UNDER SUPERVISION OF KDMC WATER SUPPLY DEPT.</p>
                                                        <p class="indent">G) IT MAY PLEASE BE NOTED THAT KDMC MAY GRANT / SANCTION THE REQUISITE WATER CONNECTIONS ONLY AFTER AVAILABILITY OF ADEQUATE INFRASTRUCTURE & WATER SUPPLY FOR THE DEVELOPMENT PROPOSAL.</p>
                                                       
</div>
                                                        <div class="signature">
                                                            <p>EXECUTIVE ENGINEER (WATER SUPPLY)<br>
                                                                KALYAN / DOMBIVLI DIVISION<br>
                                                                KDMC KALYAN</p>
                                                            </div>
                                                            <div class="copies">
                                                                <strong>COPY SUBMITTED TO</strong>
                                                                <ol>
                                                                    <li>HON. COMMISSIONER KDMC FOR INFORMATION PL.</li>
                                                                    <li>HON. CITY ENGINEER KDMC FOR INFORMATION PL.</li>
                                                                    <li>ASSISTANT DIRECTOR TOWN PLANNING KDMC FOR INFORMATION PL.</li>
                                                                    <li>TOWN PLANNER KDMC</li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                        <script>
                                                            // Optional: auto open print dialog when loaded
                                                            // window.onload = function() {
                                                            //     window.print();
                                                            // };
                                                        </script>
                                                    </body>
                                                </html>
                                            
                                            
                                              </div>
                                
                                                                       

                                    </div>
                                    
                                    
                                    <script>
function toggleEdit(flag){
    document.getElementById("editableSection").contentEditable = flag;
}
</script>

<style>
   .dotted-line {
            border-top: 4px dotted #000;
            position: relative;
        }

        .scissor-image {
            position: absolute;
            top: -17px; /* Adjust this value to position the scissor image correctly */
            left: 0%; /* Center the image horizontally */
            transform: translateX(-50%);
            width: 30px; /* Adjust the width of the scissor image */
        }
        
        .editable-block{
    border: 2px dashed #999;
    padding: 8px;
    background: #fffef7;
    cursor: text;
}

/* hide border in print */
@media print{
    .editable-block{
        border:none !important;
        background:#fff !important;
    }
}



      </style>
      
      
                                    <script>
                                        function printDiv(divName) {
                                        var printContents = document.getElementById(divName).innerHTML;
                                        var originalContents = document.body.innerHTML;
                                        document.body.innerHTML = printContents;
                                        window.print();
                                        
                            setTimeout(function() {
                document.body.innerHTML = originalContents;
            }, 2000);
                                        }
                                    </script>
                                    
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
