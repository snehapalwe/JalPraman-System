<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("payments/add");
$can_edit = ACL::is_allowed("payments/edit");
$can_view = ACL::is_allowed("payments/view");
$can_delete = ACL::is_allowed("payments/delete");
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
                    <h4 class="record-title"><strong style='color: black;'>VIEW RECEIPT</strong></h4>
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
                        <div class="col-md-12 comp-grid">
                            <?php $this :: display_page_errors(); ?>
                            <div  class="card animated fadeIn page-content">
                                <?php
                                $jei=new User_infoController();
                                $db = $jei->GetModel();
                                $rec_no=$data['id'];
                                if(date("m")>=4){
                                $rec_no="KDMC/".(date("y")).(date("y")+1)."/$rec_no";
                                }else{ 
                                $rec_no="KDMC/".(date("y")-1).(date("y"))."/$rec_no";
                                }
                                $dem="Tree Cutting Permission fee / वृक्षतोड परवानगी शुल्क";
                                if("application_form"=="application_form"){
                                $dem="WATER TECHNICAL NOC";
                                }
                                if("application_form"=="occupancy_certificate"){
                                $dem="वृक्ष प्राधिकरण विभागाचा बांधकाम अंतिम ना-हरकत दाखला";
                                }
                                ?>
                                <!DOCTYPE html>
                                <html lang="en">
                                    <head>
                                        <meta charset="UTF-8">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                <title>Receipt</title>
                                            </head>
                                            <body>
                                                <?php
                                                // Function to convert number to Marathi words
                                                function numberToMarathiWords($number) {
                                                $marathiNumbers = [
                                                0 => 'शून्य', 1 => 'एक', 2 => 'दोन', 3 => 'तीन', 4 => 'चार',
                                                5 => 'पाच', 6 => 'सहा', 7 => 'सात', 8 => 'आठ', 9 => 'नऊ',
                                                10 => 'दहा', 11 => 'अकरा', 12 => 'बारा', 13 => 'तेरा', 14 => 'चौदा',
                                                15 => 'पंधरा', 16 => 'सोळा', 17 => 'सतरा', 18 => 'अठरा', 19 => 'एकोणीस',
                                                20 => 'वीस', 21 => 'एकवीस', 22 => 'बावीस', 23 => 'तेवीस', 24 => 'चोवीस',
                                                25 => 'पंचवीस', 26 => 'सव्वीस', 27 => 'सत्तावीस', 28 => 'अठावीस', 29 => 'एकोणतीस',
                                                30 => 'तीस', 31 => 'एकतीस', 32 => 'बत्तीस', 33 => 'तेहतीस', 34 => 'चौतीस',
                                                35 => 'पस्तीस', 36 => 'छत्तीस', 37 => 'सदतीस', 38 => 'अडतीस', 39 => 'एकोणचाळीस',
                                                40 => 'चाळीस', 41 => 'एक्केचाळीस', 42 => 'बेचाळीस', 43 => 'त्रेचाळीस', 44 => 'चव्वेचाळीस',
                                                45 => 'पंचेचाळीस', 46 => 'सेहेचाळीस', 47 => 'सत्तेचाळीस', 48 => 'अठ्ठेचाळीस', 49 => 'एकोणपन्नास',
                                                50 => 'पन्नास', 60 => 'साठ', 70 => 'सत्तर', 80 => 'ऐंशी', 90 => 'नव्वद'
                                                // Extend further as needed
                                                ];
                                                $words = '';
                                                if ($number >= 1000) {
                                                $thousands = floor($number / 1000);
                                                $number %= 1000;
                                                $words .= ($marathiNumbers[$thousands] ?? '') . ' हजार ';
                                                }
                                                if ($number >= 100) {
                                                $hundreds = floor($number / 100);
                                                $number %= 100;
                                                $words .= ($marathiNumbers[$hundreds] ?? '') . 'शे ';
                                                }
                                                if ($number > 0) {
                                                $words .= ($marathiNumbers[$number] ?? '');
                                                }
                                                return trim($words);
                                                }
                                                $amountInMarathi = numberToMarathiWords($data['amount']);
                                                // Format timestamp to show only the date
                                                $formattedTimestamp = !empty($data['timestamp']) && strtotime($data['timestamp']) 
                                                ? date('d-m-Y', strtotime($data['timestamp'])) 
                                                : '';
                                                $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                                $jei=new User_infoController();
                                                $db=$jei->GetModel();
                                                $db->where("paid", $data['id']);
                                                // $prefixDetails = $db->getOne("application_form", "*");
                                                // $application_id = isset($prefixDetails['id']) ? $prefixDetails['id'] : 'N/A';
                                                // $application_final_id = $prefixDetails['id'];
                                                $prefixDetails = $db->getOne('application_form'.($data['db_name']=="oc"?"_oc":""), "*");
                                                 
                                                if($prefixDetails) {
                                                $application_id = $prefixDetails['id'] ?? 'N/A';
                                                $application_final_id = $prefixDetails['id'] ?? 'N/A';
                                                } else {
                                                $application_id = 'N/A';
                                                $application_final_id = 'N/A';
                                                }
                                                ?>
                                                <div class="container">
                                                    <style>
                                                        @media print {
                                                        body *, #main * { display:none; }
                                                        #main, #main #printarea, #main #printarea * { display:block ; }
                                                        }
                                                    </style>
                                                    <div>
                                                        <a href="#"  class="btn btn-danger" onclick="printDiv('printarea')"  >PRINT</a>
                                                    </div>
                                                    <div id="main" class>
                                                        <div id="printarea">
                                                            <style>
                                                                body {
                                                                font-family: Arial, sans-serif;
                                                                margin: 40px; /* Margin outside the entire receipt */
                                                                line-height: 1.2;
                                                                background-color: #fff; /* White background to match the receipt */
                                                                }
                                                                .container {
                                                                width: 100%;
                                                                max-width: 800px;
                                                                margin: 0 auto; /* Centering the container */
                                                                padding: 20px; /* Internal spacing */
                                                                }
                                                                .receipt-section {
                                                                position: relative; /* For absolute positioning of copy-label */
                                                                margin-bottom: 20px; /* Space between sections */
                                                                }
                                                                .header-container {
                                                                display: flex;
                                                                justify-content: space-between; /* Space between logo, title, and QR code */
                                                                align-items: center; /* Vertically center the items */
                                                                margin-bottom: 10px;
                                                                }
                                                                .title-section {
                                                                text-align: center; /* Center the title text */
                                                                flex-grow: 1; /* Allow the title section to take up remaining space */
                                                                }
                                                                .header {
                                                                font-size: 18px;
                                                                font-weight: bold;
                                                                margin-bottom: 5px;
                                                                color: #000;
                                                                }
                                                                .subheader {
                                                                font-size: 16px;
                                                                color: #000;
                                                                }
                                                                .logo {
                                                                width: 117.125px; /* Doubled size */
                                                                height: 117.125px;
                                                                }
                                                                .qr-code {
                                                                width: 100px;
                                                                height: 100px;
                                                                }
                                                                .copy-label {
                                                                position: absolute;
                                                                top: -20px; /* Moved up to avoid closeness to QR code */
                                                                right: 0;
                                                                font-size: 12px;
                                                                color: #000;
                                                                }
                                                                table {
                                                                width: 100%;
                                                                border-collapse: collapse;
                                                                margin-bottom: 10px;
                                                                border: 2px solid #000; /* Bold outer border on table */
                                                                }
                                                                th, td {
                                                                border: 1px solid #000; /* Thin inner borders */
                                                                padding: 5px; /* Reduced padding to match the compact look */
                                                                text-align: left;
                                                                font-size: 12px;
                                                                }
                                                                th {
                                                                font-weight: normal;
                                                                }
                                                                .signature {
                                                                text-align: right;
                                                                font-size: 12px;
                                                                margin-top: 40px; /* Space above signature */
                                                                color: #000;
                                                                }
                                                                .footer {
                                                                font-size: 10px;
                                                                margin-top: 10px;
                                                                color: #000;
                                                                text-align: left; /* Left-aligned footer */
                                                                }
                                                                .divider {
                                                                border-top: 2px dashed #000; /* Dashed line for divider */
                                                                margin: 20px 0;
                                                                text-align: center;
                                                                position: relative;
                                                                }
                                                                .divider::before {
                                                                content: '✂'; /* Scissor icon */
                                                                position: absolute;
                                                                top: -10px;
                                                                left: 50%;
                                                                transform: translateX(-50%);
                                                                font-size: 14px;
                                                                background-color: #fff;
                                                                padding: 0 5px;
                                                                }
                                                                .print-button {
                                                                display: block;
                                                                width: 150px;
                                                                margin: 20px auto 20px; /* Space above and below */
                                                                padding: 10px;
                                                                background-color: #007bff;
                                                                color: #fff;
                                                                text-align: center;
                                                                border: none;
                                                                border-radius: 5px;
                                                                cursor: pointer;
                                                                font-size: 14px;
                                                                }
                                                                .print-button:hover {
                                                                background-color: #0056b3;
                                                                }
                                                                @media print {
                                                                .print-button {
                                                                display: none; /* Hide the print button during printing */
                                                                }
                                                                .container {
                                                                margin: 0;
                                                                padding: 0;
                                                                }
                                                                body {
                                                                margin: 0;
                                                                background-color: #fff;
                                                                }
                                                                }
                                                            </style>
                                                            <?php if(USER_ROLE != 2){ ?>
                                                            <!-- Office Copy -->
                                                            <div class="receipt-section">
                                                                <div class="header-container">
                                                                    <img src="<?php echo SITE_ADDR ?>assets/images/logo.png" class="logo" alt="Logo">
                                                                        <!-- Alternative path: <img src="<?php echo SITE_ADDR ?>assets/images/logo.png" class="logo" alt="Logo"> -->
                                                                            <div class="title-section">
                                                                                <div class="header">कल्याण डोंबिवली महानगरपालिका  </div>
                                                                                <div class="subheader">Receipt / पावती</div>
                                                                            </div>
                                                                            <img src="<?php echo SITE_ADDR ?>qr.php?d=<?php echo SITE_ADDR ?>payments/view/<?php echo $data['id'] ?>" class="qr-code" width="100px">
                                                                            </div>
                                                                            <div class="copy-label">Office Copy</div>
                                                                            <table>
                                                                                <tr>
                                                                                    <th>Receipt No./पावती क्र.</th>
                                                                                    <td><?php echo $rec_no; ?></td>
                                                                                    <th>Date of Receipt/दिनांक</th>
                                                                                    <td><?php echo $data['timestamp']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>CFC Reference/सी.एफ.सी निदेश</th>
                                                                                    <td></td>
                                                                                    <th>Counter Reference/खिडकी निदेश</th>
                                                                                    <td></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Received From/कोणाकडून</th>
                                                                                    <td colspan="3"><?php echo $data['payment_person']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Amount/रक्कम</th>
                                                                                    <td colspan="3"><?php echo $data['amount']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Amount In Words/अक्षरी रक्कम</th>
                                                                                    <td colspan="3"><?php echo $amountInMarathi; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Function/कार्य किंवा सेवा </th>
                                                                                    <td colspan="3"><?php echo $dem ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Payment Mode/देय प्रकार</th>
                                                                                    <td><?php echo $data['payment_mode']; ?></td>
                                                                                    <th>Amount/रक्कम</th>
                                                                                    <td><?php echo $data['amount']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Bank Name/बँकेचे नाव</th>
                                                                                    <!-- <td colspan="3"><?php echo $data['bankname']; ?></td> -->
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Application No./अर्ज क्रमांक</th>
                                                                                    <td><?php echo $application_final_id; ?></td>
                                                                                    <th>Date/दिनांक</th>
                                                                                    <td><?php echo $data['timestamp']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Details/माहिती</th>
                                                                                    <td><?php echo $data['amount']; ?></td>
                                                                                    <th>Payable Amount/देय रक्कम</th>
                                                                                    <td><?php echo $data['amount']; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Received Amount/स्वीकारलेली रक्कम</th>
                                                                                    <td><?php echo $data['amount']; ?></td>
                                                                                    <th>Total Received Amt/एकूण स्वीकारलेली रक्कम</th>
                                                                                    <td><?php echo $data['amount']; ?></td>
                                                                                </tr>
                                                                            </table>
                                                                                <br><p style="text-align: center;  ">This is computer generated document, hence requires no signature. </p>
                                                                                    <!--<div class="footer">/30-05-2025</div>-->
                                                                                </div>
                                                                                <!-- Divider -->
                                                                                <div class="divider"></div>
                                                                                <?php } ?>
                                                                                <!-- Customer Copy -->
                                                                                <div class="receipt-section">
                                                                                    <div class="header-container">
                                                                                        <img src="<?php echo SITE_ADDR ?>assets/images/logo.png" class="logo" alt="Logo">
                                                                                            <!-- Alternative path: <img src="<?php echo SITE_ADDR ?>assets/images/logo.png" class="logo" alt="Logo"> -->
                                                                                                <div class="title-section">
                                                                                                    <div class="header">कल्याण डोंबिवली महानगरपालिका  </div>
                                                                                                    <div class="subheader">Receipt / पावती</div>
                                                                                                </div>
                                                                                                <img src="<?php echo SITE_ADDR ?>qr.php?d=<?php echo SITE_ADDR ?>payments/view/<?php echo $data['id'] ?>" class="qr-code" width="100px">
                                                                                                </div>
                                                                                                <div class="copy-label">Customer Copy</div>
                                                                                                <table>
                                                                                                    <tr>
                                                                                                        <th>Receipt No./पावती क्र.</th>
                                                                                                        <td><?php echo $rec_no; ?></td>
                                                                                                        <th>Date of Receipt/दिनांक</th>
                                                                                                        <td><?php echo $data['timestamp']; ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>CFC Reference/सी.एफ.सी निदेश</th>
                                                                                                        <td></td>
                                                                                                        <th>Counter Reference/खिडकी निदेश</th>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Received From/कोणाकडून</th>
                                                                                                        <td colspan="3"><?php echo $data['payment_person']; ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Amount/रक्कम</th>
                                                                                                        <td colspan="3"><?php echo $data['amount']; ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Amount In Words/अक्षरी रक्कम</th>
                                                                                                        <td colspan="3"><?php echo $amountInMarathi; ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Function/कार्य किंवा सेवा </th>
                                                                                                        <td colspan="3"><?php echo $dem ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Payment Mode/देय प्रकार</th>
                                                                                                        <td><?php echo $data['payment_mode']; ?></td>
                                                                                                        <th>Amount/रक्कम</th>
                                                                                                        <td><?php echo $data['amount']; ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Bank Name/बँकेचे नाव</th>
                                                                                                        <!-- <td colspan="3"><?php echo $data['bankname']; ?></td> -->
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Application No./अर्ज क्रमांक</th>
                                                                                                        <td><?php echo $application_final_id; ?></td>
                                                                                                        <th>Date/दिनांक</th>
                                                                                                        <td><?php echo $data['timestamp']; ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Details/माहिती</th>
                                                                                                        <td><?php echo $data['amount']; ?></td>
                                                                                                        <th>Payable Amount/देय रक्कम</th>
                                                                                                        <td><?php echo $data['amount']; ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th>Received Amount/स्वीकारलेली रक्कम</th>
                                                                                                        <td><?php echo $data['amount']; ?></td>
                                                                                                        <th>Total Received Amt/एकूण स्वीकारलेली रक्कम</th>
                                                                                                        <td><?php echo $data['amount']; ?></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                <br><p style="text-align: center;  ">This is computer generated document, hence requires no signature. </p>
                                                                                                    </div>
                                                                                                </div>
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
                                                                                    </body>
                                                                                </html>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
