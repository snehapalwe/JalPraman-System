<?php 
/**
 * Application_form_oc Page Controller
 * @category  Controller
 */
class Application_form_ocController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "application_form_oc";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"application_no", 
			"cc_number", 
			"upload_cc_certificate", 
			"status", 
			"ward", 
			"landowner_or_applicant_name", 
			"licensed_architect_or_engineers_name", 
			"property_address", 
			"landmark", 
			"survey_no", 
			"house_no", 
			"village_name", 
			"taluka_name", 
			"mobile_no", 
			"are_all_connections_disconnected_on_site_from_main_line", 
			"is_sewage_treatment_plant_proposed_for_the_proposal", 
			"bldg_no", 
			"proposed_quantity_of_residences", 
			"proposed_quantity_of_shops", 
			"proposed_quantity_of_offices", 
			"total", 
			"are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient", 
			"length_of_ug_tank_proposed", 
			"width_of_ug_tank_proposed", 
			"depth_of_ug_tank_proposed", 
			"size_and_capcity_of_ug_tank_proposed", 
			"length_of_oh_tank_proposed", 
			"width_of_oh_tank_proposed", 
			"height_of_oh_tank_proposed", 
			"size_and_capcity_of_oh_tank_proposed", 
			"distance_of_ug_tank_from_supply_line", 
			"upload_building_plan", 
			"upload_detailed_location_plan", 
			"upload_complete_building_layout_plan", 
			"upload_declaration_certificate", 
			"timestamp", 
			"user_id", 
			"paid", 
			"certificate");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	if(USER_ROLE==2){
    $db->where("user_id",USER_ID);
}
if(USER_ROLE>=3 && USER_ROLE<=5){
    if(USER_ROLE==4){
        $db->where("(status>=1 or status<0)");
    }
    if(USER_ROLE==3){
        $db->where("(status>=2 or status<0)");
    }
    if(USER_ROLE==5){
        $db->where("(status>=3 or status<0)");
    }
    if(get_active_user("ward")!=""){
        $db->where("ward",explode(",",get_active_user("ward")),"IN"); 
    }
}
if (isset($_GET['status'])) {
    $db->where("status", $_GET['status']);
}
if (isset($_GET['status2']) && $_GET['status2']=="pending") {
    $db->where("status IN (1,2,3,4)");
$db->where("(status NOT IN (3,4) OR paid != 0)");
}
if (isset($_GET['status2']) && $_GET['status2']=="completed") {
    $db->where("status IN (5)");
}
if (isset($_GET['status2']) && $_GET['status2']=="reverted") {
    $db->where("status IN (-2)");
}
if (isset($_GET['status2']) && $_GET['status2']=="paypend") {
    $db->where("status IN (3,4) and paid=0");
}
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				application_form_oc.id LIKE ? OR 
				application_form_oc.application_no LIKE ? OR 
				application_form_oc.status LIKE ? OR 
				application_form_oc.ward LIKE ? OR 
				application_form_oc.landowner_or_applicant_name LIKE ? OR 
				application_form_oc.licensed_architect_or_engineers_name LIKE ? OR 
				application_form_oc.property_address LIKE ? OR 
				application_form_oc.landmark LIKE ? OR 
				application_form_oc.survey_no LIKE ? OR 
				application_form_oc.house_no LIKE ? OR 
				application_form_oc.village_name LIKE ? OR 
				application_form_oc.taluka_name LIKE ? OR 
				application_form_oc.are_all_connections_disconnected_on_site_from_main_line LIKE ? OR 
				application_form_oc.is_sewage_treatment_plant_proposed_for_the_proposal LIKE ? OR 
				application_form_oc.bldg_no LIKE ? OR 
				application_form_oc.proposed_quantity_of_residences LIKE ? OR 
				application_form_oc.proposed_quantity_of_shops LIKE ? OR 
				application_form_oc.proposed_quantity_of_offices LIKE ? OR 
				application_form_oc.total LIKE ? OR 
				application_form_oc.are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient LIKE ? OR 
				application_form_oc.length_of_ug_tank_proposed LIKE ? OR 
				application_form_oc.width_of_ug_tank_proposed LIKE ? OR 
				application_form_oc.depth_of_ug_tank_proposed LIKE ? OR 
				application_form_oc.size_and_capcity_of_ug_tank_proposed LIKE ? OR 
				application_form_oc.length_of_oh_tank_proposed LIKE ? OR 
				application_form_oc.width_of_oh_tank_proposed LIKE ? OR 
				application_form_oc.height_of_oh_tank_proposed LIKE ? OR 
				application_form_oc.size_and_capcity_of_oh_tank_proposed LIKE ? OR 
				application_form_oc.distance_of_ug_tank_from_supply_line LIKE ? OR 
				application_form_oc.upload_building_plan LIKE ? OR 
				application_form_oc.upload_detailed_location_plan LIKE ? OR 
				application_form_oc.upload_complete_building_layout_plan LIKE ? OR 
				application_form_oc.upload_declaration_certificate LIKE ? OR 
				application_form_oc.upload_table_showing_residential_and_commercial_tenements_shops LIKE ? OR 
				application_form_oc.upload_water_requirement_for_the_entire_project LIKE ? OR 
				application_form_oc.upload_location_plan_showing_existing_open_well LIKE ? OR 
				application_form_oc.upload_locations_and_details_of_under_ground_etc LIKE ? OR 
				application_form_oc.upload_plumbing_system_details LIKE ? OR 
				application_form_oc.timestamp LIKE ? OR 
				application_form_oc.user_id LIKE ? OR 
				application_form_oc.paid LIKE ? OR 
				application_form_oc.certificate LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "application_form_oc/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("application_form_oc.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		if(	!empty($records)){
			foreach($records as &$record){
				$record['timestamp'] = human_datetime($record['timestamp']);
			}
		}
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Application Form Oc";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("application_form_oc/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"division", 
			"ward", 
			"landowner_or_applicant_name", 
			"licensed_architect_or_engineers_name", 
			"property_address", 
			"landmark", 
			"survey_no", 
			"house_no", 
			"cts_no", 
			"village_name", 
			"taluka_name", 
			"details_of_existing_water_connections", 
			"upload_detailed_location_plan", 
			"upload_complete_building_layout_plan", 
			"upload_table_showing_residential_and_commercial_tenements_shops", 
			"upload_water_requirement_for_the_entire_project", 
			"upload_location_plan_showing_existing_open_well", 
			"upload_locations_and_details_of_under_ground_etc", 
			"upload_building_plan", 
			"upload_plumbing_system_details", 
			"bldg_no", 
			"proposed_quantity_of_residences", 
			"proposed_quantity_of_shops", 
			"proposed_quantity_of_offices", 
			"total", 
			"qty_of_water_reqd", 
			"length_of_ug_tank_proposed", 
			"width_of_ug_tank_proposed", 
			"depth_of_ug_tank_proposed", 
			"size_and_capcity_of_ug_tank_proposed", 
			"length_of_oh_tank_proposed", 
			"width_of_oh_tank_proposed", 
			"height_of_oh_tank_proposed", 
			"size_and_capcity_of_oh_tank_proposed", 
			"are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient", 
			"distance_of_ug_tank_from_supply_line", 
			"status", 
			"application_no", 
			"timestamp", 
			"user_id", 
			"paid", 
			"certificate", 
			"are_all_connections_disconnected_on_site_from_main_line", 
			"is_sewage_treatment_plant_proposed_for_the_proposal", 
			"upload_declaration_certificate");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("application_form_oc.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['timestamp'] = human_datetime($record['timestamp']);
			$page_title = $this->view->page_title = "View  Application Form Oc";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("application_form_oc/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("ward","landowner_or_applicant_name","upload_cc_certificate","cc_number","licensed_architect_or_engineers_name","village_name","survey_no","house_no","taluka_name","bldg_no","property_address","landmark","are_all_connections_disconnected_on_site_from_main_line","is_sewage_treatment_plant_proposed_for_the_proposal","proposed_quantity_of_residences","proposed_quantity_of_shops","proposed_quantity_of_offices","total","are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient","length_of_ug_tank_proposed","width_of_ug_tank_proposed","depth_of_ug_tank_proposed","size_and_capcity_of_ug_tank_proposed","length_of_oh_tank_proposed","width_of_oh_tank_proposed","height_of_oh_tank_proposed","size_and_capcity_of_oh_tank_proposed","distance_of_ug_tank_from_supply_line","upload_building_plan","upload_detailed_location_plan","upload_complete_building_layout_plan","upload_declaration_certificate","user_id");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'ward' => 'required',
				'landowner_or_applicant_name' => 'required',
				'licensed_architect_or_engineers_name' => 'required',
				'village_name' => 'required',
				'survey_no' => 'required',
				'house_no' => 'required',
				'taluka_name' => 'required',
				'bldg_no' => 'required',
				'property_address' => 'required',
				'landmark' => 'required',
				'are_all_connections_disconnected_on_site_from_main_line' => 'required',
				'is_sewage_treatment_plant_proposed_for_the_proposal' => 'required',
				'proposed_quantity_of_residences' => 'required|numeric',
				'proposed_quantity_of_shops' => 'required|numeric',
				'proposed_quantity_of_offices' => 'required|numeric',
				'total' => 'required',
				'are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient' => 'required',
				'length_of_ug_tank_proposed' => 'required|numeric',
				'width_of_ug_tank_proposed' => 'required|numeric',
				'depth_of_ug_tank_proposed' => 'required|numeric',
				'size_and_capcity_of_ug_tank_proposed' => 'required',
				'length_of_oh_tank_proposed' => 'required|numeric',
				'width_of_oh_tank_proposed' => 'required|numeric',
				'height_of_oh_tank_proposed' => 'required|numeric',
				'size_and_capcity_of_oh_tank_proposed' => 'required',
				'distance_of_ug_tank_from_supply_line' => 'required',
				'upload_building_plan' => 'required',
				'upload_detailed_location_plan' => 'required',
				'upload_complete_building_layout_plan' => 'required',
				'upload_declaration_certificate' => 'required',
			);
			$this->sanitize_array = array(
				'ward' => 'sanitize_string',
				'landowner_or_applicant_name' => 'sanitize_string',
				'licensed_architect_or_engineers_name' => 'sanitize_string',
				'village_name' => 'sanitize_string',
				'survey_no' => 'sanitize_string',
				'house_no' => 'sanitize_string',
				'taluka_name' => 'sanitize_string',
				'bldg_no' => 'sanitize_string',
				'property_address' => 'sanitize_string',
				'landmark' => 'sanitize_string',
				'are_all_connections_disconnected_on_site_from_main_line' => 'sanitize_string',
				'is_sewage_treatment_plant_proposed_for_the_proposal' => 'sanitize_string',
				'proposed_quantity_of_residences' => 'sanitize_string',
				'proposed_quantity_of_shops' => 'sanitize_string',
				'proposed_quantity_of_offices' => 'sanitize_string',
				'total' => 'sanitize_string',
				'are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient' => 'sanitize_string',
				'length_of_ug_tank_proposed' => 'sanitize_string',
				'width_of_ug_tank_proposed' => 'sanitize_string',
				'depth_of_ug_tank_proposed' => 'sanitize_string',
				'size_and_capcity_of_ug_tank_proposed' => 'sanitize_string',
				'length_of_oh_tank_proposed' => 'sanitize_string',
				'width_of_oh_tank_proposed' => 'sanitize_string',
				'height_of_oh_tank_proposed' => 'sanitize_string',
				'size_and_capcity_of_oh_tank_proposed' => 'sanitize_string',
				'distance_of_ug_tank_from_supply_line' => 'sanitize_string',
				'upload_building_plan' => 'sanitize_string',
				'upload_detailed_location_plan' => 'sanitize_string',
				'upload_complete_building_layout_plan' => 'sanitize_string',
				'upload_declaration_certificate' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['user_id'] = USER_ID;
			if($this->validated()){
		$modeldata['status'] = 1;
		
		
$db->where("user_id",USER_ID);
			$db->where("application_no",$modeldata['cc_number']);
		$ap=$db->getOne("application_form");
		if(isset($ap['id'])){
		    
		$modeldata['upload_cc_certificate']=$ap['certificate'];
		}else{
		    
		$modeldata['upload_cc_certificate']='';
		$modeldata['status'] = 0;
		}
		
		 
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
		# Statement to execute after adding record
		if(isset($ap['id'])){
		$db->where("rec_id",$rec_id);
		$recs=$db->get("water_form_details");
		foreach($recs as $r){
		    $ins=$r;
		    unset($ins['id']);
		    $ins['rec_id']=$rec_id;
		    $db->insert("water_form_details_oc",$ins);
		}
		}
	
  file_get_contents("https://singlewindowsystemkdmc.in/api/progress/water_application_form/".USER_NAME."/pending/".urlencode($_SESSION['appl_type']));
$db->insert("application_mapping",["db_name"=>$tablename,"rec_id"=>$rec_id,"appl_type"=>$_SESSION['appl_type']]);

// afterAdd of debit
$application_id = $rec_id; // now you have the actual debit ID
if (date("m") >= 4) {
    $yr = date("y") . "-" . (date("y") + 1);
} else {
    $yr = (date("y") - 1) . "-" . date("y");
}
$receipt_no = "KDMC/" . $application_id . "/" . $yr;
// Update the row with receipt_no
$db->where("id", $application_id);
$db->update("application_form_oc", ["application_no" => $receipt_no]);
		# End of after add statement
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("application_form_oc");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Application Form Oc";
		$this->render_view("application_form_oc/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","ward","landowner_or_applicant_name","mobile_no","licensed_architect_or_engineers_name","village_name","survey_no","house_no","taluka_name","bldg_no","property_address","landmark","are_all_connections_disconnected_on_site_from_main_line","is_sewage_treatment_plant_proposed_for_the_proposal","proposed_quantity_of_residences","proposed_quantity_of_shops","proposed_quantity_of_offices","total","are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient","length_of_ug_tank_proposed","width_of_ug_tank_proposed","depth_of_ug_tank_proposed","size_and_capcity_of_ug_tank_proposed","length_of_oh_tank_proposed","width_of_oh_tank_proposed","height_of_oh_tank_proposed","size_and_capcity_of_oh_tank_proposed","distance_of_ug_tank_from_supply_line","upload_building_plan","upload_detailed_location_plan","upload_complete_building_layout_plan","upload_declaration_certificate");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'ward' => 'required',
				'landowner_or_applicant_name' => 'required',
				'licensed_architect_or_engineers_name' => 'required',
				'village_name' => 'required',
				'survey_no' => 'required',
				'house_no' => 'required',
				'taluka_name' => 'required',
				'bldg_no' => 'required',
				'property_address' => 'required',
				'landmark' => 'required',
				'are_all_connections_disconnected_on_site_from_main_line' => 'required',
				'is_sewage_treatment_plant_proposed_for_the_proposal' => 'required',
				'proposed_quantity_of_residences' => 'required|numeric',
				'proposed_quantity_of_shops' => 'required|numeric',
				'proposed_quantity_of_offices' => 'required|numeric',
				'total' => 'required',
				'are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient' => 'required',
				'length_of_ug_tank_proposed' => 'required|numeric',
				'width_of_ug_tank_proposed' => 'required|numeric',
				'depth_of_ug_tank_proposed' => 'required|numeric',
				'size_and_capcity_of_ug_tank_proposed' => 'required',
				'length_of_oh_tank_proposed' => 'required|numeric',
				'width_of_oh_tank_proposed' => 'required|numeric',
				'height_of_oh_tank_proposed' => 'required|numeric',
				'size_and_capcity_of_oh_tank_proposed' => 'required',
				'distance_of_ug_tank_from_supply_line' => 'required',
				'upload_building_plan' => 'required',
				'upload_detailed_location_plan' => 'required',
				'upload_complete_building_layout_plan' => 'required',
				'upload_declaration_certificate' => 'required',
			);
			$this->sanitize_array = array(
				'ward' => 'sanitize_string',
				'landowner_or_applicant_name' => 'sanitize_string',
				'licensed_architect_or_engineers_name' => 'sanitize_string',
				'village_name' => 'sanitize_string',
				'survey_no' => 'sanitize_string',
				'house_no' => 'sanitize_string',
				'taluka_name' => 'sanitize_string',
				'bldg_no' => 'sanitize_string',
				'property_address' => 'sanitize_string',
				'landmark' => 'sanitize_string',
				'are_all_connections_disconnected_on_site_from_main_line' => 'sanitize_string',
				'is_sewage_treatment_plant_proposed_for_the_proposal' => 'sanitize_string',
				'proposed_quantity_of_residences' => 'sanitize_string',
				'proposed_quantity_of_shops' => 'sanitize_string',
				'proposed_quantity_of_offices' => 'sanitize_string',
				'total' => 'sanitize_string',
				'are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient' => 'sanitize_string',
				'length_of_ug_tank_proposed' => 'sanitize_string',
				'width_of_ug_tank_proposed' => 'sanitize_string',
				'depth_of_ug_tank_proposed' => 'sanitize_string',
				'size_and_capcity_of_ug_tank_proposed' => 'sanitize_string',
				'length_of_oh_tank_proposed' => 'sanitize_string',
				'width_of_oh_tank_proposed' => 'sanitize_string',
				'height_of_oh_tank_proposed' => 'sanitize_string',
				'size_and_capcity_of_oh_tank_proposed' => 'sanitize_string',
				'distance_of_ug_tank_from_supply_line' => 'sanitize_string',
				'upload_building_plan' => 'sanitize_string',
				'upload_detailed_location_plan' => 'sanitize_string',
				'upload_complete_building_layout_plan' => 'sanitize_string',
				'upload_declaration_certificate' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		# Statement to execute after adding record
		$modeldata['status'] = 0;
		# End of before update statement
				$db->where("application_form_oc.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form_oc");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("application_form_oc");
					}
				}
			}
		}
		$db->where("application_form_oc.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form Oc";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form_oc/edit.php", $data);
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("application_form_oc.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("application_form_oc");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit2($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","status");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'status' => 'required',
			);
			$this->sanitize_array = array(
				'status' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("application_form_oc.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form_oc");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("application_form_oc");
					}
				}
			}
		}
		$db->where("application_form_oc.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form Oc";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form_oc/edit2.php", $data);
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit_approval($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","certificate");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'certificate' => 'required',
			);
			$this->sanitize_array = array(
				'certificate' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		# Statement to execute after adding record
		$modeldata['status'] = 5;
		  $db->where("id",$rec_id);
        $ui=$db->getOne("$tablename","*");
        $db->where("id",$ui['user_id']);
        $ui=$db->getOne("user_info","*"); 
        
                            $names['Commencement Certificate']='CC';
                    $names['Revised Commencement Certificate']='RCC';
                    $names['Part Occupancy Certificate']='POC';
                    $names['Occupancy Certificate']='OC';
$db->where("rec_id",$rec_id);
$db->where("db_name",$tablename);
$typeapi=$db->getOne("application_mapping","*")['appl_type'];
$passtype=$names[$typeapi];

file_get_contents("https://singlewindowsystemkdmc.in/api/progress/water_application_form/".$ui['username']."/COMPLETE/".urlencode($typeapi)); 



function sendNocToKDMC($appl_no, $noc_type, $pdf_file_path,$T) {
    //  $url = "http://180.149.247.55/API/KDMC/get_noc_certificate.php";
     $url = "https://mahavastu.maharashtra.gov.in/API/KDMC/get_noc_certificate.php";

    // Check if file exists
 

 
file_put_contents("/home1/singlewindowsyst/public_html/uploads/nocs/$noc_type"."_".$appl_no.".pdf",file_get_contents($pdf_file_path));
    // Read and encode file to base64
     $base64_file = base64_encode(file_get_contents($pdf_file_path));

    // Prepare POST data
    $postData = [
        'appl_no'  => $appl_no,
        'noc_type' => $noc_type,
        'type_appl' => $T,
        'noc_file' => $base64_file,
        'noc_req' => "AP",
    ]; 
    // Initialize CURL
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set Basic Auth headers
    curl_setopt($ch, CURLOPT_USERPWD, "bpms:cXmnZK65rf*&DaaD");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    // Enable form-data POST
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute request
     $response = curl_exec($ch);

    if (curl_errno($ch)) {
       echo $error_msg = curl_error($ch);
        curl_close($ch);
        return ['status' => 'error', 'message' => $error_msg];
    }

// print_r($postData);
// echo "<hr>";
// echo ($response);
//     curl_close($ch);
// exit();
    
    $x=file_get_contents("/home1/singlewindowsyst/public_html/logs/".$appl_no.".txt");
    $x.="
TYPE = $noc_type
    
$response";
file_put_contents("/home1/singlewindowsyst/public_html/logs/".$appl_no.".txt",$x);
    // Decode JSON response
    return json_decode($response, true);
} 



    $NAME="WATECNOC"; 
    if($passtype!=""){
        
sendNocToKDMC($ui['username'],$NAME,$modeldata['certificate'],$passtype);
    }


		# End of before update statement
				$db->where("application_form_oc.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("application_form_oc");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("application_form_oc");
					}
				}
			}
		}
		$db->where("application_form_oc.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Application Form Oc";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("application_form_oc/edit_approval.php", $data);
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function generate_noc($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"division", 
			"ward", 
			"landowner_or_applicant_name", 
			"licensed_architect_or_engineers_name", 
			"property_address", 
			"landmark", 
			"cc_number", 
			"survey_no", 
			"house_no", 
			"cts_no", 
			"village_name", 
			"taluka_name", 
			"details_of_existing_water_connections", 
			"upload_detailed_location_plan", 
			"upload_complete_building_layout_plan", 
			"upload_table_showing_residential_and_commercial_tenements_shops", 
			"upload_water_requirement_for_the_entire_project", 
			"upload_location_plan_showing_existing_open_well", 
			"upload_locations_and_details_of_under_ground_etc", 
			"upload_building_plan", 
			"upload_plumbing_system_details", 
			"bldg_no", 
			"proposed_quantity_of_residences", 
			"proposed_quantity_of_shops", 
			"proposed_quantity_of_offices", 
			"total", 
			"qty_of_water_reqd", 
			"length_of_ug_tank_proposed", 
			"width_of_ug_tank_proposed", 
			"depth_of_ug_tank_proposed", 
			"size_and_capcity_of_ug_tank_proposed", 
			"length_of_oh_tank_proposed", 
			"width_of_oh_tank_proposed", 
			"height_of_oh_tank_proposed", 
			"size_and_capcity_of_oh_tank_proposed", 
			"are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient", 
			"distance_of_ug_tank_from_supply_line", 
			"status", 
			"application_no", 
			"timestamp", 
			"user_id", 
			"paid", 
			"certificate", 
			"are_all_connections_disconnected_on_site_from_main_line", 
			"is_sewage_treatment_plant_proposed_for_the_proposal", 
			"upload_declaration_certificate");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("application_form_oc.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Application Form Oc";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("application_form_oc/generate_noc.php", $record);
	}
}
