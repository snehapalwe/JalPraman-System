<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("information_of_plan/add");
$can_edit = ACL::is_allowed("information_of_plan/edit");
$can_view = ACL::is_allowed("information_of_plan/view");
$can_delete = ACL::is_allowed("information_of_plan/delete");
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
                    <h4 class="record-title">View  Information Of Plan</h4>
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
                                    <tr  class="td-distance_of_property_from_main_supply_line">
                                        <th class="title"> Distance Of Property From Main Supply Line: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="any" 
                                                data-value="<?php echo $data['distance_of_property_from_main_supply_line']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="distance_of_property_from_main_supply_line" 
                                                data-title="Enter Distance Of Property From Main Supply Line" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['distance_of_property_from_main_supply_line']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-length">
                                        <th class="title"> Length: </th>
                                        <td class="value"> <?php echo $data['length']; ?></td>
                                    </tr>
                                    <tr  class="td-required_distribution_line">
                                        <th class="title"> Required Distribution Line: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['required_distribution_line']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="required_distribution_line" 
                                                data-title="Enter Required Distribution Line" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['required_distribution_line']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-approximate_cost_of_required_w_s_network_line">
                                        <th class="title"> Approximate Cost Of Required W S Network Line: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['approximate_cost_of_required_w_s_network_line']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="approximate_cost_of_required_w_s_network_line" 
                                                data-title="Enter Approximate Cost Of Required W S Network Line" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['approximate_cost_of_required_w_s_network_line']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rs">
                                        <th class="title"> Rs: </th>
                                        <td class="value"> <?php echo $data['rs']; ?></td>
                                    </tr>
                                    <tr  class="td-application_no">
                                        <th class="title"> Application No: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['application_no']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="application_no" 
                                                data-title="Enter APPLICATION NO." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['application_no']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-is_property_distrubution_network_available">
                                        <th class="title"> Is Property Distrubution Network Available: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient); ?>' 
                                                data-value="<?php echo $data['is_property_distrubution_network_available']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="is_property_distrubution_network_available" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['is_property_distrubution_network_available']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-extending_or_laying_new_pipe_lines_of">
                                        <th class="title"> Extending Or Laying New Pipe Lines Of: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['extending_or_laying_new_pipe_lines_of']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="extending_or_laying_new_pipe_lines_of" 
                                                data-title="Enter EXTENDING OR LAYING NEW PIPE LINES OF" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['extending_or_laying_new_pipe_lines_of']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-additional_sump_and_pump_house_of_society">
                                        <th class="title"> Additional Sump And Pump House Of Society: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['additional_sump_and_pump_house_of_society']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="additional_sump_and_pump_house_of_society" 
                                                data-title="Enter ADDITIONAL SUMP AND PUMP HOUSE OF SOCIETY" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['additional_sump_and_pump_house_of_society']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-available_esr_name">
                                        <th class="title"> Available Esr Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['available_esr_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="available_esr_name" 
                                                data-title="Enter AVAILABLE ESR NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['available_esr_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-available_details_of_main_supply_line">
                                        <th class="title"> Available Details Of Main Supply Line: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['available_details_of_main_supply_line']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="available_details_of_main_supply_line" 
                                                data-title="Enter AVAILABLE DETAILS OF MAIN SUPPLY LINE" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['available_details_of_main_supply_line']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-available_diameter">
                                        <th class="title"> Available Diameter: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['available_diameter']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="available_diameter" 
                                                data-title="Enter AVAILABLE DIAMETER (IN MM)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['available_diameter']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-available_pressure">
                                        <th class="title"> Available Pressure: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['available_pressure']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="available_pressure" 
                                                data-title="Enter AVAILABLE PRESSURE (KG/CM²)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['available_pressure']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-proposed_esr_name">
                                        <th class="title"> Proposed Esr Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['proposed_esr_name']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="proposed_esr_name" 
                                                data-title="Enter PROPOSED ESR NAME" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['proposed_esr_name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-proposed_details_of_main_supply_line">
                                        <th class="title"> Proposed Details Of Main Supply Line: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['proposed_details_of_main_supply_line']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="proposed_details_of_main_supply_line" 
                                                data-title="Enter PROPOSED DETAILS OF MAIN SUPPLY LINE" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['proposed_details_of_main_supply_line']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-proposed_diameter">
                                        <th class="title"> Proposed Diameter: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['proposed_diameter']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="proposed_diameter" 
                                                data-title="Enter PROPOSED DIAMETER (IN MM)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['proposed_diameter']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-proposed_length">
                                        <th class="title"> Proposed Length: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['proposed_length']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("information_of_plan/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="proposed_length" 
                                                data-title="Enter PROPOSED LENGTH (IN METER)" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['proposed_length']; ?> 
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
                                <a class="btn btn-sm btn-info"  href="<?php print_link("information_of_plan/edit/$rec_id"); ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <?php } ?>
                                <?php if($can_delete){ ?>
                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("information_of_plan/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                    <i class="fa fa-times"></i> Delete
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
