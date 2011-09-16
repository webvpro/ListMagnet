<?php
parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

class combatpoints extends CI_Controller {
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
		 if($this->user !== FALSE && $this->user['logged_in']){
		  	
					$this->data = array(
		            'user_name'    =>    $this->user['user_name'],
		            'user_id' =>    $this->user['user_id'],
		            'pic' => 		$this->user['pic_url'],
		            'auth_type' =>  $this->user['auth_type'],
		            'logged_in' =>  $this->user['logged_in'],
		            'member_id'=>  $this->user['member_id'],
		            'tag'=>  $this->user['member_tag']
		          );
	  		}
		$this->data['facebook_api_key']=$this->config->item('facebook_api_key');
        $this->data['gfc_site_id']= $this->config->item('gfc_site_id');
        $this->data['tweet_consumer_key']=$this->config->item('tweet_consumer_key');
		
  }

  function index()
  {
  		if(is_null($this->user) || is_null($this->user['member_id'])){
  			header("Location: /ubrpgmobile");
  		}
  		//var_dump($this->user);
  		$this->load->view('combatpoints',$this->data);
	  
	  }
  
	
}
