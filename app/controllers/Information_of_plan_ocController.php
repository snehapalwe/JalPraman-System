<?php 
/**
 * Information_of_plan_oc Page Controller
 * @category  Controller
 */
class Information_of_plan_ocController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "information_of_plan_oc";
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
			"rec_id", 
			"application_no", 
			"is_property_distrubution_network_available", 
			"available_esr_name", 
			"available_details_of_main_supply_line", 
			"available_diameter", 
			"available_pressure", 
			"distance_of_property_from_main_supply_line", 
			"proposed_esr_name", 
			"proposed_details_of_main_supply_line", 
			"required_distribution_line", 
			"proposed_diameter", 
			"proposed_length", 
			"approximate_cost_of_required_w_s_network_line", 
			"additional_sump_and_pump_house_of_society", 
			"extending_or_laying_new_pipe_lines_of");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
	#Statement to execute before list record
	$db->where("rec_id",$_GET['rec_id']);
	# End of before list statement
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				information_of_plan_oc.id LIKE ? OR 
				information_of_plan_oc.rec_id LIKE ? OR 
				information_of_plan_oc.application_no LIKE ? OR 
				information_of_plan_oc.is_property_distrubution_network_available LIKE ? OR 
				information_of_plan_oc.available_esr_name LIKE ? OR 
				information_of_plan_oc.available_details_of_main_supply_line LIKE ? OR 
				information_of_plan_oc.available_diameter LIKE ? OR 
				information_of_plan_oc.available_pressure LIKE ? OR 
				information_of_plan_oc.distance_of_property_from_main_supply_line LIKE ? OR 
				information_of_plan_oc.proposed_esr_name LIKE ? OR 
				information_of_plan_oc.proposed_details_of_main_supply_line LIKE ? OR 
				information_of_plan_oc.required_distribution_line LIKE ? OR 
				information_of_plan_oc.proposed_diameter LIKE ? OR 
				information_of_plan_oc.proposed_length LIKE ? OR 
				information_of_plan_oc.approximate_cost_of_required_w_s_network_line LIKE ? OR 
				information_of_plan_oc.additional_sump_and_pump_house_of_society LIKE ? OR 
				information_of_plan_oc.extending_or_laying_new_pipe_lines_of LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "information_of_plan_oc/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("information_of_plan_oc.id", ORDER_TYPE);
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
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Information Of Plan Oc";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("information_of_plan_oc/list.php", $data); //render the full page
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
			"rec_id", 
			"application_no", 
			"available_esr_name", 
			"available_details_of_main_supply_line", 
			"available_diameter", 
			"available_pressure", 
			"distance_of_property_from_main_supply_line", 
			"is_property_distrubution_network_available", 
			"proposed_esr_name", 
			"proposed_details_of_main_supply_line", 
			"proposed_diameter", 
			"proposed_length", 
			"length", 
			"required_distribution_line", 
			"approximate_cost_of_required_w_s_network_line", 
			"rs", 
			"additional_sump_and_pump_house_of_society", 
			"extending_or_laying_new_pipe_lines_of");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("information_of_plan_oc.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Information Of Plan Oc";
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
		return $this->render_view("information_of_plan_oc/view.php", $record);
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
			$fields = $this->fields = array("rec_id","application_no","is_property_distrubution_network_available","available_esr_name","available_details_of_main_supply_line","available_diameter","available_pressure","distance_of_property_from_main_supply_line","proposed_esr_name","proposed_details_of_main_supply_line","required_distribution_line","proposed_diameter","proposed_length","approximate_cost_of_required_w_s_network_line","additional_sump_and_pump_house_of_society","extending_or_laying_new_pipe_lines_of");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'application_no' => 'required',
				'is_property_distrubution_network_available' => 'required',
				'available_esr_name' => 'required',
				'available_details_of_main_supply_line' => 'required',
				'available_diameter' => 'required|numeric',
				'available_pressure' => 'required|numeric',
				'distance_of_property_from_main_supply_line' => 'required|numeric',
				'proposed_esr_name' => 'required',
				'proposed_details_of_main_supply_line' => 'required',
				'required_distribution_line' => 'required',
				'proposed_diameter' => 'required|numeric',
				'proposed_length' => 'required|numeric',
				'approximate_cost_of_required_w_s_network_line' => 'required',
				'additional_sump_and_pump_house_of_society' => 'required',
				'extending_or_laying_new_pipe_lines_of' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'application_no' => 'sanitize_string',
				'is_property_distrubution_network_available' => 'sanitize_string',
				'available_esr_name' => 'sanitize_string',
				'available_details_of_main_supply_line' => 'sanitize_string',
				'available_diameter' => 'sanitize_string',
				'available_pressure' => 'sanitize_string',
				'distance_of_property_from_main_supply_line' => 'sanitize_string',
				'proposed_esr_name' => 'sanitize_string',
				'proposed_details_of_main_supply_line' => 'sanitize_string',
				'required_distribution_line' => 'sanitize_string',
				'proposed_diameter' => 'sanitize_string',
				'proposed_length' => 'sanitize_string',
				'approximate_cost_of_required_w_s_network_line' => 'sanitize_string',
				'additional_sump_and_pump_house_of_society' => 'sanitize_string',
				'extending_or_laying_new_pipe_lines_of' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		# Statement to execute before adding record
		$db->where("id",$modeldata['rec_id']);
$db->update("application_form_oc",["status"=>2]);
		# End of before add statement
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("application_form_oc");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Information Of Plan Oc";
		$this->render_view("information_of_plan_oc/add.php");
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
		$fields = $this->fields = array("id","rec_id","application_no","is_property_distrubution_network_available","available_esr_name","available_details_of_main_supply_line","available_diameter","available_pressure","distance_of_property_from_main_supply_line","proposed_esr_name","proposed_details_of_main_supply_line","required_distribution_line","proposed_diameter","proposed_length","approximate_cost_of_required_w_s_network_line","additional_sump_and_pump_house_of_society","extending_or_laying_new_pipe_lines_of");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'rec_id' => 'required',
				'application_no' => 'required',
				'is_property_distrubution_network_available' => 'required',
				'available_esr_name' => 'required',
				'available_details_of_main_supply_line' => 'required',
				'available_diameter' => 'required|numeric',
				'available_pressure' => 'required|numeric',
				'distance_of_property_from_main_supply_line' => 'required|numeric',
				'proposed_esr_name' => 'required',
				'proposed_details_of_main_supply_line' => 'required',
				'required_distribution_line' => 'required',
				'proposed_diameter' => 'required|numeric',
				'proposed_length' => 'required|numeric',
				'approximate_cost_of_required_w_s_network_line' => 'required',
				'additional_sump_and_pump_house_of_society' => 'required',
				'extending_or_laying_new_pipe_lines_of' => 'required',
			);
			$this->sanitize_array = array(
				'rec_id' => 'sanitize_string',
				'application_no' => 'sanitize_string',
				'is_property_distrubution_network_available' => 'sanitize_string',
				'available_esr_name' => 'sanitize_string',
				'available_details_of_main_supply_line' => 'sanitize_string',
				'available_diameter' => 'sanitize_string',
				'available_pressure' => 'sanitize_string',
				'distance_of_property_from_main_supply_line' => 'sanitize_string',
				'proposed_esr_name' => 'sanitize_string',
				'proposed_details_of_main_supply_line' => 'sanitize_string',
				'required_distribution_line' => 'sanitize_string',
				'proposed_diameter' => 'sanitize_string',
				'proposed_length' => 'sanitize_string',
				'approximate_cost_of_required_w_s_network_line' => 'sanitize_string',
				'additional_sump_and_pump_house_of_society' => 'sanitize_string',
				'extending_or_laying_new_pipe_lines_of' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("information_of_plan_oc.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("information_of_plan_oc");
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
						return	$this->redirect("information_of_plan_oc");
					}
				}
			}
		}
		$db->where("information_of_plan_oc.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Information Of Plan Oc";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("information_of_plan_oc/edit.php", $data);
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
		$db->where("information_of_plan_oc.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("information_of_plan_oc");
	}
}
