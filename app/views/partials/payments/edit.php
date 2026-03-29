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
                    <h4 class="record-title">Edit  Payments</h4>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("payments/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <input id="ctrl-rec_id"  value="<?php  echo $data['rec_id']; ?>" type="hidden" placeholder="Enter Rec Id"  required="" name="rec_id"  class="form-control " />
                                    <div class="form-group ">
                                        <label class="control-label" for="amount">AMOUNT (SCRUTINY FEES) <span class="text-danger">*</span></label>
                                        <div id="ctrl-amount-holder" class=""> 
                                            <input id="ctrl-amount"  value="<?php  echo $data['amount']; ?>" type="text" placeholder="Enter AMOUNT (SCRUTINY FEES)"  readonly required="" name="amount"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="payment_mode">PAYMENT MODE  <span class="text-danger">*</span></label>
                                            <div id="ctrl-payment_mode-holder" class=""> 
                                                <select required=""  id="ctrl-payment_mode" name="payment_mode"  placeholder="Select a value ..."    class="custom-select" >
                                                    <option value="">Select a value ...</option>
                                                    <?php
                                                    $payment_mode_options = Menu :: $payment_mode;
                                                    $field_value = $data['payment_mode'];
                                                    if(!empty($payment_mode_options)){
                                                    foreach($payment_mode_options as $option){
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
                                            <label class="control-label" for="payment_person">Payment Person's Name <span class="text-danger">*</span></label>
                                            <div id="ctrl-payment_person-holder" class=""> 
                                                <input id="ctrl-payment_person"  value="<?php  echo $data['payment_person']; ?>" type="text" placeholder="Enter Payment Person's Name"  required="" name="payment_person"  class="form-control " />
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="payment_cash_collection_center">PAYMENT CASH COLLECTION CENTER  <span class="text-danger">*</span></label>
                                                <div id="ctrl-payment_cash_collection_center-holder" class=""> 
                                                    <input id="ctrl-payment_cash_collection_center"  value="<?php  echo $data['payment_cash_collection_center']; ?>" type="text" placeholder="Enter Payment Cash Collection Center"  required="" name="payment_cash_collection_center"  class="form-control " />
                                                    </div>
                                                </div>
                                                <input id="ctrl-db_name"  value="<?php  echo $data['db_name']; ?>" type="hidden" placeholder="Enter Db Name"  name="db_name"  class="form-control " />
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
