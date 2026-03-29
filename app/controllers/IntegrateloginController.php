<?php 
/**
 * Index Page Controller
 * @category  Controller
 */
class IntegrateloginController extends BaseController{
	function __construct(){
		parent::__construct(); 
		$this->tablename = "user_info";
	}
	/**
     * Index Action 
     * @return null
     */
	function index(){  
	    error_reporting(0);
			$db = $this->GetModel();
        



	    echo "KDMC NP Portal Redirecting ....";
	    if(!isset($_GET['Appid'])){
	       // new service add form 
	       
             $array['Response']='Success';
             $array['MobileNo']=$_GET['mob'];
             $array['Link']=$_GET['link'];
            
            $dat=json_decode(file_get_contents("https://singlewindowsystemkdmc.in/api/uninfo/".$_GET['mob']),true);
 
             $tablename="user_info";
            if($array['Response']=='Success'){
                $mb=$array['MobileNo'];
                // password_hash($password_text , PASSWORD_DEFAULT);
                $db->where("username",$mb);
                $user=$db->getOne("user_info","*");
                if(isset($user['id'])){
                    //login
                    
                    unset($user['password']); //Remove user password. No need to store it in the session
				    set_session("user_data", $user); // Set active user data in a sessions
				    //if Remeber Me, Set Cookie 
					$sessionkey = time().random_str(20); // Generate a session key for the user
					//Update user session info in database with the session key
					$db->where("id", $user['id']);
					$res = $db->update($tablename, array("login_session_key" => hash_value($sessionkey)));
					if(!empty($res)){
						set_cookie("login_session_key", $sessionkey); // save user login_session_key in a Cookie
					} 
                    
                }else{
                    
                    $user=[];
                    $user['username']=$mb; 
                    $user['user_role_id']='2';
                    // $user['mobile']=$dat['mobile'];
                    $user['password']=$dat['password'];
                    $user['email']=$dat['email']; 
                    $reciid=$db->insert("user_info",$user);
                    
                    
                    $db->where("id",$reciid);
                    $user=$db->getOne("user_info","*");
                     unset($user['password']); //Remove user password. No need to store it in the session
				    set_session("user_data", $user); // Set active user data in a sessions
				    //if Remeber Me, Set Cookie 
					$sessionkey = time().random_str(20); // Generate a session key for the user
					//Update user session info in database with the session key
					$db->where("id", $user['id']);
					$res = $db->update($tablename, array("login_session_key" => hash_value($sessionkey)));
					if(!empty($res)){
						set_cookie("login_session_key", $sessionkey); // save user login_session_key in a Cookie
					} 
					
					
                }
                 
                echo '<script>location.href="'.SITE_ADDR.$array['Link'].'";</script>'; 
                
            }
            
            } 

	   
	    
	} 
}
