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
                    <h4 class="record-title">View  Application Form</h4>
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
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-division">
                                        <th class="title"> Division: </th>
                                        <td class="value"> <?php echo $data['division']; ?></td>
                                    </tr>
                                    <tr  class="td-ward">
                                        <th class="title"> Ward: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/application_form_ward_option_list'); ?>' 
                                                data-value="<?php echo $data['ward']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="ward" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['ward']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-landowner_or_applicant_name">
                                        <th class="title"> Landowner Or Applicant Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['landowner_or_applicant_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="landowner_or_applicant_name" 
                                                data-title="Enter LANDOWNER OR APPLICANT NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['landowner_or_applicant_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-licensed_architect_or_engineers_name">
                                        <th class="title"> Licensed Architect Or Engineers Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['licensed_architect_or_engineers_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="licensed_architect_or_engineers_name" 
                                                data-title="Enter LICENSED ARCHITECT OR ENGINEER’S NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['licensed_architect_or_engineers_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-property_address">
                                        <th class="title"> Property Address: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="property_address" 
                                                data-title="Enter PROPERTY ADDRESS" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['property_address']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-details_of_existing_water_connections">
                                        <th class="title"> Details Of Existing Water Connections: </th>
                                        <td class="value"> <?php echo $data['details_of_existing_water_connections']; ?></td>
                                    </tr>
                                    <tr  class="td-bldg_no">
                                        <th class="title"> Bldg No: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['bldg_no']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="bldg_no" 
                                                data-title="Enter BUILDING NO." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['bldg_no']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-qty_of_water_reqd">
                                        <th class="title"> Qty Of Water Reqd: </th>
                                        <td class="value"> <?php echo $data['qty_of_water_reqd']; ?></td>
                                    </tr>
                                    <tr  class="td-size_and_capcity_of_ug_tank_proposed">
                                        <th class="title"> Size And Capcity Of Ug Tank Proposed: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['size_and_capcity_of_ug_tank_proposed']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="size_and_capcity_of_ug_tank_proposed" 
                                                data-title="Enter SIZE AND CAPACITY OF UG TANK PROPOSED (IN LITRE)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['size_and_capcity_of_ug_tank_proposed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-size_and_capcity_of_oh_tank_proposed">
                                        <th class="title"> Size And Capcity Of Oh Tank Proposed: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['size_and_capcity_of_oh_tank_proposed']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="size_and_capcity_of_oh_tank_proposed" 
                                                data-title="Enter SIZE AND CAPACITY OF OH TANK PROPOSED (IN LITRE)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['size_and_capcity_of_oh_tank_proposed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-distance_of_ug_tank_from_supply_line">
                                        <th class="title"> Distance Of Ug Tank From Supply Line: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['distance_of_ug_tank_from_supply_line']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="distance_of_ug_tank_from_supply_line" 
                                                data-title="Enter DISTANCE OF UG TANK FROM SUPPLY LINE" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['distance_of_ug_tank_from_supply_line']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-timestamp">
                                        <th class="title"> Timestamp: </th>
                                        <td class="value"> <?php echo $data['timestamp']; ?></td>
                                    </tr>
                                    <tr  class="td-are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient">
                                        <th class="title"> Are Size And Capcity Of Oh And Ug Tank Proposed Sufficient: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient); ?>' 
                                                data-value="<?php echo $data['are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-are_all_connections_disconnected_on_site_from_main_line">
                                        <th class="title"> Are All Connections Disconnected On Site From Main Line: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient); ?>' 
                                                data-value="<?php echo $data['are_all_connections_disconnected_on_site_from_main_line']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="are_all_connections_disconnected_on_site_from_main_line" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['are_all_connections_disconnected_on_site_from_main_line']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-is_sewage_treatment_plant_proposed_for_the_proposal">
                                        <th class="title"> Is Sewage Treatment Plant Proposed For The Proposal: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient); ?>' 
                                                data-value="<?php echo $data['is_sewage_treatment_plant_proposed_for_the_proposal']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="is_sewage_treatment_plant_proposed_for_the_proposal" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['is_sewage_treatment_plant_proposed_for_the_proposal']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-landmark">
                                        <th class="title"> Landmark: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="landmark" 
                                                data-title="Enter LANDMARK" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['landmark']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-survey_no">
                                        <th class="title"> Survey No: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['survey_no']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="survey_no" 
                                                data-title="Enter SURVEY NO." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['survey_no']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-house_no">
                                        <th class="title"> House No: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['house_no']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="house_no" 
                                                data-title="Enter HOUSE NO." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['house_no']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-cts_no">
                                        <th class="title"> Cts No: </th>
                                        <td class="value"> <?php echo $data['cts_no']; ?></td>
                                    </tr>
                                    <tr  class="td-village_name">
                                        <th class="title"> Village Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['village_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="village_name" 
                                                data-title="Enter VILLAGE NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['village_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-taluka_name">
                                        <th class="title"> Taluka Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['taluka_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="taluka_name" 
                                                data-title="Enter TALUKA NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['taluka_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-upload_detailed_location_plan">
                                        <th class="title"> Upload Detailed Location Plan: </th>
                                        <td class="value"><?php Html :: page_img($data['upload_detailed_location_plan'],400,400,1); ?></td>
                                    </tr>
                                    <tr  class="td-upload_complete_building_layout_plan">
                                        <th class="title"> Upload Complete Building Layout Plan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['upload_complete_building_layout_plan']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="upload_complete_building_layout_plan" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['upload_complete_building_layout_plan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-upload_table_showing_residential_and_commercial_tenements_shops">
                                        <th class="title"> Upload Table Showing Residential And Commercial Tenements Shops: </th>
                                        <td class="value"> <?php echo $data['upload_table_showing_residential_and_commercial_tenements_shops']; ?></td>
                                    </tr>
                                    <tr  class="td-upload_water_requirement_for_the_entire_project">
                                        <th class="title"> Upload Water Requirement For The Entire Project: </th>
                                        <td class="value"> <?php echo $data['upload_water_requirement_for_the_entire_project']; ?></td>
                                    </tr>
                                    <tr  class="td-upload_location_plan_showing_existing_open_well">
                                        <th class="title"> Upload Location Plan Showing Existing Open Well: </th>
                                        <td class="value"> <?php echo $data['upload_location_plan_showing_existing_open_well']; ?></td>
                                    </tr>
                                    <tr  class="td-upload_locations_and_details_of_under_ground_etc">
                                        <th class="title"> Upload Locations And Details Of Under Ground Etc: </th>
                                        <td class="value"> <?php echo $data['upload_locations_and_details_of_under_ground_etc']; ?></td>
                                    </tr>
                                    <tr  class="td-upload_plumbing_system_details">
                                        <th class="title"> Upload Plumbing System Details: </th>
                                        <td class="value"> <?php echo $data['upload_plumbing_system_details']; ?></td>
                                    </tr>
                                    <tr  class="td-proposed_quantity_of_residences">
                                        <th class="title"> Proposed Quantity Of Residences: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['proposed_quantity_of_residences']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="proposed_quantity_of_residences" 
                                                data-title="Enter PROPOSED WATER REQUIREMENT FOR RESIDENCES" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['proposed_quantity_of_residences']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-proposed_quantity_of_shops">
                                        <th class="title"> Proposed Quantity Of Shops: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['proposed_quantity_of_shops']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="proposed_quantity_of_shops" 
                                                data-title="Enter PROPOSED QUANTITY OF WATER FOR SHOPS (LITRE)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['proposed_quantity_of_shops']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-proposed_quantity_of_offices">
                                        <th class="title"> Proposed Quantity Of Offices: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['proposed_quantity_of_offices']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="proposed_quantity_of_offices" 
                                                data-title="Enter PROPOSED QUANTITY  OF WATER FOR OFFICES " 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['proposed_quantity_of_offices']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-total">
                                        <th class="title"> Total: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['total']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="total" 
                                                data-title="Enter TOTAL QUANTITY OF WATER REQUIRED (LITRE)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['total']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-upload_building_plan">
                                        <th class="title"> Upload Building Plan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['upload_building_plan']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="upload_building_plan" 
                                                data-title="Browse..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['upload_building_plan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-length_of_ug_tank_proposed">
                                        <th class="title"> Length Of Ug Tank Proposed: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['length_of_ug_tank_proposed']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="length_of_ug_tank_proposed" 
                                                data-title="Enter LENGTH OF UG TANK PROPOSED" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['length_of_ug_tank_proposed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-width_of_ug_tank_proposed">
                                        <th class="title"> Width Of Ug Tank Proposed: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['width_of_ug_tank_proposed']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="width_of_ug_tank_proposed" 
                                                data-title="Enter WIDTH OF UG TANK PROPOSED" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['width_of_ug_tank_proposed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-depth_of_ug_tank_proposed">
                                        <th class="title"> Depth Of Ug Tank Proposed: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['depth_of_ug_tank_proposed']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="depth_of_ug_tank_proposed" 
                                                data-title="Enter DEPTH OF UG TANK PROPOSED" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['depth_of_ug_tank_proposed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-length_of_oh_tank_proposed">
                                        <th class="title"> Length Of Oh Tank Proposed: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['length_of_oh_tank_proposed']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="length_of_oh_tank_proposed" 
                                                data-title="Enter LENGTH OF OH TANK PROPOSED" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['length_of_oh_tank_proposed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-width_of_oh_tank_proposed">
                                        <th class="title"> Width Of Oh Tank Proposed: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['width_of_oh_tank_proposed']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="width_of_oh_tank_proposed" 
                                                data-title="Enter WIDTH OF OH TANK PROPOSED" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['width_of_oh_tank_proposed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-height_of_oh_tank_proposed">
                                        <th class="title"> Height Of Oh Tank Proposed: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['height_of_oh_tank_proposed']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("application_form/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="height_of_oh_tank_proposed" 
                                                data-title="Enter HEIGHT OF OH TANK PROPOSED" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['height_of_oh_tank_proposed']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                            <a class="btn  btn-sm btn-primary export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                </a>
                                <?php if($can_edit){ ?>
                                <a class="btn btn-sm btn-info"  href="<?php print_link("application_form/edit/$rec_id"); ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <?php } ?>
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            <!-- Empty Record Message -->
                            <div class="text-muted p-3">
                                <i class="fa fa-ban"></i> No Record Found
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
