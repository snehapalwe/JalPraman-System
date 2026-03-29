<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("application_form_oc/add");
$can_edit = ACL::is_allowed("application_form_oc/edit");
$can_view = ACL::is_allowed("application_form_oc/view");
$can_delete = ACL::is_allowed("application_form_oc/delete");
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
                                $jei = new User_infoController();
                                $db = $jei->GetModel();
                                
                                $db->where("rec_id", $data['id']);
                                $appl = $db->getOne('payments', "*");
                                
                                $cc_letter_no = isset($data['cc_letter_no']) ? $data['cc_letter_no'] : '________';
                                $cc_letter_date = isset($data['cc_letter_date']) ? date("d-m-Y", strtotime($data['cc_letter_date'])) : '________';
                                
                                $compliance_no = isset($data['compliance_no']) ? $data['compliance_no'] : '________';
                                $compliance_date = isset($data['compliance_date']) ? date("d-m-Y", strtotime($data['compliance_date'])) : '________';
                                // print_R($data);
                                $db->where("application_no", $data['cc_number']);
                                $application_f = $db->getOne('application_form', "*");
                            ?>
                            
                            <!doctype html>
                            <html lang="en">
                            <head>
                                <meta charset="utf-8">
                                <meta name="viewport" content="width=device-width,initial-scale=1">
                                <title>KDMC Tippani - Water Supply (OC)</title>
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
                                        max-width: 800px;
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
                            
                                    .placeholder {
                                        text-decoration: underline dotted;
                                        color: #555;
                                        font-style: italic;
                                    }
                            
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
                            </head>
                            <body>
                            
                            <div class="no-print" style="text-align: right; margin: 15px 35px;">
                                
                                <button onclick="toggleEdit(true)" class="btn btn-primary no-print">Edit</button>
<button onclick="toggleEdit(false)" class="btn btn-success no-print">Lock</button>



                                <button onclick="window.print()" style="
                                    padding: 8px 16px;
                                    background-color: #4a90e2;
                                    color: #fff;
                                    border: none;
                                    border-radius: 4px;
                                    cursor: pointer;
                                    font-weight: bold;
                                ">Print</button>
                            </div>
                            
                            <div class="page">
                                <div class="center">
                                    <center>
                                        <IMG SRC='<?php echo SITE_ADDR . SITE_LOGO ?>' WIDTH='100PX' />
                                    </center>
                                    <div><strong>KALYAN DOMBIVLI MUNICIPAL CORPORATION</strong></div>
                                    <div><strong>WATER SUPPLY DEPARTMENT</strong></div>
                                </div>
                            
                                <p><br>TO, <br><br>
                                    <?php echo $data['landowner_or_applicant_name']; ?> (DEVELOPERS)<br>
                                    <?php echo $data['licensed_architect_or_engineers_name']; ?> (ARCHITECTS)<br>
                                </p>
                            
                                <p class="subject">
                                    SUB: TECHNICAL NOC OF WATER SUPPLY FOR OCCUPATION CERTIFICATE OF DEVELOPMENT PROPOSAL ON LAND BEARING
                                    S.NO. <?php echo $data['survey_no']; ?> H.NO. <?php echo $data['house_no']; ?> 
                                    VILLAGE <?php echo $data['village_name']; ?> 
                                    TAL. <?php echo $data['taluka_name']; ?>
                                </p>
                            
                                <p>
                                    <!--<div class="editable-section" contenteditable="true"> REF : 1. TECHNICAL NOC OF WATER SUPPLY FOR COMMENCEMENT CERTIFICATE GRANTED BY THIS OFFICE VIDE LETTER NO. -->
                                    <!--<?php echo $application_f['application_no']; ?> DATED <?php echo (!empty($application_f['timestamp']) && strtotime($application_f['timestamp']) > 0) ? date("d-m-Y", strtotime($application_f['timestamp'])) : "___________"; ?>-->
                                    <!--</div> -->
                                    REF : 1. YOUR APPLICATION NO. <?php echo $data['application_no']; ?> DATED <?php echo date("d-m-Y", strtotime($data['timestamp'])); ?><br>
                                    <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. COMPLIANCE LETTER OF ARCHITECT -->
                                    <!--<span class="placeholder"></span> DATED <?php echo date("d-m-Y", strtotime($data['timestamp'])); ?> -->
                                </p>
                            
                                <p>SIR,</p>
                             <div>
                                  <!--class="editable-section" contenteditable="true"-->
                                 Since the Water Technical NOC was not granted at the time of issuance of the Commencement Certificate, the Occupancy Certificate may be granted as per rules.
                                 
                                 
                                <!--<p class="indent">-->
                                <!--    TECHNICAL NOC OF WATER SUPPLY FOR COMMENCEMENT CERTIFICATE OF DEVELOPMENT PROPOSAL ON LAND BEARING -->
                                <!--    S.NO. <?php echo $data['survey_no']; ?> H.NO. <?php echo $data['house_no']; ?> -->
                                <!--    VILLAGE <?php echo $data['village_name']; ?> -->
                                <!--    TAL. <?php echo $data['taluka_name']; ?> IS GRANTED WITH CERTAIN CONDITIONS/ REQUIREMENTS BY THIS OFFICE VIDE LETTER NO. -->
                                <!--    <?php echo $application_f['application_no']; ?> DATED <?php echo (!empty($application_f['timestamp']) && strtotime($application_f['timestamp']) > 0) ? date("d-m-Y", strtotime($application_f['timestamp'])) : "___________"; ?>-->
                                <!--</p>-->
                            
                                <!--<p class="indent">-->
                                <!--    NOW YOU / YOUR ARCHITECTS HAVE SUBMITTED THE COMPLIANCE LETTER / UNDER REF NO 3. REGARDING COMPLIANCE OF THE CONDITIONS / REQUIREMENTS MENTIONED IN TECHNICAL NOC UNDER REF NO 1.-->
                                <!--</p>-->
                            
                                <!--<p class="indent">-->
                                <!--    CONSIDERING THE ABOVE COMPLIANCE LETTER OF ARCHITECTS / DEVELOPERS WATER SUPPLY DEPT HAS NO OBJECTION TO GRANT OCCUPATION CERTIFICATE FOR THIS DEVELOPMENT PROPOSAL.-->
                                <!--</p>-->
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
                            
                            </body>
                            </html>
                                            </div></div>
                                
                                                                       

                                    </div>
                                    
                                    
                                    
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
        .editable-section{
    border: 2px dashed #999;
    padding: 6px;
    margin-bottom: 6px;
    background:#fffef7;
    cursor:text;
}

@media print{
    .editable-section{
        border:none !important;
        background:#fff !important;
    }
}

      </style>
      <script>
function toggleEdit(flag){
    document.querySelectorAll(".editable-section")
        .forEach(el => el.contentEditable = flag);
}
</script>

      
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
                        </section>
