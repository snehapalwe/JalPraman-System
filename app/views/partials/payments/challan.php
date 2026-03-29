<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("demand/add");
$can_edit = ACL::is_allowed("demand/edit");
$can_view = ACL::is_allowed("demand/view");
$can_delete = ACL::is_allowed("demand/delete");
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
                <div class="col ">
                    <h4 class="record-title"><STRONG style="color: black;">CHALLAN REPORT</STRONG></h4>
                </div>
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
                                    <a class="text-decoration-none" href="<?php print_link('demand'); ?>">
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
                                    <a class="text-decoration-none" href="<?php print_link('demand'); ?>">
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
                        // ───────────────────────────────────────────────
                        // Challan Report Whole Code
                        // ───────────────────────────────────────────────
                        // Default to today's date
                        $today = date('Y-m-d');
                        $from_date = $_GET['from_date'] ?? $today;
                        $to_date   = $_GET['to_date']   ?? $today;
                        // Your exact filtering code
                        $jei = new User_infoController();
                        $db = $jei->GetModel();
                        $db->where("DATE(timestamp)", $from_date, ">=");
                        $db->where("DATE(timestamp)", $to_date, " <=");
                        $db->where("payment_mode","","!=");
                        // Fetch records - same as your list page
                        $records = $db->get("payments");
                        // Now group & sum in PHP (since no GROUP BY in your DB wrapper)
                        $grouped = [];
                        $grand_total = 0;
                        $receipt_ids = [];
                        foreach ($records as $data) {
                        $type = trim($data['payment_mode'] ?? '');
                        if ($type === '') continue;
                        $amount = floatval($data['amount'] ?? 0);
                        $grouped[$type] = ($grouped[$type] ?? 0) + $amount;
                        $grand_total += $amount;
                        $receipt_ids[] = $data['id'];
                        }
                        // Prepare display array
                        $display_records = [];
                        foreach ($grouped as $type => $sum) {
                        $display_records[] = [
                        'payment_mode'   => $type,
                        'total_amount'   => $sum
                        ];
                        }
                        // Receipt list
                        sort($receipt_ids, SORT_NUMERIC);
                        $receipt_list = implode(', ', $receipt_ids) ?: "—";
                        // Amount in words - REPLACE WITH YOUR REAL FUNCTION !!!
                        function eng_marathi($val){
                        if($val=="issuance_of_no_dues_certificate"){
                        return "थकबाकी नसल्याचा दाखला देणे";
                        }
                        }
                        function convertEnglishToMarathiNumerals($englishNumber) {
                        $englishNumerals = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                        $marathiNumerals = array('०', '१', '२', '३', '४', '५', '६', '७', '८', '९');
                        $marathiNumber = str_replace($englishNumerals, $marathiNumerals, $englishNumber);
                        return $marathiNumber;
                        }
                        // For Number longer than 9 digits
                        function all_two_digit($digits_2, $num_dic, $separator) {
                        if (strlen($digits_2) <= 1) {  // Provided only one/zero digit
                        return $num_dic[$digits_2];
                        } elseif ($digits_2 == "00") {  // Two Zero provided
                        return $num_dic["0"] . $separator . $num_dic["0"];
                        } elseif ($digits_2[0] == "0") {  // First digit is zero
                        return $num_dic["0"] . $separator . $num_dic[$digits_2[1]];
                        } else {  // Both digits provided
                        return $num_dic[$digits_2];
                        }
                        }
                        // For Number less than 9 digits
                        function two_digit($digits_2, $num_dic) {
                        $digits_2 = ltrim($digits_2, "0");
                        if (strlen($digits_2) != 0) {
                        return $num_dic[$digits_2];
                        } else {
                        return "";
                        }
                        }
                        function all_digit($digits, $num_dic, $separator, $combiner) {
                        $digits = ltrim($digits, "0");
                        $digit_len = strlen($digits);
                        if ($digit_len > 3) {
                        $num_of_digits_to_process = ($digit_len % 2) + 1;
                        $process_digits = substr($digits, 0, $num_of_digits_to_process);
                        $base = strval(10 ** ((round($digit_len / 2,2)) * 2 - 1));
                        $remain_digits = substr($digits, $num_of_digits_to_process);
                        if($base=="10000" ){
                        $base="1000";
                        }
                        if($base=="1000000" ){
                        $base="100000";
                        }
                        if($base=="100000000" ){
                        $base="10000000";
                        }
                        if($process_digits=="10000" ){
                        $process_digits="1000";
                        }
                        if($process_digits=="1000000" ){
                        $process_digits="100000";
                        }
                        if($process_digits=="100000000" ){
                        $process_digits="10000000";
                        }
                        return $num_dic[$process_digits] . $combiner . $num_dic[$base] . $separator . all_digit($remain_digits, $num_dic, $separator, $combiner);
                        } elseif (strlen($digits) == 3) {
                        return $num_dic[$digits[0]]  . $num_dic["100"] . $separator . two_digit(substr($digits, 1), $num_dic);
                        } else {
                        return two_digit($digits, $num_dic);
                        }
                        }
                        function getmarathiruppees($num, $lang='mr', $separator = ", ", $combiner = " "){
                        $lang = strtolower($lang);
                        $num = strval($num);
                        $NUM_DICT = array(
                        0=> "शून्य",
                        1=> "एक",
                        2=> "दोन",
                        3=> "तीन",
                        4=> "चार",
                        5=> "पाच",
                        6=> "सहा",
                        7=> "सात",
                        8=> "आठ",
                        9=> "नऊ",
                        10=> "दहा",
                        11=> "अकरा",
                        12=> "बारा",
                        13=> "तेरा",
                        14=> "चौदा",
                        15=> "पंधरा",
                        16=> "सोळा",
                        17=> "सतरा",
                        18=> "अठरा",
                        19=> "एकोणीस",
                        20=> "वीस",
                        21=> "एकवीस",
                        22=> "बावीस",
                        23=> "तेवीस",
                        24=> "चोवीस",
                        25=> "पंचवीस",
                        26=> "सव्वीस",
                        27=> "सत्तावीस",
                        28=> "अठ्ठावीस",
                        29=> "एकोणतीस",
                        30=> "तीस",
                        31=> "एकतीस",
                        32=> "बत्तीस",
                        33=> "तेहेतीस",
                        34=> "चौतीस",
                        35=> "पस्तीस",
                        36=> "छत्तीस",
                        37=> "सदतीस",
                        38=> "अडतीस",
                        39=> "एकोणचाळीस",
                        40=> "चाळीस",
                        41=> "एक्केचाळीस",
                        42=> "बेचाळीस",
                        43=> "त्रेचाळीस",
                        44=> "चव्वेचाळीस",
                        45=> "पंचेचाळीस",
                        46=> "सेहेचाळीस",
                        47=> "सत्तेचाळीस",
                        48=> "अठ्ठेचाळीस",
                        49=> "एकोणपन्नास",
                        50=> "पन्नास",
                        51=> "एक्कावन्न",
                        52=> "बावन्न",
                        53=> "त्रेपन्न",
                        54=> "चोपन्न",
                        55=> "पंचावन्न",
                        56=> "छप्पन्न",
                        57=> "सत्तावन्न",
                        58=> "अठ्ठावन्न",
                        59=> "एकोणसाठ",
                        60=> "साठ",
                        61=> "एकसष्ठ",
                        62=> "बासष्ठ",
                        63=> "त्रेसष्ठ",
                        64=> "चौसष्ठ",
                        65=> "पासष्ठ",
                        66=> "सहासष्ठ",
                        67=> "सदुसष्ठ",
                        68=> "अडुसष्ठ",
                        69=> "एकोणसत्तर",
                        70=> "सत्तर",
                        71=> "एक्काहत्तर",
                        72=> "बाहत्तर",
                        73=> "त्र्याहत्तर",
                        74=> "चौर्‍याहत्तर",
                        75=> "पंच्याहत्तर",
                        76=> "शहात्तर",
                        77=> "सत्याहत्तर",
                        78=> "अठ्ठ्याहत्तर",
                        79=> "एकोण ऐंशी",
                        80=> "ऐंशी",
                        81=> "एक्क्याऐंशी",
                        82=> "ब्याऐंशी",
                        83=> "त्र्याऐंशी",
                        84=> "चौऱ्याऐंशी",
                        85=> "पंच्याऐंशी",
                        86=> "शहाऐंशी",
                        87=> "सत्त्याऐंशी",
                        88=> "अठ्ठ्याऐंशी",
                        89=> "एकोणनव्वद",
                        90=> "नव्वद",
                        91=> "एक्क्याण्णव",
                        92=> "ब्याण्णव",
                        93=> "त्र्याण्णव",
                        94=> "चौऱ्याण्णव",
                        95=> "पंच्याण्णव",
                        96=> "शहाण्णव",
                        97=> "सत्त्याण्णव",
                        98=> "अठ्ठ्याण्णव",
                        99=> "नव्व्याण्णव",
                        100=> "शे",
                        1000=> "हजार", 
                        100000=> "लाख",
                        10000000=> "कोटी",
                        1000000000=> "अब्ज",
                        ); 
                        $num_dic = $NUM_DICT;
                        // Dash default combiner for English-India
                        if ($lang == "en" && $combiner == " ") {
                        $combiner = "-";
                        }
                        $num = ltrim($num, "0");
                        $full_digit_len = strlen($num);
                        if ($full_digit_len == 0) {
                        $output = $num_dic["0"];
                        } elseif ($full_digit_len <= 9) {
                        $output = all_digit($num, $num_dic, $separator, $combiner);
                        } else {
                        $iteration = round($full_digit_len / 2);
                        $output = all_two_digit(substr($num, 0, 2), $num_dic, $separator);  // First two digits
                        for ($i = 1; $i < $iteration; $i++) {
                        $output .= $separator . all_two_digit(substr($num, $i * 2, 2), $num_dic, $separator);  // Next two digit pairs
                        }
                        $remaining_digits = substr($num, $iteration * 2);
                        if (all_two_digit($remaining_digits, $num_dic, $separator) != "") {
                        $output .= $separator . all_two_digit($remaining_digits, $num_dic, $separator);  // Remaining last one/two digits
                        }
                        }
                        $output = trim($output, $separator);
                        // /    $output = language_specific_exception($output, $lang, $combiner);
                        return $output;
                        }
                        // Fucntion to get currency in words
                        function getIndianCurrency(float $number){
                        if($number==100){
                        return "शंभर";
                        }
                        return getmarathiruppees($number);
                        }
                        ?>
                        <!DOCTYPE html>
                        <html lang="mr">
                            <head>
                                <meta charset="UTF-8">
                                    <title>KDMC वसुली चलन अहवाल</title>
                                    <style>
                                        body { font-family: Arial, "Noto Sans Devanagari", sans-serif; font-size: 14px; margin: 20px; line-height: 1.5; }
                                        .report-form { background: #f9f9f9; padding: 15px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 25px; display: inline-block; }
                                        .report-form label { font-weight: bold; color: #003366; margin-right: 8px; }
                                        .report-form input[type="date"] { padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; }
                                        .report-form button { background-color: #003366; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
                                        .report-form button:hover { background-color: #004080; }
                                        .challan-table { width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 15px; }
                                        .challan-table th, .challan-table td { border: 1px solid #000; padding: 10px; }
                                        .challan-table th { background-color: #003366; color: white; text-align: center; }
                                        .right { text-align: right; }
                                        .center { text-align: center; }
                                        .bold { font-weight: bold; }
                                        .amount-words { margin: 15px 0; font-size: 14px; line-height: 1.5; }
                                        .signature-area td { height: 120px; vertical-align: bottom; padding-bottom: 20px; }
                                        @media print { .report-form { display: none !important; } body { margin: 15mm; } }
                                    </style>
                                </head>
                                <body>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12 comp-grid">
                                                <div class="">
                                                    <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 10px; margin-top: 10px; color: #003366;">
                                                        वसुली चलन अहवाल (Challan Report)
                                                    </h2>
                                                    <form method="GET" class="report-form">
                                                        <label for="from_date">दिनांकापासून :</label>
                                                        <input type="date" id="from_date" name="from_date" value="<?= htmlspecialchars($from_date) ?>" required>
                                                            <label for="to_date" style="margin-left: 15px;">दिनांकपर्यंत :</label>
                                                            <input type="date" id="to_date" name="to_date" value="<?= htmlspecialchars($to_date) ?>" required>
                                                                <button type="submit" style="margin-left: 20px;">अहवाल दाखवा</button>
                                                            </form>
                                                            <table class="challan-table" style="background:white">
                                                                <tr>
                                                                    <!--<td colspan="2" class="center" style="border-bottom: none; padding: 15px 0;">-->
                                                                        <!--    <h2 style="margin: 0; color: #003366;">KDMC - FIRE</h2>-->
                                                                        <td colspan="2" class="center" style="border-bottom: none; padding: 15px 0;">
                                                                            <!-- Logo -->
                                                                            <div style="margin-bottom:10px;">
                                                                                <img src="<?php echo SITE_ADDR ?>assets/images/logo.png" 
                                                                                    alt="Logo" 
                                                                                    style="height:80px;">
                                                                                </div>
                                                                                <h2 style="margin: 0; color: #003366;">कल्याण डोंबिवली महानगरपालिका  </h2> 
                                                                                <h5 style="margin: 0;">पाणी पुरवठा विभाग </h5>
                                                                                <p style="margin: 5px 0;">वसुलीच्या रकमा रवाना करण्यासाठीचे चलन सन : 2025-2026</p>
                                                                                <p style="margin: 5px 0;">
                                                                                    दिनांकापासून : <?= $from_date ? date('d-m-Y', strtotime($from_date)) : '—' ?>
                                                                                    &nbsp;&nbsp; दिनांकपर्यंत : <?= $to_date ? date('d-m-Y', strtotime($to_date)) : '—' ?>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2" class="center">
                                                                                Counter Reference:- ALL &nbsp;&nbsp;&nbsp; CFC Reference:- ALL
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <table class="challan-table" style="margin: 0;">
                                                                                    <tr>
                                                                                        <th>कराचे  नाव  / प्रकार</th>
                                                                                        <th class="right">एकूण रक्कम (₹)</th>
                                                                                    </tr>
                                                                                    <?php if (!empty($display_records)): ?>
                                                                                    <?php foreach ($display_records as $row): ?>
                                                                                    <tr>
                                                                                        <td><?= htmlspecialchars(str_replace('_', ' ', strtoupper($row['payment_mode']))) ?></td>
                                                                                        <td class="right bold"><?= number_format($row['total_amount'], 2) ?> /-</td>
                                                                                    </tr>
                                                                                    <?php endforeach; ?>
                                                                                    <tr class="bold" style="background:#f8f8f8;">
                                                                                        <td class="right">एकूण सर्व</td>
                                                                                        <td class="right"><?= number_format($grand_total, 2) ?> /-</td>
                                                                                    </tr>
                                                                                    <?php else: ?>
                                                                                    <tr>
                                                                                        <td colspan="2" class="center" style="padding: 40px 0; font-size: 16px;">
                                                                                            या कालावधीत पेमेंट झालेला कोणताही रेकॉर्ड सापडला नाही
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php endif; ?>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <p class="amount-words">
                                                                                    कॅशिअर यांच्याकडे तपासणीसाठी व महानगरपालिका  निधीत जमा करण्यासाठी रूपये अक्षरी
                                                                                    <strong><?= $grand_total > 0 ? getIndianCurrency($grand_total) . ' /- ' : 'शून्य /- ' ?></strong>
                                                                                </p>
                                                                                <div class="right bold">वसुली लिपीक  / हेडवसुली</div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <table class="challan-table signature-area">
                                                                                    <tr>
                                                                                        <td width="50%">
                                                                                            <!--तपासणी केली आणि वसुलीच्या रजिस्टरातील नोंदी तपासून एकूण रक्कम बरोबर आढळली.<br><br><br>-->
                                                                                                तपासणी केली असून वसुली नोंदवहीतील नोंदी पडताळून एकूण रक्कम बरोबर असल्याचे आढळले.<br><br><br><br>
                                                                                                    <div class="right bold">मुख्य वसुली अधिकारी<br>क.डो.म.पा </div>
                                                                                                    </td>
                                                                                                    <td width="50%">
                                                                                                        <!--मिळालेली रक्कम तपासून पाहिली व नोंद केली आहे.<br><br><br>-->
                                                                                                            प्राप्त रक्कम तपासून पाहिली असून आवश्यक ती नोंद करण्यात आलेली आहे.<br><br><br><br>
                                                                                                                <div class="right bold">अधिकारी / निरीक्षक<br>क.डो.म.पा </div>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <?php if ($receipt_list !== "—"): ?>
                                                                                            <p style="margin-top: 20px; font-size: 13px; word-break: break-all;">
                                                                                                <strong>पावती क्र. :</strong> <?= htmlspecialchars($receipt_list) ?>
                                                                                            </p>
                                                                                            <?php endif; ?>
                                                                                            <?php if ($from_date && $to_date): ?>
                                                                                            <div style="margin-top: 25px;">
                                                                                                <button onclick="window.print()" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 15px;">
                                                                                                    प्रिंट / Print
                                                                                                </button>
                                                                                            </div>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </body>
                                                                    </html>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
