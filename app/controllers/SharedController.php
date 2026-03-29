<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * application_form_ward_option_list Model Action
     * @return array
     */
	function application_form_ward_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ward_name AS value,ward_name AS label FROM master_ward ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * application_form_ward_option_list_2 Model Action
     * @return array
     */
	function application_form_ward_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ward_name AS value,ward_name AS label FROM master_ward ORDER BY id ASC" ;
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_info_ward_option_list Model Action
     * @return array
     */
	function user_info_ward_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ward_name AS value,ward_name AS label FROM master_ward ORDER BY ward_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_info_username_value_exist Model Action
     * @return array
     */
	function user_info_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("user_info");
		return $exist;
	}

	/**
     * user_info_email_value_exist Model Action
     * @return array
     */
	function user_info_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user_info");
		return $exist;
	}

	/**
     * user_info_user_role_id_option_list Model Action
     * @return array
     */
	function user_info_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * application_form_oc_ward_option_list Model Action
     * @return array
     */
	function application_form_oc_ward_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ward_name AS value,ward_name AS label FROM master_ward ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * application_form_oc_ward_option_list_2 Model Action
     * @return array
     */
	function application_form_oc_ward_option_list_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT ward_name AS value,ward_name AS label FROM master_ward ORDER BY id ASC" ;
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_totalapplications Model Action
     * @return Value
     */
	function getcount_totalapplications(){
		$db = $this->GetModel();
		$sqltext = "SELECT (SELECT COUNT(*) FROM application_form) + (SELECT COUNT(*) FROM application_form_oc) AS total_count;";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_completedapplications Model Action
     * @return Value
     */
	function getcount_completedapplications(){
		$db = $this->GetModel();
		$sqltext = "SELECT (SELECT COUNT(*) FROM application_form WHERE status='5' AND certificate != '') + (SELECT COUNT(*) FROM application_form_oc WHERE status='5' AND certificate != '') AS total_count_status5_with_certificate;";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pendingapplications Model Action
     * @return Value
     */
	function getcount_pendingapplications(){
		$db = $this->GetModel();
		$sqltext = "SELECT (SELECT COUNT(*) FROM application_form WHERE status='0') + (SELECT COUNT(*) FROM application_form_oc WHERE status='0') AS total_count_status0;
";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_rejectedapplications Model Action
     * @return Value
     */
	function getcount_rejectedapplications(){
		$db = $this->GetModel();
		$sqltext = "SELECT (SELECT COUNT(*) FROM application_form WHERE status='-1') + (SELECT COUNT(*) FROM application_form_oc WHERE status='-1') AS total_count_status_minus1;
";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totalapplicationsreceived Model Action
     * @return Value
     */
	function getcount_totalapplicationsreceived(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM application_form ".((USER_ROLE>=3 && USER_ROLE<=5)?" WHERE ward in ('".implode("','",explode(",",get_active_user("ward")))."')":"");
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pendingapplications_2 Model Action
     * @return Value
     */
	function getcount_pendingapplications_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM application_form WHERE status='-1' ".((USER_ROLE>=3 && USER_ROLE<=5)?"and ward in ('".implode("','",explode(",",get_active_user("ward")))."')":"");
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totalapplicationsreceived_2 Model Action
     * @return Value
     */
	function getcount_totalapplicationsreceived_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM application_form ".((USER_ROLE>=3 && USER_ROLE<=5)?"WHERE ward in ('".implode("','",explode(",",get_active_user("ward")))."')":"");
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pendingapplications_2_2 Model Action
     * @return Value
     */
	function getcount_pendingapplications_2_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM application_form WHERE status='2'".((USER_ROLE>=3 && USER_ROLE<=5)?" and ward in ('".implode("','",explode(",",get_active_user("ward")))."')":"");
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_pendingapplications_2_2_2 Model Action
     * @return Value
     */
	function getcount_pendingapplications_2_2_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM application_form WHERE status='3' ".((USER_ROLE>=3 && USER_ROLE<=5)?"and ward in ('".implode("','",explode(",",get_active_user("ward")))."')":"");
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
