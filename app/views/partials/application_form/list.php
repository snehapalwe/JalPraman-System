<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("application_form/add");
$can_edit = ACL::is_allowed("application_form/edit");
$can_view = ACL::is_allowed("application_form/view");
$can_delete = ACL::is_allowed("application_form/delete");
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
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="grid" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><STRONG style='color: black;'>APPLICATION FORM</STRONG></h4>
                </div>
                <div class="col-sm-3 ">
                    <!--<?php if($can_add){ ?>-->
                    <!--<a  class="btn btn btn-primary my-1" href="<?php print_link("application_form/add") ?>">-->
                    <!--    <i class="fa fa-plus"></i>                              -->
                    <!--    Add New Application Form -->
                    <!--</a>-->
                    <!--<?php } ?>-->
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('application_form'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
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
                                        <a class="text-decoration-none" href="<?php print_link('application_form'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('application_form'); ?>">
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
        <?php if(USER_ROLE!=2){ ?>
        <center>
            <a href="<?php echo SITE_ADDR ?>application_form?status2=pending" class="btn btn-primary">Pending</a>
            <a href="<?php echo SITE_ADDR ?>application_form?status2=reverted" class="btn btn-danger">Reverted</a>
            <a href="<?php echo SITE_ADDR ?>application_form?status2=completed" class="btn btn-success">Completed</a>
            <a href="<?php echo SITE_ADDR ?>application_form?status2=paypend" class="btn btn-warning">Payment Pending</a>
        </center>
        <?php } ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="application_form-list-records">
                                <?php
                                if(!empty($records)){
                                ?>
                                <div id="page-report-body">
                                    <div class="row sm-gutters page-data" id="page-data-<?php echo $page_element_id; ?>">
                                        <!--record-->
                                        <?php
                                        $counter = 0;
                                        foreach($records as $data){
                                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                        $counter++;
                                        ?>
                                        <div class="col-sm-4">
                                            <div class="bg-light p-2 mb-3 animated bounceIn">
                                                <!-- New Print Button -->
                                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                                    <span><?php echo $data['id']; ?></span>
                                                    <button type="button" class="btn btn-success" onclick="printSection(event)">🖨️ Print</button>
                                                </div>
                                                
                                                <span>
                                                    <?php 
                                                    
                                                    $id = $data['id'];
                                                                                                                                                    echo "<a href='".SITE_ADDR."api/viewreasonALL/$id/cc' class='btn btn-danger page-modal modal-page btn-sm'>VIEW AUTHORITY REMARKS</a><br>"; 


                                                    $addBtn = "";
                                                    $viewBtn = "";
                                                    $submitBtn = "";
                                                    if($data['status']+0==5){
                                                    echo '<br><span style="font-weight: bold; background-color: yellow; padding: 2px 5px; color: black; border-radius: 3px;">COMPLETED</span><br>';
                                                        }
                                                        if($data['status']+0==4){
                                                        echo '<span style="font-weight: bold; background-color: yellow; color: black; padding: 2px 5px; border-radius: 3px;">PENDING NOC UPLOAD</span><br>';
                                                            }
                                                            // Prepare buttons separately
                                                            
                                                            $viewBtn = "<a href='".SITE_ADDR."water_form_details/?rec_id=$id' class='btn btn-info btn-sm'>💧 VIEW WATER DETAILS</a><br>";
                                                            if($data['id']+0>=38){
                                                                $viewBtn="";
                                                            }
                                                                $addBtn  = "<a href='".SITE_ADDR."water_form_details/add?rec_id=$id&application_no=".$data['application_no']."' class='btn btn-danger btn-sm'>➕ ADD WATER DETAILS</a>";
                                                                // ✅ Check if at least one water detail exists
                                                                $jei = new User_infoController();
                                                                $db = $jei->GetModel();
                                                                $db->where("rec_id", $id);
                                                                $hasWaterDetails = $db->has("water_form_details"); // true/false
                                                                if($data['status']+0==0){
                                                                // Show instruction only if no water details yet
                                                                if(!$hasWaterDetails){
                                                                echo '<span style="font-weight: bold; background-color: yellow; color: black; padding: 2px 5px; border-radius: 3px;">FIRST ADD THE WATER DETAILS</span><br>';
                                                                    }
                                                                    echo $addBtn . "<br>" . $viewBtn; 
                                                                        // Show submit only if water detail exists
                                                                        if($hasWaterDetails){
                                                                        echo "<a href='".SITE_ADDR."application_form/edit2/$id' class='btn btn-success btn-sm'>SUBMIT FORM</a>";
                                                                        }
                                                                        } else {
                                                                        echo $viewBtn; 
                                                                        }
                                                                        if($data['status']+0==-1){ 
                                                                        echo '<br><span style="font-weight: bold; background-color: red; padding: 2px 5px; border-radius: 3px;">REJECTED</span><br>'; 
                                                                                    echo "<a href='" . SITE_ADDR . "api/viewreason/application_form/" . $id . "' class='btn btn-primary modal-page page-modal btn-sm'>VIEW REASON</a>";
                                                                            }
                                                                            if($data['status']+0==-2){ 
                                                                            echo '<br><span style="font-weight: bold; background-color: #FF5C5C; padding: 2px 5px; border-radius: 3px; color:white;">REVERTED</span><br>'; 
                                                                                if(USER_ROLE == 2){
                                                                                echo "<br><br><a href='".SITE_ADDR."application_form/revert/".$data['id']."' class='btn btn-danger btn-sm'>EDIT APPLICATION</a>"; 
                                                                                    }
                                                                                    echo "<a href='" . SITE_ADDR . "api/viewreason/application_form/" . $id . "' class='btn btn-primary modal-page page-modal btn-sm'>VIEW REASON</a>";
                                                                                    }
                                                                                if($data['status']+0==1){
                                                                                //  echo "Pending at auth 1";
                                                                                echo '<br><span style="font-weight: bold; background-color: yellow; padding: 2px 5px; color: black; border-radius: 3px;">PENDING AT AUTH 1</span><br>';
                                                                                    //  if(USER_ROLE==4){
                                                                                    //     echo "<a href='" . SITE_ADDR . "information_of_plan/add/?rec_id=" . $id . "&application_no=" . $data['application_no'] . "' class='btn btn-danger btn-sm'>ADD DETAILS</a>";
                                                                                    //     echo "<a href='".SITE_ADDR."accept_reject/add/?rec_id=$id' class='btn btn-danger btn-sm'>ACCEPT / REJECT</a>";
                                                                                    //  }
                                                                                    if(USER_ROLE==4){
                                                                                    // ✅ First show "ADD DETAILS" always
                                                                                    
                                                                                    echo "<a href='".SITE_ADDR."accept_reject/add/?rec_id=$id&action=REVERT' class='btn btn-danger btn-sm'>REVERT</a>";
                                                                                    echo "<a href='" . SITE_ADDR . "information_of_plan/add/?rec_id=" . $id . "&application_no=" . $data['application_no'] . "' class='btn btn-danger btn-sm'>DO INSPECTION</a>";
                                                                                    // ✅ Check if at least one plan detail exists
                                                                                    $jei = new User_infoController();
                                                                                    $db = $jei->GetModel();
                                                                                    $db->where("rec_id", $id);
                                                                                    $hasPlanDetails = $db->has("information_of_plan"); // true/false
                                                                                    // ✅ Show Accept/Reject only if details are present
                                                                                    if($hasPlanDetails){
                                                                                    echo "<a href='".SITE_ADDR."accept_reject/add/?rec_id=$id' class='btn btn-danger btn-sm'>ACCEPT / REJECT</a>";
                                                                                    }
                                                                                    }
                                                                                    }
                                                                                    if($data['status']+0==2){
                                                                                    echo '<span style="font-weight: bold; background-color: yellow; padding: 2px 5px; color: black;  border-radius: 3px;">PENDING AT AUTH 2</span><br>';
                                                                                        //  if(USER_ROLE==3){
                                                                                        //      if($data['paid']==0){
                                                                                        //         echo "<a href='".SITE_ADDR."payments/add/?rec_id=$id&amount=5000' class='btn btn-danger btn-sm'>ADD PAYMENT DETAILS</a>";
                                                                                        //      }
                                                                                        //     echo "<a href='".SITE_ADDR."accept_reject/add/?rec_id=$id' class='btn btn-danger btn-sm'>ACCEPT / REJECT</a>";
                                                                                        //  }
                                                                                        if(USER_ROLE==3){
                                       
                                                                                        // ✅ Show Accept/Reject only if payment exists
                                                                                        // if((int)$data['paid'] > 0){
                                                                                        echo "<a href='".SITE_ADDR."accept_reject/add/?rec_id=$id' class='btn btn-danger btn-sm'>ACCEPT / REJECT</a>";
                                                                                        // }
                                                                                        }
                                                                                        }
                                                                                        if($data['status']+0==3){
                                                                                            
                                                                                         
                                                                                        if(USER_ROLE==2){
                                                                                        // ✅ If no payment done, only show ADD PAYMENT DETAILS
                                                                                        
                                                                                        if($data['paid']==0){
                                                                                        echo "<a href='".SITE_ADDR."../payment_gateway/?proj=WATER_TECHNICAL&service=water_technical_noc_application_form&amount=5000&id=".$data['id']."&checksum=".hash("sha256",date("YmdHis")."WATER_TECHNICAL".$_GET['amount'])."' class='btn btn-danger btn-sm'>MAKE PAYMENT (Rs. 5000)</a>";

                                                                                        // echo "<a href='".SITE_ADDR."payments/add/?rec_id=$id&amount=5000' class='btn btn-danger btn-sm'>ADD PAYMENT DETAILS</a>";
                                                                                        }
                                                                                        // ✅ Show Accept/Reject only if payment exists
                                                                                      
                                                                                        }
                                                                                           
                                                                                        if($data['paid']==0){
                                                                                        echo '<span style="font-weight: bold; background-color: yellow; padding: 2px 5px; color: black;  border-radius: 3px;">PENDING AT CITIZEN FOR PAYMENT</span><br>';

                                                                                        }else{
                                                                                        
                                                                                        echo '<span style="font-weight: bold; background-color: yellow; color: black; padding: 2px 5px; border-radius: 3px;">PENDING AT AUTH 3</span><br>';
                                                                                            if(USER_ROLE==5){ 
                                                                                                if($data['paid']==0){
                                                                                                    
                                                                                            echo "Pending at citizen for payment";
                                                                                                }else{
                                                                                            echo "<a href='".SITE_ADDR."accept_reject/add/?rec_id=$id' class='btn btn-danger btn-sm'>ACCEPT / REJECT</a>";
                                                                                            }
                                                                                            }
                                                                                            
                                                                                        }
                                                                                            }
                                                                                            if($data['status']+0==4){
                                                                                            /*echo '<span style="font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;">Pending NOC Upload</span><br>';*/
                                                                                                if(USER_ROLE==5){ 
                                                                                                // ✅ New button for Generate NOC
                                                                                                echo "<a href='".SITE_ADDR."application_form/generate_noc/$id' class='btn btn-warning btn-sm'>GENERATE NOC</a> ";
                                                                                                echo "<a href='".SITE_ADDR."application_form/edit_approval/$id' class='btn btn-danger btn-sm'>UPLOAD NOC</a>";
                                                                                                }
                                                                                                }
                                                                                                // if($data['status']+0>=1){ 
                                                                                                    // }
                                                                                                if($data['status']+0>=2){ 
                                                                                                echo "<a href='".SITE_ADDR."information_of_plan/?rec_id=$id' class='btn btn-warning btn-sm'>🔍  VIEW INSPECTION</a><br>"; 
                                                                                                    }
                                                                                                    if($data['status']+0==5){
                                                                                                    echo "<a href='".$data['certificate']."' class='btn btn-success btn-sm'>📄 DOWNLOAD NOC</a>";
                                                                                                    }
                                                                                                    if((int)$data['paid'] > 0){ 
                                                                                                    echo "<a href='".SITE_ADDR."payments/view/".$data['paid']."' class='btn btn-success btn-sm'> 🧾 RECEIPT</a><br>"; 
                                                                                                        }
                                                                                                        ?>
                                                                                                    </span>
                                                                                                    <br>
                                                                                                        <?php if (!empty($data['application_no'])): ?>
                                                                                                        <div class="mb-2">
                                                                                                            <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                BPMS PROJECT CODE:
                                                                                                            </strong>  
                                                                                                            <span style="font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;">
                                                                                                                <?php echo getusername($data['user_id']); ?>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <div class="mb-2">
                                                                                                            <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                APPLICATION NO.:
                                                                                                            </strong>  
                                                                                                            <span style="font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;">
                                                                                                                <?php echo $data['application_no']; ?>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <?php endif; ?>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                WARD :  
                                                                                                            </span>
                                                                                                        
                                                                                                
                                                                                                        <span style="font-weight: bold; background-color: yellow; padding: 2px 5px; border-radius: 3px;">
                                                                                                                <?php echo $data['ward']; ?>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                LANDOWNER / APPLICANT NAME:  
                                                                                                            </span>
                                                                                                        <?php echo $data['landowner_or_applicant_name']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                LICENSED ARCHITECT / ENGINEER NAME :  
                                                                                                            </span>
                                                                                                        <?php echo $data['licensed_architect_or_engineers_name']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                MOBILE NO :  
                                                                                                            </span> 
                                                                                                        <?php echo $data['mobile_no']; ?></div> 
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                PROPERTY ADDRESS :  
                                                                                                            </span>
                                                                                                        <?php echo $data['property_address']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                LANDMARK :  
                                                                                                            </span>
                                                                                                        <?php echo $data['landmark']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                SURVEY NO. :  
                                                                                                            </span>
                                                                                                        <?php echo $data['survey_no']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                HOUSE NO. :  
                                                                                                            </span>
                                                                                                        <?php echo $data['house_no']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                VILLAGE NAME :  
                                                                                                            </span>
                                                                                                        <?php echo $data['village_name']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                TALUKA NAME :  
                                                                                                            </span>
                                                                                                        <?php echo $data['taluka_name']; ?></div>
                                                                                                        <?php if($data['are_all_connections_disconnected_on_site_from_main_line']!="N/A"){ ?>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                ARE ALL  CONNECTIONS ON SITE DISCONNECTED FROM THE MAIN LINE?:  
                                                                                                            </span>
                                                                                                        <?php echo $data['are_all_connections_disconnected_on_site_from_main_line']; ?></div>
                                                                                                        <?php } ?>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                IS A SEWAGE TREATMENT PLANT PROPOSED FOR THE PROPOSAL?:  
                                                                                                            </span>
                                                                                                        <?php echo $data['is_sewage_treatment_plant_proposed_for_the_proposal']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                BUILDING NO. :  
                                                                                                            </span>
                                                                                                        <?php echo $data['bldg_no']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                PROPOSED WATER REQUIREMENT FOR RESIDENCES:  
                                                                                                            </span>
                                                                                                        <?php echo $data['proposed_quantity_of_residences']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                PROPOSED QUANTITY OF SHOPS FOR WATER REQUIREMENT:  
                                                                                                            </span>
                                                                                                        <?php echo $data['proposed_quantity_of_shops']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                PROPOSED QUANTITY OF OFFICES FOR WATER REQUIREMENT:  
                                                                                                            </span>
                                                                                                        <?php echo $data['proposed_quantity_of_offices']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                TOTAL QTY OF WATER REQUIRED:  
                                                                                                            </span>
                                                                                                        <?php echo $data['total']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                LENGTH OF UG TANK PROPOSED (IN METER):  
                                                                                                            </span>
                                                                                                        <?php echo $data['length_of_ug_tank_proposed']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                WIDTH OF UG TANK PROPOSED (IN METER):  
                                                                                                            </span>
                                                                                                        <?php echo $data['width_of_ug_tank_proposed']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                DEPTH OF UG TANK PROPOSED (IN METER):  
                                                                                                            </span>
                                                                                                        <?php echo $data['depth_of_ug_tank_proposed']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                SIZE AND CAPACITY OF UG TANK PROPOSED (IN LITRE):  
                                                                                                            </span>
                                                                                                        <?php echo $data['size_and_capcity_of_ug_tank_proposed']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                ARE THE SIZES AND CAPACITIES OF THE OH AND UG TANKS SUFFICIENT?:  
                                                                                                            </span>
                                                                                                        <?php echo $data['are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                LENGTH OF OH TANK PROPOSED (IN METER):  
                                                                                                            </span>
                                                                                                        <?php echo $data['length_of_oh_tank_proposed']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                WIDTH OF OH TANK PROPOSED (IN METER):  
                                                                                                            </span>
                                                                                                        <?php echo $data['width_of_oh_tank_proposed']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                HEIGHT OF OH TANK PROPOSED (IN METER):  
                                                                                                            </span>
                                                                                                        <?php echo $data['height_of_oh_tank_proposed']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                SIZE AND CAPACITY OF OH TANK PROPOSED (IN LITRE):  
                                                                                                            </span>
                                                                                                        <?php echo $data['size_and_capcity_of_oh_tank_proposed']; ?></div>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                DISTANCE OF UG TANK FROM SUPPLY LINE (IN METER):  
                                                                                                            </span>
                                                                                                        <?php echo $data['distance_of_ug_tank_from_supply_line']; ?></div>
                                                                                                        <?php if (!empty($data['upload_full_potential_plan'])): ?>
                                                                                                        <div class="mb-2">
                                                                                                            <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                UPLOAD FULL POTENTIAL PLAN:
                                                                                                            </strong>  
                                                                                                            <a href="<?php echo htmlspecialchars($data['upload_full_potential_plan'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                target="_blank" 
                                                                                                                class="btn btn-info btn-sm">
                                                                                                                View Plan
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <?php endif; ?>
                                                                                                        <?php if (!empty($data['upload_building_plan'])): ?>
                                                                                                        <div class="mb-2">
                                                                                                            <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                UPLOAD BUILDING PLAN:
                                                                                                            </strong>  
                                                                                                            <a href="<?php echo htmlspecialchars($data['upload_building_plan'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                target="_blank" 
                                                                                                                class="btn btn-info btn-sm">
                                                                                                                View Plan
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <?php endif; ?>
                                                                                                        <?php if (!empty($data['upload_detailed_location_plan'])): ?>
                                                                                                        <div class="mb-2">
                                                                                                            <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                UPLOAD MUNICIPAL SHEET:
                                                                                                            </strong>  
                                                                                                            <a href="<?php echo htmlspecialchars($data['upload_detailed_location_plan'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                target="_blank" 
                                                                                                                class="btn btn-info btn-sm">
                                                                                                                View Document
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <?php endif; ?>
                                                                                                        <?php if (!empty($data['upload_complete_building_layout_plan'])): ?>
                                                                                                        <div class="mb-2">
                                                                                                            <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                UPLOADED OTHER DOCUMENT:
                                                                                                            </strong>  
                                                                                                            <a href="<?php echo htmlspecialchars($data['upload_complete_building_layout_plan'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                target="_blank" 
                                                                                                                class="btn btn-info btn-sm">
                                                                                                                View Document
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <?php endif; ?>
                                                                                                        <?php if (!empty($data['upload_water_tank_plan'])): ?>
                                                                                                        <div class="mb-2">
                                                                                                            <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                UPLOAD WATER TANK PLAN :
                                                                                                            </strong>  
                                                                                                            <a href="<?php echo htmlspecialchars($data['upload_water_tank_plan'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                target="_blank" 
                                                                                                                class="btn btn-info btn-sm">
                                                                                                                View Document
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <?php endif; ?>
                                                                                                        <?php if (!empty($data['upload_property_google_location_with_coordinates'])): ?>
                                                                                                        <div class="mb-2">
                                                                                                            <strong style="font-weight: 500 !important; color: #000 !important;">
                                                                                                                UPLOAD PROPERTY GOOGLE LOCATION WITH COORDINATES T:
                                                                                                            </strong>  
                                                                                                            <a href="<?php echo htmlspecialchars($data['upload_property_google_location_with_coordinates'], ENT_QUOTES, 'UTF-8'); ?>" 
                                                                                                                target="_blank" 
                                                                                                                class="btn btn-info btn-sm">
                                                                                                                View Document
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <?php endif; ?>
                                                                                                        <div class="mb-2">  
                                                                                                            <span class="font-weight-light text-muted ">
                                                                                                                TIMESTAMP :  
                                                                                                            </span>
                                                                                                        <?php echo $data['timestamp']; ?></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <?php 
                                                                                                }
                                                                                                ?>
                                                                                                <!--endrecord-->
                                                                                            </div>
                                                                                            <div class="row sm-gutters search-data" id="search-data-<?php echo $page_element_id; ?>"></div>
                                                                                            <div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php
                                                                                        if($show_footer == true){
                                                                                        ?>
                                                                                        <div class=" border-top mt-2">
                                                                                            <div class="row justify-content-center">    
                                                                                                <div class="col-md-auto">   
                                                                                                </div>
                                                                                                <div class="col">   
                                                                                                    <?php
                                                                                                    if($show_pagination == true){
                                                                                                    $pager = new Pagination($total_records, $record_count);
                                                                                                    $pager->route = $this->route;
                                                                                                    $pager->show_page_count = true;
                                                                                                    $pager->show_record_count = true;
                                                                                                    $pager->show_page_limit =true;
                                                                                                    $pager->limit_count = $this->limit_count;
                                                                                                    $pager->show_page_number_list = true;
                                                                                                    $pager->pager_link_range=5;
                                                                                                    $pager->render();
                                                                                                    }
                                                                                                    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        }
                                                                                        else{
                                                                                        ?>
                                                                                        <div class="text-muted  animated bounce p-3">
                                                                                            <h4><i class="fa fa-ban"></i> No record found</h4>
                                                                                        </div>
                                                                                        <?php
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
