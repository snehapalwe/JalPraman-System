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
                    <h4 class="record-title">Edit  Water Form Details</h4>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("water_form_details/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $data['rec_id']; ?>" type="hidden" placeholder="Enter Rec Id"  required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="application_no">APPLICATION NO. <span class="text-danger">*</span></label>
                                        <div id="ctrl-application_no-holder" class=""> 
                                            <input id="ctrl-application_no"  value="<?php  echo $data['application_no']; ?>" type="text" placeholder="Enter APPLICATION NO."  readonly required="" name="application_no"  class="form-control " />
                                            </div>
                                            <small class="form-text"><p style="color: green; font-size: 12px; font-weight: bold;">Fetched Automatically.</p></small>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="no_of_connections">NO. OF CONNECTIONS <span class="text-danger">*</span></label>
                                            <div id="ctrl-no_of_connections-holder" class=""> 
                                                <input id="ctrl-no_of_connections"  value="<?php  echo $data['no_of_connections']; ?>" type="number" placeholder="Enter NO. OF CONNECTIONS" step="1"  required="" name="no_of_connections"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="diameter">DIAMETER (MM) <span class="text-danger">*</span></label>
                                                <div id="ctrl-diameter-holder" class=""> 
                                                    <input id="ctrl-diameter"  value="<?php  echo $data['diameter']; ?>" type="number" placeholder="Enter DIAMETER (MM)" step="0.01"  required="" name="diameter"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="connection_no">CONNECTION NO. <span class="text-danger">*</span></label>
                                                    <div id="ctrl-connection_no-holder" class=""> 
                                                        <input id="ctrl-connection_no"  value="<?php  echo $data['connection_no']; ?>" type="text" placeholder="Enter CONNECTION NO."  required="" name="connection_no"  class="form-control " />
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label class="control-label" for="are_upto_date_bills_paid">ARE UPTO DATE BILLS PAID? <span class="text-danger">*</span></label>
                                                        <div id="ctrl-are_upto_date_bills_paid-holder" class=""> 
                                                            <select required=""  id="ctrl-are_upto_date_bills_paid" name="are_upto_date_bills_paid"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php
                                                                $are_upto_date_bills_paid_options = Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient;
                                                                $field_value = $data['are_upto_date_bills_paid'];
                                                                if(!empty($are_upto_date_bills_paid_options)){
                                                                foreach($are_upto_date_bills_paid_options as $option){
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
