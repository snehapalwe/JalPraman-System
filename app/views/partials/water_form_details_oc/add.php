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
                    <h4 class="record-title"><strong style='color: black;'>ADD WATER DETAILS OC</strong></h4>
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
                        <form id="water_form_details_oc-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("water_form_details_oc/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $this->set_field_value('rec_id',""); ?>" type="hidden" placeholder="Enter Rec Id"  required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="application_no">APPLICATION NO. <span class="text-danger">*</span></label>
                                        <div id="ctrl-application_no-holder" class=""> 
                                            <input id="ctrl-application_no"  readonly value="<?php  echo $this->set_field_value('application_no',""); ?>" type="text" placeholder="Enter APPLICATION NO."  required="" name="application_no"  class="form-control " />
                                            </div>
                                            <small class="form-text"><p style="color: green; font-size: 12px; font-weight: bold;">Fetched Automatically.</p></small>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="no_of_connections">NO. OF CONNECTIONS <span class="text-danger">*</span></label>
                                            <div id="ctrl-no_of_connections-holder" class=""> 
                                                <input id="ctrl-no_of_connections"  value="<?php  echo $this->set_field_value('no_of_connections',""); ?>" type="number" placeholder="Enter NO. OF CONNECTIONS" step="1"  required="" name="no_of_connections"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="diameter">DIAMETER (IN MM) <span class="text-danger">*</span></label>
                                                <div id="ctrl-diameter-holder" class=""> 
                                                    <input id="ctrl-diameter"  value="<?php  echo $this->set_field_value('diameter',""); ?>" type="number" placeholder="Enter DIAMETER (IN MM)" step="0.001"  required="" name="diameter"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="connection_no">CONNECTION NO. <span class="text-danger">*</span></label>
                                                    <div id="ctrl-connection_no-holder" class=""> 
                                                        <input id="ctrl-connection_no"  value="<?php  echo $this->set_field_value('connection_no',""); ?>" type="text" placeholder="Enter CONNECTION NO."  required="" name="connection_no"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="are_upto_date_bills_paid">ARE UPTO DATE BILLS PAID? <span class="text-danger">*</span></label>
                                                        <div id="ctrl-are_upto_date_bills_paid-holder" class=""> 
                                                            <select required=""  id="ctrl-are_upto_date_bills_paid" name="are_upto_date_bills_paid"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php
                                                                $are_upto_date_bills_paid_options = Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient;
                                                                if(!empty($are_upto_date_bills_paid_options)){
                                                                foreach($are_upto_date_bills_paid_options as $option){
                                                                $value = $option['value'];
                                                                $label = $option['label'];
                                                                $selected = $this->set_field_selected('are_upto_date_bills_paid', $value, "");
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
                                                </div>
                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                    <div class="form-ajax-status"></div>
                                                    <button class="btn btn-primary" type="submit">
                                                        Submit
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