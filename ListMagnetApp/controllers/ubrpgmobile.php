<?php
parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

class ubrpgmobile extends CI_Controller {
  var $facebook_user_id=FALSE;
  var $twitter_user_id=FALSE;
  var $google_user_id=FALSE;
  var $member_id=FALSE;
  var $user = FALSE;
  var $data = NULL;
	function __construct()
	{
		parent::__construct();
		$this->config->load('JavaScriptPaths');
  		$this->config->load('APIKeys');
		$this->config->load('tweet');
		$this->user = $this->session->userdata('app_session');
		$this->is_local = FALSE;
		$this->data=array(
		   'member_id'=>NULL,
			'tag'=>NULL,
           'user_name'    => FALSE,
            'user_id' => FALSE,
            'page_title' => 'Sign In',
            'auth_type' => FALSE,
            'current_page' => '/ubrpgmoblie',
            'logged_in' => FALSE,
            'facebook_api_key'=>$this->config->item('facebook_api_key'),
            'gfc_site_id'=>$this->config->item('gfc_site_id'),
            'tweet_consumer_key'=>$this->config->item('tweet_consumer_key')
          );
		  if(base_url() === 'http://myfb.ci/'){
		  	$this->data = array_merge($this->data,array(
		            'user_name'    =>    'Localhost',
		            'user_id' =>    '77777777777',
		            'pic' => 		'',
		            'auth_type' =>  'localhost',
		            'logged_in' =>  FALSE,
		            'memeber_id'=>  NULL,
		            'tag'=>NULL
		          ));
		  }
		  
		  if($this->user !== FALSE && $this->user['logged_in']){
		  	
					$this->data = array_merge($this->data,array(
		            'user_name'    =>    $this->user['user_name'],
		            'user_id' =>    $this->user['user_id'],
		            'pic' => 		$this->user['pic_url'],
		            'auth_type' =>  $this->user['auth_type'],
		            'logged_in' =>  $this->user['logged_in'],
		            'member_id'=>  $this->user['member_id'],
		            'tag'=>  $this->user['member_tag']
		          ));
	  		}
		
		
  }

  function index()
  {
  		//var_dump($this->user);
  		$this->load->view('ubrpgmobile_home',$this->data);
	  
	  }
  
	function signout(){
	      $auth_type= $this->user['auth_type'];
	     
		   switch ($auth_type)
		   {
			case 'Google':
			 	$this->load->view('signout',$this->data);
				 $this->session->sess_destroy();
				break;
			case 'Twitter':
				$this->tweet->set_callback('/ubrpgmobile');
		   		$this->tweet->logout();
				 $this->session->sess_destroy();
				header("Location: /ubrpgmobile");
				break;
			default:
				 $this->session->sess_destroy();
				header("Location: /ubrpgmobile");
				break;
			} 
	}
	
	
	function signin(){
		$this->tweet->set_callback('http://listmagnet.webversatile.com/ubrpgmobile');
		$this->tweet->login();
			//header("Location: /ubrpgmobile");
			
	}
    private function _get_appication_user(){
    	
    }
	private function _create_appication_user(){
    	
    }
}
