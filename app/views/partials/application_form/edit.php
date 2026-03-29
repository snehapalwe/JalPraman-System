<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Edit  Application Form</h4>
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
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("application_form/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                
                                
                                                                                        <div class="form-group ">
                                                                                            <label class="control-label" for="upload_full_potential_plan">UPLOAD FULL POTENTIAL PLAN <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-upload_full_potential_plan-holder" class=""> 
                                                                                                <div class="dropzone required" input="#ctrl-upload_full_potential_plan" fieldname="upload_full_potential_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                    <input name="upload_full_potential_plan" id="ctrl-upload_full_potential_plan" required="" class="dropzone-input form-control" value="<?php  echo $data['upload_full_potential_plan']; ?>" type="text"  />
                                                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <?php Html :: uploaded_files_list($data['upload_full_potential_plan'], '#ctrl-upload_full_potential_plan'); ?>
                                                                                            </div>
                                                                                            
                                                                                            
                                <div class="form-group ">
                                    <label class="control-label" for="ward">WARD <span class="text-danger">*</span></label>
                                    <div id="ctrl-ward-holder" class=""> 
                                        <select required=""  id="ctrl-ward" name="ward"  placeholder="Select a value ..."    class="custom-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                            $rec = $data['ward'];
                                            $ward_options = $comp_model -> application_form_ward_option_list_2();
                                            if(!empty($ward_options)){
                                            foreach($ward_options as $option){
                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                            $selected = ( $value == $rec ? 'selected' : null );
                                            ?>
                                            <option 
                                                <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
                                            </option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="landowner_or_applicant_name">LANDOWNER OR APPLICANT NAME <span class="text-danger">*</span></label>
                                    <div id="ctrl-landowner_or_applicant_name-holder" class=""> 
                                        <input id="ctrl-landowner_or_applicant_name"  value="<?php  echo $data['landowner_or_applicant_name']; ?>" type="text" placeholder="Enter LANDOWNER OR APPLICANT NAME"  required="" name="landowner_or_applicant_name"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="licensed_architect_or_engineers_name">LICENSED ARCHITECT OR ENGINEER’S NAME <span class="text-danger">*</span></label>
                                        <div id="ctrl-licensed_architect_or_engineers_name-holder" class=""> 
                                            <input id="ctrl-licensed_architect_or_engineers_name"  value="<?php  echo $data['licensed_architect_or_engineers_name']; ?>" type="text" placeholder="Enter LICENSED ARCHITECT OR ENGINEER’S NAME"  required="" name="licensed_architect_or_engineers_name"  class="form-control " />
                                            </div>
                                        </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="mobile_no">MOBILE NO <span class="text-danger">*</span></label>
                                        <div id="ctrl-mobile_no-holder" class=""> 
                                            <input id="ctrl-mobile_no"  value="<?php  echo $data['mobile_no']; ?>" type="text" placeholder="Enter LICENSED ARCHITECT OR ENGINEERS NAME"  required="" name="mobile_no"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="village_name">VILLAGE NAME <span class="text-danger">*</span></label>
                                            <div id="ctrl-village_name-holder" class=""> 
                                                <input id="ctrl-village_name"  value="<?php  echo $data['village_name']; ?>" type="text" placeholder="Enter VILLAGE NAME"  required="" name="village_name"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="survey_no">SURVEY NO. <span class="text-danger">*</span></label>
                                                <div id="ctrl-survey_no-holder" class=""> 
                                                    <input id="ctrl-survey_no"  value="<?php  echo $data['survey_no']; ?>" type="text" placeholder="Enter SURVEY NO."  required="" name="survey_no"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="house_no">HOUSE NO. <span class="text-danger">*</span></label>
                                                    <div id="ctrl-house_no-holder" class=""> 
                                                        <input id="ctrl-house_no"  value="<?php  echo $data['house_no']; ?>" type="text" placeholder="Enter HOUSE NO."  required="" name="house_no"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="taluka_name">TALUKA NAME <span class="text-danger">*</span></label>
                                                        <div id="ctrl-taluka_name-holder" class=""> 
                                                            <input id="ctrl-taluka_name"  value="<?php  echo $data['taluka_name']; ?>" type="text" placeholder="Enter TALUKA NAME"  required="" name="taluka_name"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <fieldset><legend>INFORMATION OF BUILDING PROPOSAL AS PER PLANS ATTACHED</legend>
                                                            <div class="form-group ">
                                                                <label class="control-label" for="bldg_no">BUILDING NO. <span class="text-danger">*</span></label>
                                                                <div id="ctrl-bldg_no-holder" class=""> 
                                                                    <input id="ctrl-bldg_no"  value="<?php  echo $data['bldg_no']; ?>" type="text" placeholder="Enter BUILDING NO."  required="" name="bldg_no"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="property_address">PROPERTY ADDRESS <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-property_address-holder" class=""> 
                                                                        <textarea placeholder="Enter PROPERTY ADDRESS" id="ctrl-property_address"  required="" rows="5" name="property_address" class=" form-control"><?php  echo $data['property_address']; ?></textarea>
                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="landmark">LANDMARK <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-landmark-holder" class=""> 
                                                                        <textarea placeholder="Enter LANDMARK" id="ctrl-landmark"  required="" rows="1" name="landmark" class=" form-control"><?php  echo $data['landmark']; ?></textarea>
                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group d-none">
                                                                    <label class="control-label" for="are_all_connections_disconnected_on_site_from_main_line">ARE ALL  CONNECTIONS ON SITE DISCONNECTED FROM THE MAIN LINE ? <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-are_all_connections_disconnected_on_site_from_main_line-holder" class=""> 
                                                                        <select required=""  id="ctrl-are_all_connections_disconnected_on_site_from_main_line" name="are_all_connections_disconnected_on_site_from_main_line"  placeholder="Select a value ..."    class="custom-select" >
                                                                            <option value="N/A" selected>NA</option>
                                                                            <?php
                                                                            $are_all_connections_disconnected_on_site_from_main_line_options = Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient;
                                                                            $field_value = $data['are_all_connections_disconnected_on_site_from_main_line'];
                                                                            if(!empty($are_all_connections_disconnected_on_site_from_main_line_options)){
                                                                            foreach($are_all_connections_disconnected_on_site_from_main_line_options as $option){
                                                                            $value = $option['value'];
                                                                            $label = $option['label'];
                                                                            $selected = ( $value == $field_value ? 'selected' : null );
                                                                            ?>
                                                                            <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                                                <?php echo $label ?>
                                                                            </option>                                   
                                                                            <?php
                                                                            }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="is_sewage_treatment_plant_proposed_for_the_proposal">IS A SEWAGE TREATMENT PLANT PROPOSED FOR THE PROPOSAL? <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-is_sewage_treatment_plant_proposed_for_the_proposal-holder" class=""> 
                                                                        <select required=""  id="ctrl-is_sewage_treatment_plant_proposed_for_the_proposal" name="is_sewage_treatment_plant_proposed_for_the_proposal"  placeholder="Select a value ..."    class="custom-select" >
                                                                            <option value="">Select a value ...</option>
                                                                            <?php
                                                                            $is_sewage_treatment_plant_proposed_for_the_proposal_options = Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient;
                                                                            $field_value = $data['is_sewage_treatment_plant_proposed_for_the_proposal'];
                                                                            if(!empty($is_sewage_treatment_plant_proposed_for_the_proposal_options)){
                                                                            foreach($is_sewage_treatment_plant_proposed_for_the_proposal_options as $option){
                                                                            $value = $option['value'];
                                                                            $label = $option['label'];
                                                                            $selected = ( $value == $field_value ? 'selected' : null );
                                                                            ?>
                                                                            <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                                                <?php echo $label ?>
                                                                            </option>                                   
                                                                            <?php
                                                                            }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="proposed_quantity_of_residences">PROPOSED WATER REQUIREMENT FOR RESIDENCES <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-proposed_quantity_of_residences-holder" class=""> 
                                                                        <input id="ctrl-proposed_quantity_of_residences"  value="<?php  echo $data['proposed_quantity_of_residences']; ?>" type="number" placeholder="Enter PROPOSED WATER REQUIREMENT FOR RESIDENCES" step="1"  required="" name="proposed_quantity_of_residences"  class="form-control " />
                                                                        </div>
                                                                        <small class="form-text"><span class='text-danger'>Enter Only the Numeric Value</span></small>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label class="control-label" for="proposed_quantity_of_shops">PROPOSED QUANTITY OF WATER FOR SHOPS (LITRE) <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-proposed_quantity_of_shops-holder" class=""> 
                                                                            <input id="ctrl-proposed_quantity_of_shops"  value="<?php  echo $data['proposed_quantity_of_shops']; ?>" type="number" placeholder="Enter PROPOSED QUANTITY OF WATER FOR SHOPS (LITRE)" step="1"  required="" name="proposed_quantity_of_shops"  class="form-control " />
                                                                            </div>
                                                                            <small class="form-text"><span class='text-danger'>Enter Only the Numeric Value</span></small>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <label class="control-label" for="proposed_quantity_of_offices">PROPOSED QUANTITY  OF WATER FOR OFFICES  <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-proposed_quantity_of_offices-holder" class=""> 
                                                                                <input id="ctrl-proposed_quantity_of_offices"  value="<?php  echo $data['proposed_quantity_of_offices']; ?>" type="number" placeholder="Enter PROPOSED QUANTITY  OF WATER FOR OFFICES " step="1"  required="" name="proposed_quantity_of_offices"  class="form-control " />
                                                                                </div>
                                                                                <small class="form-text"><span class='text-danger'>Enter Only the Numeric Value</span></small>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <label class="control-label" for="total">TOTAL QUANTITY OF WATER REQUIRED (LITRE) <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-total-holder" class=""> 
                                                                                    <input id="ctrl-total"  value="<?php  echo $data['total']; ?>" type="text" placeholder="Enter TOTAL QUANTITY OF WATER REQUIRED (LITRE)"  readonly required="" name="total"  class="form-control " />
                                                                                    </div>
                                                                                    <small class="form-text"><p style="color: green; font-size: 12px; font-weight: bold;">Total of All Proposed Quantities added above</p></small>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <label class="control-label" for="are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient">ARE THE SIZES AND CAPACITIES OF THE OH AND UG TANKS SUFFICIENT ? <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient-holder" class=""> 
                                                                                        <select required=""  id="ctrl-are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient" name="are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient"  placeholder="Select a value ..."    class="custom-select" >
                                                                                            <option value="">Select a value ...</option>
                                                                                            <?php
                                                                                            $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient_options = Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient;
                                                                                            $field_value = $data['are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient'];
                                                                                            if(!empty($are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient_options)){
                                                                                            foreach($are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient_options as $option){
                                                                                            $value = $option['value'];
                                                                                            $label = $option['label'];
                                                                                            $selected = ( $value == $field_value ? 'selected' : null );
                                                                                            ?>
                                                                                            <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                                                                <?php echo $label ?>
                                                                                            </option>                                   
                                                                                            <?php
                                                                                            }
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <label class="control-label" for="length_of_ug_tank_proposed">LENGTH OF UG TANK PROPOSED <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-length_of_ug_tank_proposed-holder" class=""> 
                                                                                        <input id="ctrl-length_of_ug_tank_proposed"  value="<?php  echo $data['length_of_ug_tank_proposed']; ?>" type="text" placeholder="Enter LENGTH OF UG TANK PROPOSED"  required="" name="length_of_ug_tank_proposed"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <label class="control-label" for="width_of_ug_tank_proposed">WIDTH OF UG TANK PROPOSED <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-width_of_ug_tank_proposed-holder" class=""> 
                                                                                            <input id="ctrl-width_of_ug_tank_proposed"  value="<?php  echo $data['width_of_ug_tank_proposed']; ?>" type="text" placeholder="Enter WIDTH OF UG TANK PROPOSED"  required="" name="width_of_ug_tank_proposed"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <label class="control-label" for="depth_of_ug_tank_proposed">DEPTH OF UG TANK PROPOSED <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-depth_of_ug_tank_proposed-holder" class=""> 
                                                                                                <input id="ctrl-depth_of_ug_tank_proposed"  value="<?php  echo $data['depth_of_ug_tank_proposed']; ?>" type="text" placeholder="Enter DEPTH OF UG TANK PROPOSED"  required="" name="depth_of_ug_tank_proposed"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <label class="control-label" for="size_and_capcity_of_ug_tank_proposed">SIZE AND CAPACITY OF UG TANK PROPOSED (IN LITRE) <span class="text-danger">*</span></label>
                                                                                                <div id="ctrl-size_and_capcity_of_ug_tank_proposed-holder" class=""> 
                                                                                                    <input id="ctrl-size_and_capcity_of_ug_tank_proposed"  value="<?php  echo $data['size_and_capcity_of_ug_tank_proposed']; ?>" type="text" placeholder="Enter SIZE AND CAPACITY OF UG TANK PROPOSED (IN LITRE)"  readonly required="" name="size_and_capcity_of_ug_tank_proposed"  class="form-control " />
                                                                                                    </div>
                                                                                                    <small class="form-text"><p style="color: green; font-size: 12px; font-weight: bold;">Calculates Automatically</p></small>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <label class="control-label" for="length_of_oh_tank_proposed">LENGTH OF OH TANK PROPOSED <span class="text-danger">*</span></label>
                                                                                                    <div id="ctrl-length_of_oh_tank_proposed-holder" class=""> 
                                                                                                        <input id="ctrl-length_of_oh_tank_proposed"  value="<?php  echo $data['length_of_oh_tank_proposed']; ?>" type="text" placeholder="Enter LENGTH OF OH TANK PROPOSED"  required="" name="length_of_oh_tank_proposed"  class="form-control " />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group ">
                                                                                                        <label class="control-label" for="width_of_oh_tank_proposed">WIDTH OF OH TANK PROPOSED <span class="text-danger">*</span></label>
                                                                                                        <div id="ctrl-width_of_oh_tank_proposed-holder" class=""> 
                                                                                                            <input id="ctrl-width_of_oh_tank_proposed"  value="<?php  echo $data['width_of_oh_tank_proposed']; ?>" type="text" placeholder="Enter WIDTH OF OH TANK PROPOSED"  required="" name="width_of_oh_tank_proposed"  class="form-control " />
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group ">
                                                                                                            <label class="control-label" for="height_of_oh_tank_proposed">HEIGHT OF OH TANK PROPOSED <span class="text-danger">*</span></label>
                                                                                                            <div id="ctrl-height_of_oh_tank_proposed-holder" class=""> 
                                                                                                                <input id="ctrl-height_of_oh_tank_proposed"  value="<?php  echo $data['height_of_oh_tank_proposed']; ?>" type="text" placeholder="Enter HEIGHT OF OH TANK PROPOSED"  required="" name="height_of_oh_tank_proposed"  class="form-control " />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <label class="control-label" for="size_and_capcity_of_oh_tank_proposed">SIZE AND CAPACITY OF OH TANK PROPOSED (IN LITRE) <span class="text-danger">*</span></label>
                                                                                                                <div id="ctrl-size_and_capcity_of_oh_tank_proposed-holder" class=""> 
                                                                                                                    <input id="ctrl-size_and_capcity_of_oh_tank_proposed"  value="<?php  echo $data['size_and_capcity_of_oh_tank_proposed']; ?>" type="text" placeholder="Enter SIZE AND CAPACITY OF OH TANK PROPOSED (IN LITRE)"  readonly required="" name="size_and_capcity_of_oh_tank_proposed"  class="form-control " />
                                                                                                                    </div>
                                                                                                                    <small class="form-text"><p style="color: green; font-size: 12px; font-weight: bold;">Calculates Automatically</p></small>
                                                                                                                </div>
                                                                                                                <div class="form-group ">
                                                                                                                    <label class="control-label" for="distance_of_ug_tank_from_supply_line">DISTANCE OF UG TANK FROM SUPPLY LINE <span class="text-danger">*</span></label>
                                                                                                                    <div id="ctrl-distance_of_ug_tank_from_supply_line-holder" class=""> 
                                                                                                                        <input id="ctrl-distance_of_ug_tank_from_supply_line"  value="<?php  echo $data['distance_of_ug_tank_from_supply_line']; ?>" type="text" placeholder="Enter DISTANCE OF UG TANK FROM SUPPLY LINE"  required="" name="distance_of_ug_tank_from_supply_line"  class="form-control " />
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group ">
                                                                                                                        <label class="control-label" for="upload_building_plan">UPLOAD BUILDING PLAN <span class="text-danger">*</span></label>
                                                                                                                        <div id="ctrl-upload_building_plan-holder" class=""> 
                                                                                                                            <div class="dropzone required" input="#ctrl-upload_building_plan" fieldname="upload_building_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                <input name="upload_building_plan" id="ctrl-upload_building_plan" required="" class="dropzone-input form-control" value="<?php  echo $data['upload_building_plan']; ?>" type="text"  />
                                                                                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <?php Html :: uploaded_files_list($data['upload_building_plan'], '#ctrl-upload_building_plan'); ?>
                                                                                                                        </div>
                                                                                                                        <div class="form-group ">
                                                                                                                            <label class="control-label" for="upload_detailed_location_plan">UPLOAD MUNICIPAL PLAN <span class="text-danger">*</span></label>
                                                                                                                            <div id="ctrl-upload_detailed_location_plan-holder" class=""> 
                                                                                                                                <div class="dropzone required" input="#ctrl-upload_detailed_location_plan" fieldname="upload_detailed_location_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                    <input name="upload_detailed_location_plan" id="ctrl-upload_detailed_location_plan" required="" class="dropzone-input form-control" value="<?php  echo $data['upload_detailed_location_plan']; ?>" type="text"  />
                                                                                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <?php Html :: uploaded_files_list($data['upload_detailed_location_plan'], '#ctrl-upload_detailed_location_plan'); ?>
                                                                                                                            </div>
                                                                                                                            <div class="form-group ">
                                                                                                                                <label class="control-label" for="upload_complete_building_layout_plan">UPLOAD OTHER DOCUMENT <span class="text-danger">*</span></label>
                                                                                                                                <div id="ctrl-upload_complete_building_layout_plan-holder" class=""> 
                                                                                                                                    <div class="dropzone required" input="#ctrl-upload_complete_building_layout_plan" fieldname="upload_complete_building_layout_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                        <input name="upload_complete_building_layout_plan" id="ctrl-upload_complete_building_layout_plan" required="" class="dropzone-input form-control" value="<?php  echo $data['upload_complete_building_layout_plan']; ?>" type="text"  />
                                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                    <?php Html :: uploaded_files_list($data['upload_complete_building_layout_plan'], '#ctrl-upload_complete_building_layout_plan'); ?>
                                                                                                                                </div>
                                                                                                                                 <div class="form-group ">
                                                                                            <label class="control-label" for="upload_water_tank_plan">UPLOAD WATER TANK PLAN <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-upload_water_tank_plan-holder" class=""> 
                                                                                                <div class="dropzone required" input="#ctrl-upload_water_tank_plan" fieldname="upload_water_tank_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                    <input name="upload_water_tank_plan" id="ctrl-upload_water_tank_plan" required="" class="dropzone-input form-control" value="<?php  echo $data['upload_water_tank_plan']; ?>" type="text"  />
                                                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <?php Html :: uploaded_files_list($data['upload_water_tank_plan'], '#ctrl-upload_water_tank_plan'); ?>
                                                                                            </div>
                                                                                        <div class="form-group ">
                                                                                            <label class="control-label" for="upload_property_google_location_with_coordinates">UPLOAD PROPERTY GOOGLE LOCATION WITH COORDINATES <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-upload_property_google_location_with_coordinates-holder" class=""> 
                                                                                                <div class="dropzone required" input="#ctrl-upload_property_google_location_with_coordinates" fieldname="upload_property_google_location_with_coordinates"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                    <input name="upload_property_google_location_with_coordinates" id="ctrl-upload_property_google_location_with_coordinates" required="" class="dropzone-input form-control" value="<?php  echo $data['upload_property_google_location_with_coordinates']; ?>" type="text"  />
                                                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <?php Html :: uploaded_files_list($data['upload_property_google_location_with_coordinates'], '#ctrl-upload_property_google_location_with_coordinates'); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                                                            </fieldset>
                                                                                                                        </div>
                                                                                                                        <div class="form-ajax-status"></div>
                                                                                                                        <div class="form-group text-center">
                                                                                                                            <button class="btn btn-primary" type="submit">
                                                                                                                                Update
                                                                                                                                <i class="fa fa-send"></i>
                                                                                                                            </button>
                                                                                                                        </div>
                                                                                                                    </form>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </section>
