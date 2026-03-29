<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><strong style='color: black;'>ADD NEW WATER TECHNICAL NOC APPLICATION</strong></h4>
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
                        <form id="application_form-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("application_form/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <!--<a id='saveBtn' class='btn btn-primary' style="float:right;color:white">SAVE</a>-->
                                
                                
                                                                                                                            <div class="form-group ">
                                                                                                                                <label class="control-label" for="upload_full_potential_plan">UPLOAD FULL POTENTIAL PLAN <span class="text-danger">*</span></label>
                                                                                                                                <div id="ctrl-upload_full_potential_plan-holder" class=""> 
                                                                                                                                    <div class="dropzone required" input="#ctrl-upload_full_potential_plan" fieldname="upload_full_potential_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                        <input name="upload_full_potential_plan" id="ctrl-upload_full_potential_plan" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_full_potential_plan',""); ?>" type="text"  />
                                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                
                                                                                                                                
                                <div class="form-group ">
                                    <label class="control-label" for="ward">WARD <span class="text-danger">*</span></label>
                                    <div id="ctrl-ward-holder" class=""> 
                                        <select required=""  id="ctrl-ward" name="ward"  placeholder="Select a value ..."    class="custom-select" >
                                            <option value="">Select a value ...</option>
                                            <?php 
                                            $ward_options = $comp_model -> application_form_ward_option_list_2();
                                            if(!empty($ward_options)){
                                            foreach($ward_options as $option){
                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                            $selected = $this->set_field_selected('ward',$value, "");
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
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
                                        <input id="ctrl-landowner_or_applicant_name"  value="<?php  echo $this->set_field_value('landowner_or_applicant_name',""); ?>" type="text" placeholder="Enter LANDOWNER OR APPLICANT NAME"  required="" name="landowner_or_applicant_name"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="licensed_architect_or_engineers_name">LICENSED ARCHITECT OR ENGINEER’S NAME <span class="text-danger">*</span></label>
                                        <div id="ctrl-licensed_architect_or_engineers_name-holder" class=""> 
                                            <input id="ctrl-licensed_architect_or_engineers_name"  value="<?php  echo $this->set_field_value('licensed_architect_or_engineers_name',""); ?>" type="text" placeholder="Enter LICENSED ARCHITECT OR ENGINEER’S NAME"  required="" name="licensed_architect_or_engineers_name"  class="form-control " />
                                            </div>
                                        </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="mobile_no">MOBILE NO <span class="text-danger">*</span></label>
                                        <div id="ctrl-mobile_no-holder" class=""> 
                                            <input id="ctrl-mobile_no"  value="<?php  echo $this->set_field_value('mobile_no',""); ?>" type="text" placeholder="Enter MOBILE NO"  required="" name="mobile_no"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="village_name">VILLAGE NAME <span class="text-danger">*</span></label>
                                            <div id="ctrl-village_name-holder" class=""> 
                                                <input id="ctrl-village_name"  value="<?php  echo $this->set_field_value('village_name',""); ?>" type="text" placeholder="Enter VILLAGE NAME"  required="" name="village_name"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="survey_no">SURVEY NO. <span class="text-danger">*</span></label>
                                                <div id="ctrl-survey_no-holder" class=""> 
                                                    <input id="ctrl-survey_no"  value="<?php  echo $this->set_field_value('survey_no',""); ?>" type="text" placeholder="Enter SURVEY NO."  required="" name="survey_no"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="house_no">HOUSE NO. <span class="text-danger">*</span></label>
                                                    <div id="ctrl-house_no-holder" class=""> 
                                                        <input id="ctrl-house_no"  value="<?php  echo $this->set_field_value('house_no',""); ?>" type="text" placeholder="Enter HOUSE NO."  required="" name="house_no"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="taluka_name">TALUKA NAME <span class="text-danger">*</span></label>
                                                        <div id="ctrl-taluka_name-holder" class=""> 
                                                            <input id="ctrl-taluka_name"  value="<?php  echo $this->set_field_value('taluka_name',""); ?>" type="text" placeholder="Enter TALUKA NAME"  required="" name="taluka_name"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <fieldset><legend style="color:black; font-size:20px; font-weight:bold;">INFORMATION OF BUILDING PROPOSAL AS PER PLANS ATTACHED</legend>
                                                            <div class="form-group ">
                                                                <label class="control-label" for="bldg_no">BUILDING NO. <span class="text-danger">*</span></label>
                                                                <div id="ctrl-bldg_no-holder" class=""> 
                                                                    <input id="ctrl-bldg_no"  value="<?php  echo $this->set_field_value('bldg_no',""); ?>" type="text" placeholder="Enter BUILDING NO."  required="" name="bldg_no"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="property_address">PROPERTY ADDRESS <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-property_address-holder" class=""> 
                                                                        <textarea placeholder="Enter PROPERTY ADDRESS" id="ctrl-property_address"  required="" rows="5" name="property_address" class=" form-control"><?php  echo $this->set_field_value('property_address',""); ?></textarea>
                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="landmark">LANDMARK <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-landmark-holder" class=""> 
                                                                        <textarea placeholder="Enter LANDMARK" id="ctrl-landmark"  required="" rows="1" name="landmark" class=" form-control"><?php  echo $this->set_field_value('landmark',""); ?></textarea>
                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group d-none">
                                                                    <label class="control-label" for="are_all_connections_disconnected_on_site_from_main_line">ARE ALL  CONNECTIONS ON SITE DISCONNECTED FROM THE MAIN LINE ? <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-are_all_connections_disconnected_on_site_from_main_line-holder" class=""> 
                                                                        <select required=""  id="ctrl-are_all_connections_disconnected_on_site_from_main_line" name="are_all_connections_disconnected_on_site_from_main_line"  placeholder="Select a value ..."    class="custom-select" >
                                                                            <option selected value="N/A">NA</option>
                                                                            <?php
                                                                            $are_all_connections_disconnected_on_site_from_main_line_options = Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient;
                                                                            if(!empty($are_all_connections_disconnected_on_site_from_main_line_options)){
                                                                            foreach($are_all_connections_disconnected_on_site_from_main_line_options as $option){
                                                                            $value = $option['value'];
                                                                            $label = $option['label'];
                                                                            $selected = $this->set_field_selected('are_all_connections_disconnected_on_site_from_main_line', $value, "");
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
                                                                            if(!empty($is_sewage_treatment_plant_proposed_for_the_proposal_options)){
                                                                            foreach($is_sewage_treatment_plant_proposed_for_the_proposal_options as $option){
                                                                            $value = $option['value'];
                                                                            $label = $option['label'];
                                                                            $selected = $this->set_field_selected('is_sewage_treatment_plant_proposed_for_the_proposal', $value, "");
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
                                                                        <input id="ctrl-proposed_quantity_of_residences"  value="<?php  echo $this->set_field_value('proposed_quantity_of_residences',""); ?>" type="number" placeholder="Enter PROPOSED WATER REQUIREMENT FOR RESIDENCES" step="1"  required="" name="proposed_quantity_of_residences"  class="form-control " />
                                                                        </div>
                                                                        <small class="form-text"><span class='text-danger'>Enter Only the Numeric Value</span></small>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label class="control-label" for="proposed_quantity_of_shops">PROPOSED QUANTITY OF WATER FOR SHOPS (LITRE) <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-proposed_quantity_of_shops-holder" class=""> 
                                                                            <input id="ctrl-proposed_quantity_of_shops"  value="<?php  echo $this->set_field_value('proposed_quantity_of_shops',""); ?>" type="number" placeholder="Enter PROPOSED QUANTITY OF WATER FOR SHOPS (LITRE)" step="1"  required="" name="proposed_quantity_of_shops"  class="form-control " />
                                                                            </div>
                                                                            <small class="form-text"><span class='text-danger'>Enter Only the Numeric Value</span></small>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <label class="control-label" for="proposed_quantity_of_offices">PROPOSED QUANTITY  OF WATER FOR OFFICES  <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-proposed_quantity_of_offices-holder" class=""> 
                                                                                <input id="ctrl-proposed_quantity_of_offices"  value="<?php  echo $this->set_field_value('proposed_quantity_of_offices',""); ?>" type="number" placeholder="Enter PROPOSED QUANTITY  OF WATER FOR OFFICES " step="1"  required="" name="proposed_quantity_of_offices"  class="form-control " />
                                                                                </div>
                                                                                <small class="form-text"><span class='text-danger'>Enter Only the Numeric Value</span></small>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <label class="control-label" for="total">TOTAL QUANTITY OF WATER REQUIRED (LITRE) <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-total-holder" class=""> 
                                                                                    <input id="ctrl-total"  value="<?php  echo $this->set_field_value('total',""); ?>" type="text" placeholder="Enter TOTAL QUANTITY OF WATER REQUIRED (LITRE)"  readonly required="" name="total"  class="form-control " />
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
                                                                                            if(!empty($are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient_options)){
                                                                                            foreach($are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient_options as $option){
                                                                                            $value = $option['value'];
                                                                                            $label = $option['label'];
                                                                                            $selected = $this->set_field_selected('are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient', $value, "");
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
                                                                                    <label class="control-label" for="length_of_ug_tank_proposed">LENGTH OF UG TANK PROPOSED (IN METER)<span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-length_of_ug_tank_proposed-holder" class=""> 
                                                                                        <input id="ctrl-length_of_ug_tank_proposed"  value="<?php  echo $this->set_field_value('length_of_ug_tank_proposed',""); ?>" type="number" placeholder="Enter LENGTH OF UG TANK PROPOSED"  step="0.01" required="" name="length_of_ug_tank_proposed"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <label class="control-label" for="width_of_ug_tank_proposed">WIDTH OF UG TANK PROPOSED (IN METER)<span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-width_of_ug_tank_proposed-holder" class=""> 
                                                                                            <input id="ctrl-width_of_ug_tank_proposed"  value="<?php  echo $this->set_field_value('width_of_ug_tank_proposed',""); ?>" type="number" placeholder="Enter WIDTH OF UG TANK PROPOSED"  step="0.01" required="" name="width_of_ug_tank_proposed"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <label class="control-label" for="depth_of_ug_tank_proposed">DEPTH OF UG TANK PROPOSED (IN METER)<span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-depth_of_ug_tank_proposed-holder" class=""> 
                                                                                                <input id="ctrl-depth_of_ug_tank_proposed"  value="<?php  echo $this->set_field_value('depth_of_ug_tank_proposed',""); ?>" type="number" placeholder="Enter DEPTH OF UG TANK PROPOSED"   step="0.01" required="" name="depth_of_ug_tank_proposed"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <label class="control-label" for="size_and_capcity_of_ug_tank_proposed">SIZE AND CAPACITY OF UG TANK PROPOSED (IN LITRE) <span class="text-danger">*</span></label>
                                                                                                <div id="ctrl-size_and_capcity_of_ug_tank_proposed-holder" class=""> 
                                                                                                    <input id="ctrl-size_and_capcity_of_ug_tank_proposed"  value="<?php  echo $this->set_field_value('size_and_capcity_of_ug_tank_proposed',""); ?>" type="text" placeholder="Enter SIZE AND CAPACITY OF UG TANK PROPOSED (IN LITRE)"  readonly required="" name="size_and_capcity_of_ug_tank_proposed"  class="form-control " />
                                                                                                    </div>
                                                                                                    <small class="form-text"><p style="color: green; font-size: 12px; font-weight: bold;">Calculates Automatically</p></small>
                                                                                                </div>
                                                                                                <div class="form-group ">
                                                                                                    <label class="control-label" for="length_of_oh_tank_proposed">LENGTH OF OH TANK PROPOSED (IN METER)<span class="text-danger">*</span></label>
                                                                                                    <div id="ctrl-length_of_oh_tank_proposed-holder" class=""> 
                                                                                                        <input id="ctrl-length_of_oh_tank_proposed"  value="<?php  echo $this->set_field_value('length_of_oh_tank_proposed',""); ?>" type="number" placeholder="Enter LENGTH OF OH TANK PROPOSED"  step="0.01" required="" name="length_of_oh_tank_proposed"  class="form-control " />
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group ">
                                                                                                        <label class="control-label" for="width_of_oh_tank_proposed">WIDTH OF OH TANK PROPOSED (IN METER)<span class="text-danger">*</span></label>
                                                                                                        <div id="ctrl-width_of_oh_tank_proposed-holder" class=""> 
                                                                                                            <input id="ctrl-width_of_oh_tank_proposed"  value="<?php  echo $this->set_field_value('width_of_oh_tank_proposed',""); ?>" type="number" placeholder="Enter WIDTH OF OH TANK PROPOSED"  step="0.01" required="" name="width_of_oh_tank_proposed"  class="form-control " />
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group ">
                                                                                                            <label class="control-label" for="height_of_oh_tank_proposed">HEIGHT OF OH TANK PROPOSED (IN METER)<span class="text-danger">*</span></label>
                                                                                                            <div id="ctrl-height_of_oh_tank_proposed-holder" class=""> 
                                                                                                                <input id="ctrl-height_of_oh_tank_proposed"  value="<?php  echo $this->set_field_value('height_of_oh_tank_proposed',""); ?>" type="number" placeholder="Enter HEIGHT OF OH TANK PROPOSED" step="0.01" required="" name="height_of_oh_tank_proposed"  class="form-control " />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="form-group ">
                                                                                                                <label class="control-label" for="size_and_capcity_of_oh_tank_proposed">SIZE AND CAPACITY OF OH TANK PROPOSED (IN LITRE) <span class="text-danger">*</span></label>
                                                                                                                <div id="ctrl-size_and_capcity_of_oh_tank_proposed-holder" class=""> 
                                                                                                                    <input id="ctrl-size_and_capcity_of_oh_tank_proposed"  value="<?php  echo $this->set_field_value('size_and_capcity_of_oh_tank_proposed',""); ?>" type="text" placeholder="Enter SIZE AND CAPACITY OF OH TANK PROPOSED (IN LITRE)"  readonly step="0.01" required="" name="size_and_capcity_of_oh_tank_proposed"  class="form-control " />
                                                                                                                    </div>
                                                                                                                    <small class="form-text"><p style="color: green; font-size: 12px; font-weight: bold;">Calculates Automatically</p></small>
                                                                                                                </div>
                                                                                                                <div class="form-group ">
                                                                                                                    <label class="control-label" for="distance_of_ug_tank_from_supply_line">DISTANCE OF UG TANK FROM SUPPLY LINE (IN METER)<span class="text-danger">*</span></label>
                                                                                                                    <div id="ctrl-distance_of_ug_tank_from_supply_line-holder" class=""> 
                                                                                                                        <input id="ctrl-distance_of_ug_tank_from_supply_line"  value="<?php  echo $this->set_field_value('distance_of_ug_tank_from_supply_line',""); ?>" type="text" placeholder="Enter DISTANCE OF UG TANK FROM SUPPLY LINE"  step="0.01" required="" name="distance_of_ug_tank_from_supply_line"  class="form-control " />
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="form-group ">
                                                                                                                        <label class="control-label" for="upload_building_plan">UPLOAD BUILDING PLAN <span class="text-danger">*</span></label>
                                                                                                                        <div id="ctrl-upload_building_plan-holder" class=""> 
                                                                                                                            <div class="dropzone required" input="#ctrl-upload_building_plan" fieldname="upload_building_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                <input name="upload_building_plan" id="ctrl-upload_building_plan" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_building_plan',""); ?>" type="text"  />
                                                                                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group ">
                                                                                                                            <label class="control-label" for="upload_detailed_location_plan">UPLOAD MUNICIPAL PLAN <span class="text-danger">*</span></label>
                                                                                                                            <div id="ctrl-upload_detailed_location_plan-holder" class=""> 
                                                                                                                                <div class="dropzone required" input="#ctrl-upload_detailed_location_plan" fieldname="upload_detailed_location_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                    <input name="upload_detailed_location_plan" id="ctrl-upload_detailed_location_plan" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_detailed_location_plan',""); ?>" type="text"  />
                                                                                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="form-group ">
                                                                                                                                <label class="control-label" for="upload_complete_building_layout_plan">UPLOAD OTHER DOCUMENT <span class="text-danger">*</span></label>
                                                                                                                                <div id="ctrl-upload_complete_building_layout_plan-holder" class=""> 
                                                                                                                                    <div class="dropzone required" input="#ctrl-upload_complete_building_layout_plan" fieldname="upload_complete_building_layout_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                        <input name="upload_complete_building_layout_plan" id="ctrl-upload_complete_building_layout_plan" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_complete_building_layout_plan',""); ?>" type="text"  />
                                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            <div class="form-group ">
                                                                                                                                <label class="control-label" for="upload_water_tank_plan">UPLOAD WATER TANK PLAN <span class="text-danger">*</span></label>
                                                                                                                                <div id="ctrl-upload_water_tank_plan-holder" class=""> 
                                                                                                                                    <div class="dropzone required" input="#ctrl-upload_water_tank_plan" fieldname="upload_water_tank_plan"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                        <input name="upload_water_tank_plan" id="ctrl-upload_water_tank_plan" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_water_tank_plan',""); ?>" type="text"  />
                                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            <div class="form-group ">
                                                                                                                                <label class="control-label" for="upload_property_google_location_with_coordinates">UPLOAD PROPERTY GOOGLE LOCATION WITH COORDINATES <span class="text-danger">*</span></label>
                                                                                                                                <div id="ctrl-upload_property_google_location_with_coordinates-holder" class=""> 
                                                                                                                                    <div class="dropzone required" input="#ctrl-upload_property_google_location_with_coordinates" fieldname="upload_property_google_location_with_coordinates"    data-multiple="false" dropmsg="Choose files or drag and drop files to upload"    btntext="Browse" extensions=".jpg,.png,.jpeg,.pdf" filesize="3" maximum="1">
                                                                                                                                        <input name="upload_property_google_location_with_coordinates" id="ctrl-upload_property_google_location_with_coordinates" required="" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('upload_property_google_location_with_coordinates',""); ?>" type="text"  />
                                                                                                                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </fieldset>
                                                                                                                        </div>
                                                                                                                         <div class="form-group form-submit-btn-holder mt-3">
    <div class="form-ajax-status mb-2"></div>

    <div class="d-flex justify-content-between align-items-start">

        <!-- LEFT : SAVE -->
        <div class="text-start">
            <center>
            <a id="saveBtn" style="width:250px" class="btn btn-primary text-white">
                <i class="fa fa-save"></i> SAVE
            </a>
            <div class="text-danger mt-1 " style="font-size:15px">
                Saves the information entered so far. 
                You can modify it later.
            </div>
            </center>
        </div>

        <!-- RIGHT : SUBMIT -->
        <div class="text-end">
            <center>
            <button style="width:250px" class="btn btn-primary" type="submit">
                Submit
                <i class="fa fa-send"></i>
            </button>
            <div class="text-danger mt-1 " style="font-size:15px">
                After submission, changes will not be allowed.
                Please verify all details carefully.
            </div>
            </center>
        </div>

    </div>
</div>
                                                                                                                    </form>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div  class="">
                                                                                                    <div class="container">
                                                                                                        <div class="row ">
                                                                                                            <div class="col-md-12 comp-grid">
                                                                                                                <div class=""><script>
                                                                                                                    document.addEventListener("DOMContentLoaded", function () {
                                                                                                                        const residences = document.getElementById("ctrl-proposed_quantity_of_residences");
                                                                                                                        const shops = document.getElementById("ctrl-proposed_quantity_of_shops");
                                                                                                                        const offices = document.getElementById("ctrl-proposed_quantity_of_offices");
                                                                                                                        const total = document.getElementById("ctrl-total");
                                                                                                                    
                                                                                                                        function calculateTotal() {
                                                                                                                            let res = parseFloat(residences.value) || 0;
                                                                                                                            let shp = parseFloat(shops.value) || 0;
                                                                                                                            let off = parseFloat(offices.value) || 0;
                                                                                                                    
                                                                                                                            total.value = (res + shp + off).toFixed(2); // round to 2 decimals
                                                                                                                        }
                                                                                                                    
                                                                                                                        residences.addEventListener("input", calculateTotal);
                                                                                                                        shops.addEventListener("input", calculateTotal);
                                                                                                                        offices.addEventListener("input", calculateTotal);
                                                                                                                    });
                                                                                                                    </script></div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div  class="">
                                                                                                    <div class="container">
                                                                                                        <div class="row ">
                                                                                                            <div class="col-md-12 comp-grid">
                                                                                                                <div class="">
                                                                                                                    <script>
                                                                                                                        document.addEventListener("DOMContentLoaded", function () {
                                                                                                                            const residences = document.getElementById("ctrl-length_of_ug_tank_proposed");
                                                                                                                            const shops = document.getElementById("ctrl-width_of_ug_tank_proposed");
                                                                                                                            const offices = document.getElementById("ctrl-depth_of_ug_tank_proposed");
                                                                                                                            const total = document.getElementById("ctrl-size_and_capcity_of_ug_tank_proposed");
                                                                                                                        
                                                                                                                            function calculateTotal() {
                                                                                                                                let res = parseFloat(residences.value) || 0;
                                                                                                                                let shp = parseFloat(shops.value) || 0;
                                                                                                                                let off = parseFloat(offices.value) || 0;
                                                                                                                        
                                                                                                                                let result = res * shp * off * 1000;
                                                                                                                        
                                                                                                                                total.value = result.toFixed(2);  // round to 2 decimals
                                                                                                                            }
                                                                                                                        
                                                                                                                            residences.addEventListener("input", calculateTotal);
                                                                                                                            shops.addEventListener("input", calculateTotal);
                                                                                                                            offices.addEventListener("input", calculateTotal);
                                                                                                                        });
                                                                                                                        </script></div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div  class="">
                                                                                                        <div class="container">
                                                                                                            <div class="row ">
                                                                                                                <div class="col-md-12 comp-grid">
                                                                                                                    <div class=""><script>
                                                                                                                        document.addEventListener("DOMContentLoaded", function () {
                                                                                                                            const residences = document.getElementById("ctrl-length_of_oh_tank_proposed");
                                                                                                                            const shops = document.getElementById("ctrl-width_of_oh_tank_proposed");
                                                                                                                            const offices = document.getElementById("ctrl-height_of_oh_tank_proposed");
                                                                                                                            const total = document.getElementById("ctrl-size_and_capcity_of_oh_tank_proposed");
                                                                                                                        
                                                                                                                            function calculateTotal() {
                                                                                                                                let res = parseFloat(residences.value) || 0;
                                                                                                                                let shp = parseFloat(shops.value) || 0;
                                                                                                                                let off = parseFloat(offices.value) || 0;
                                                                                                                        
                                                                                                                                let result = res * shp * off * 1000;
                                                                                                                        
                                                                                                                                total.value = result.toFixed(2); // round to 2 decimals
                                                                                                                            }
                                                                                                                        
                                                                                                                            residences.addEventListener("input", calculateTotal);
                                                                                                                            shops.addEventListener("input", calculateTotal);
                                                                                                                            offices.addEventListener("input", calculateTotal);
                                                                                                                        });
                                                                                                                        </script>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </section>
<script>
 $.getJSON("https://singlewindowsystemkdmc.in/api/common/water_tech_noc/<?php echo USER_NAME ?>", function(data) {
    data.forEach(function(group) {
        var $ctrl = $("#ctrl-" + group.field);

        if ($ctrl.is("select")) {
            // Try to select option by its visible text (label)
            var matched = false;
            $ctrl.find("option").each(function() {
                if ($(this).text().trim() === group.value.trim()) {
                    $(this).prop("selected", true);
                    matched = true;
                    return false; // stop loop
                }
            });

            // Fallback: if label not matched, try selecting by value
            if (!matched) {
                $ctrl.val(group.value);
            }

        } else {
            // For inputs, textareas, etc.
            $ctrl.val(group.value);
        }

        // Handle readonly / disabled logic
        if (group.value && group.value.trim() !== "") {
            $ctrl.prop("readonly", true);
            // For selects, use disable instead of readonly
            if ($ctrl.is("select")) {
                $ctrl.css('pointer-events', 'none');
            } else {
                $ctrl.css('pointer-events', 'none');
            }
        } else {
            $ctrl.removeAttr("readonly");
            $ctrl.prop("disabled", false);
        }

        // Hide fields with URL values
        if (group.value.startsWith("http://") || group.value.startsWith("https://")) {
            $ctrl.parents(".form-group").hide();
        }
    });
});

</script>




<script>
const SITE_ADDR  = "<?php echo SITE_ADDR; ?>";
const TABLE_NAME = "acc";

function isEmpty(val) {
    return val === "" || val === null || typeof val === "undefined";
}
function saveAllFields(payload) {

    if (!payload || $.isEmptyObject(payload)) return;

    $.ajax({
        url: SITE_ADDR + "api/save_data/" + TABLE_NAME + "/?csrf_token=<?= $csrf_token ?>",
        type: "POST",
        data: payload,
        success: function (res) {
            console.log("All fields saved", res);
        },
        error: function (err) {
            console.error("Save failed", err);
        }
    });
}


 
$(document).on("click", ".dz-delete-file", function () {

    if (!confirm("Remove uploaded file?")) return;

    let btn     = $(this);
    let dzWrap  = btn.closest(".dropzone");
    let field   = btn.data("input");
    let dzObj   = Dropzone.forElement(dzWrap[0]);

    dzObj.removeAllFiles(true); 

    $("#ctrl-" + field).val("");

    dzWrap.find(".dz-preview").remove();
    dzWrap.find(".dz-file-btn").remove();
    dzWrap.removeClass("dz-started");

    // ✅ THIS WAS MISSING
    clearField(field);
});

$(document).ready(function () {

    $.getJSON(SITE_ADDR + "api/get_data/" + TABLE_NAME, function (data) {

        $.each(data, function (field, value) {

            // ❌ ignore empty
            if (value === "" || value === null || typeof value === "undefined") return;

            // -------------------------------
            // 1️⃣ DROPZONE FIELD
            // -------------------------------
            let dz = $(".dropzone[fieldname='" + field + "']");

if (dz.find(".dz-file-btn").length === 0) {
    dz.append(`
        <div class="dz-file-btn mt-2 d-flex gap-2">

            <a target="_blank"
               href="${value}"
               class="btn btn-sm btn-outline-success">
                📄 View File
            </a>

            <button type="button"
                    class="btn btn-sm btn-outline-danger dz-delete-file"
                    data-input="${field}">
                🗑 Delete
            </button>

        </div>
    `);
}

            // -------------------------------
            // 2️⃣ NORMAL FIELD
            // -------------------------------
            let $el = $("[name='" + field + "']");

            if (!$el.length) return;

            // ❌ ignore readonly / disabled
            if ($el.prop("readonly") || $el.prop("disabled")) return;

            if ($el.is(":checkbox")) {
                $el.prop("checked", value == 1).trigger("change");
            }
            else if ($el.is(":radio")) {
                $("input[name='" + field + "'][value='" + value + "']").prop("checked", true).trigger("change");
            }
            else {
                $el.val(value).trigger("change");
            }
        });

    });

});


$(document).ready(function () {

    let isDirty = false;
    let initialData = {};

    // -----------------------------
    // CAPTURE INITIAL STATE
    // -----------------------------
 

    // -----------------------------
    // CHANGE DETECTION
    // -----------------------------
    $("input, textarea, select").on("change input", function () {
        let $el = $(this);
        let name = $el.attr("name");
        if (!name) return;

        if (initialData[name] !== getValue($el)) {
            isDirty = true;
        }
    });

    // -----------------------------
    // BLOCK PAGE LEAVE
    // -----------------------------
    window.addEventListener("beforeunload", function (e) {
        if (isDirty) {
            e.preventDefault();
            e.returnValue = "You have unsaved changes. Please save before leaving.";
            return e.returnValue;
        }
    });

    // -----------------------------
    // SAVE FUNCTION
    // -----------------------------
    function SaveData() {

        let payload = {};

        $("input, textarea, select").each(function () {

            let $el = $(this);
            let field = $el.attr("name");
            if (!field) return;

            if ($el.prop("readonly") || $el.prop("disabled")) return;

            payload[field] = getValue($el);
        });

        if ($.isEmptyObject(payload)) {
            alert("No changes to save");
            return;
        }

        saveAllFields(payload);

        // ✅ RESET DIRTY STATE
        isDirty = false;

        // update baseline
        initialData = payload;

        alert("Data has been saved successfully");
    }

    $("#saveBtn").on("click", function () {
        SaveData();
    });

    // -----------------------------
    // VALUE HANDLER
    // -----------------------------
    function getValue($el) {
        if ($el.is(":checkbox")) {
            return $el.prop("checked") ? 1 : 0;
        }
        if ($el.is(":radio")) {
            return $el.prop("checked") ? $el.val() : null;
        }
        return $el.val();
    }

});


</script>

