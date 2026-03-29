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
                    <h4 class="record-title">Edit  Information Of Plan Oc</h4>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("information_of_plan_oc/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $data['rec_id']; ?>" type="hidden" placeholder="Enter Rec Id"  required="" name="rec_id"  class="form-control " />
                                    <fieldset><legend>TO BE FILLED BY WATER SUPPLY DEPT</legend>
                                        <div class="form-group ">
                                            <label class="control-label" for="application_no">APPLICATION NO. <span class="text-danger">*</span></label>
                                            <div id="ctrl-application_no-holder" class=""> 
                                                <input id="ctrl-application_no"  value="<?php  echo $data['application_no']; ?>" type="text" placeholder="Enter APPLICATION NO."  readonly required="" name="application_no"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="is_property_distrubution_network_available">IS PROPERTY DISTRUBUTION NETWORK AVAILABLE? <span class="text-danger">*</span></label>
                                                <div id="ctrl-is_property_distrubution_network_available-holder" class=""> 
                                                    <select required=""  id="ctrl-is_property_distrubution_network_available" name="is_property_distrubution_network_available"  placeholder="Select a value ..."    class="custom-select" >
                                                        <option value="">Select a value ...</option>
                                                        <?php
                                                        $is_property_distrubution_network_available_options = Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient;
                                                        $field_value = $data['is_property_distrubution_network_available'];
                                                        if(!empty($is_property_distrubution_network_available_options)){
                                                        foreach($is_property_distrubution_network_available_options as $option){
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
                                                <label class="control-label" for="available_esr_name">AVAILABLE ESR NAME <span class="text-danger">*</span></label>
                                                <div id="ctrl-available_esr_name-holder" class=""> 
                                                    <input id="ctrl-available_esr_name"  value="<?php  echo $data['available_esr_name']; ?>" type="text" placeholder="Enter AVAILABLE ESR NAME"  required="" name="available_esr_name"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="available_details_of_main_supply_line">AVAILABLE DETAILS OF MAIN SUPPLY LINE <span class="text-danger">*</span></label>
                                                    <div id="ctrl-available_details_of_main_supply_line-holder" class=""> 
                                                        <input id="ctrl-available_details_of_main_supply_line"  value="<?php  echo $data['available_details_of_main_supply_line']; ?>" type="text" placeholder="Enter AVAILABLE DETAILS OF MAIN SUPPLY LINE"  required="" name="available_details_of_main_supply_line"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="available_diameter">AVAILABLE DIAMETER (IN MM) <span class="text-danger">*</span></label>
                                                        <div id="ctrl-available_diameter-holder" class=""> 
                                                            <input id="ctrl-available_diameter"  value="<?php  echo $data['available_diameter']; ?>" type="number" placeholder="Enter AVAILABLE DIAMETER (IN MM)" step="0.001"  required="" name="available_diameter"  class="form-control " />
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label class="control-label" for="available_pressure">AVAILABLE PRESSURE (KG/CM²) <span class="text-danger">*</span></label>
                                                            <div id="ctrl-available_pressure-holder" class=""> 
                                                                <input id="ctrl-available_pressure"  value="<?php  echo $data['available_pressure']; ?>" type="number" placeholder="Enter AVAILABLE PRESSURE (KG/CM²)" step="0.001"  required="" name="available_pressure"  class="form-control " />
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <label class="control-label" for="distance_of_property_from_main_supply_line">DISTANCE OF PROPERTY FROM MAIN SUPPLY LINE  (METER) <span class="text-danger">*</span></label>
                                                                <div id="ctrl-distance_of_property_from_main_supply_line-holder" class=""> 
                                                                    <input id="ctrl-distance_of_property_from_main_supply_line"  value="<?php  echo $data['distance_of_property_from_main_supply_line']; ?>" type="number" placeholder="Enter DISTANCE OF PROPERTY FROM MAIN SUPPLY LINE  (METER)" step="0.001"  required="" name="distance_of_property_from_main_supply_line"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <label class="control-label" for="proposed_esr_name">PROPOSED ESR NAME <span class="text-danger">*</span></label>
                                                                    <div id="ctrl-proposed_esr_name-holder" class=""> 
                                                                        <input id="ctrl-proposed_esr_name"  value="<?php  echo $data['proposed_esr_name']; ?>" type="text" placeholder="Enter PROPOSED ESR NAME"  required="" name="proposed_esr_name"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label class="control-label" for="proposed_details_of_main_supply_line">Proposed Details Of Main Supply Line <span class="text-danger">*</span></label>
                                                                        <div id="ctrl-proposed_details_of_main_supply_line-holder" class=""> 
                                                                            <input id="ctrl-proposed_details_of_main_supply_line"  value="<?php  echo $data['proposed_details_of_main_supply_line']; ?>" type="text" placeholder="Enter Proposed Details Of Main Supply Line"  required="" name="proposed_details_of_main_supply_line"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                            <label class="control-label" for="required_distribution_line">REQUIRED DISTRIBUTION LINE <span class="text-danger">*</span></label>
                                                                            <div id="ctrl-required_distribution_line-holder" class=""> 
                                                                                <input id="ctrl-required_distribution_line"  value="<?php  echo $data['required_distribution_line']; ?>" type="text" placeholder="Enter REQUIRED DISTRIBUTION LINE"  required="" name="required_distribution_line"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <label class="control-label" for="proposed_diameter">PROPOSED DIAMETER (IN MM) <span class="text-danger">*</span></label>
                                                                                <div id="ctrl-proposed_diameter-holder" class=""> 
                                                                                    <input id="ctrl-proposed_diameter"  value="<?php  echo $data['proposed_diameter']; ?>" type="number" placeholder="Enter PROPOSED DIAMETER (IN MM)" step="0.001"  required="" name="proposed_diameter"  class="form-control " />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group ">
                                                                                    <label class="control-label" for="proposed_length">PROPOSED LENGTH (IN METER) <span class="text-danger">*</span></label>
                                                                                    <div id="ctrl-proposed_length-holder" class=""> 
                                                                                        <input id="ctrl-proposed_length"  value="<?php  echo $data['proposed_length']; ?>" type="number" placeholder="Enter PROPOSED LENGTH (IN METER)" step="0.001"  required="" name="proposed_length"  class="form-control " />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group ">
                                                                                        <label class="control-label" for="approximate_cost_of_required_w_s_network_line">APPROXIMATE COST OF REQUIRED W S NETWORK LINE <span class="text-danger">*</span></label>
                                                                                        <div id="ctrl-approximate_cost_of_required_w_s_network_line-holder" class=""> 
                                                                                            <input id="ctrl-approximate_cost_of_required_w_s_network_line"  value="<?php  echo $data['approximate_cost_of_required_w_s_network_line']; ?>" type="number"  step="0.001" placeholder="Enter APPROXIMATE COST OF REQUIRED W S NETWORK LINE"  required="" name="approximate_cost_of_required_w_s_network_line"  class="form-control " />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group ">
                                                                                            <label class="control-label" for="additional_sump_and_pump_house_of_society">ADDITIONAL SUMP AND PUMP HOUSE OF SOCIETY <span class="text-danger">*</span></label>
                                                                                            <div id="ctrl-additional_sump_and_pump_house_of_society-holder" class=""> 
                                                                                                <input id="ctrl-additional_sump_and_pump_house_of_society"  value="<?php  echo $data['additional_sump_and_pump_house_of_society']; ?>" type="number" step="0.001" placeholder="Enter ADDITIONAL SUMP AND PUMP HOUSE OF SOCIETY"  required="" name="additional_sump_and_pump_house_of_society"  class="form-control " />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group ">
                                                                                                <label class="control-label" for="extending_or_laying_new_pipe_lines_of">EXTENDING OR LAYING NEW PIPE LINES OF <span class="text-danger">*</span></label>
                                                                                                <div id="ctrl-extending_or_laying_new_pipe_lines_of-holder" class=""> 
                                                                                                    <input id="ctrl-extending_or_laying_new_pipe_lines_of"  value="<?php  echo $data['extending_or_laying_new_pipe_lines_of']; ?>" type="number" step="0.001" placeholder="Enter EXTENDING OR LAYING NEW PIPE LINES OF"  required="" name="extending_or_laying_new_pipe_lines_of"  class="form-control " />
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
