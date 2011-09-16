<?php
class Manage_session {
		
		public $auth_type = NULL;
		public $user_name = NULL;
		public $user_id = NULL;
		public $logged_in =FALSE;
		public $member_tag = NULL;
		public $member_id = NULL;
		public $fbc = NULL;
		public $tweet = NULL;
		public $gfc = NULL;
		function __construct()
		{
			$this->obj =& get_instance();
			$this->obj->load->library('session');
			
			$this->obj->load->model('Member_auth');
			$this->obj->load->library('facebook_connect');
			$this->obj->load->library('gfc_connect');
			$this->obj->load->library('tweet');
			$this->manage_app_session();
			
		}
		
		
		private function manage_app_session(){
			$member['member_id']=FALSE;
			$sess = $this->obj->session->userdata('app_session');
			if($sess){
				$member =  array_merge($member,$sess);
			}
			
			$sn_info = array('logged_in'=>FALSE,
							 'member_id'=>NULL,
							 'member_tag'=>NULL);
			if(!$member['member_id']){
				
				if(! is_null($this->obj->facebook_connect->user_id)){
					
					$fb_info= $this->obj->facebook_connect->user_info;
					$sn_info['user_name']= $fb_info['name'];
					$sn_info['user_id']=$this->obj->facebook_connect->user_id;
					$sn_info['pic_url']=$fb_info['pic_square'];
		            $sn_info['auth_type']='Facebook';
		           	$sn_info['logged_in']= TRUE;
				    $mem = $this->obj->Member_auth->getFacebookMember($this->obj->facebook_connect->user_id);
				  if($mem > 0){
						$sn_info['member_id']= $mem[0]->member_id;
						$sn_info['member_tag']= $mem[0]->member_name;
					}
				} elseif($this->obj->gfc_connect->user_id){
					$gfc_info= $this->obj->gfc_connect->userObj;
					$sn_info['user_name']= $gfc_info->displayName;
					$sn_info['user_id']=$this->obj->gfc_connect->user_id;
					$sn_info['pic_url']=$gfc_info->thumbnailUrl;
		            $sn_info['auth_type']='Google';
					$sn_info['logged_in']= TRUE;
		           
				   $mem = $this->obj->Member_auth->getGoogleMember($this->obj->gfc_connect->user_id);
				  if($mem > 0){
						$sn_info['member_id']= $mem[0]->member_id;
						$sn_info['member_tag']= $mem[0]->member_name;
					}
				
				
				} elseif($this->obj->tweet->user_id){
					$tweet_info= $this->obj->tweet->userObj;
					$sn_info['user_name']= $tweet_info->screen_name;
					$sn_info['user_id']=$tweet_info->status->id_str;
					$sn_info['pic_url']=$tweet_info->profile_image_url;
		            $sn_info['auth_type']='Twitter';
		            $sn_info['logged_in']= TRUE;
				   $mem = $this->obj->Member_auth->getTwitterMember($tweet_info->status->id_str);
				  if($mem > 0){
						$sn_info['member_id']= $mem[0]->member_id;
						$sn_info['member_tag']= $mem[0]->member_name;
				  }
				}
				
				if (count($sn_info) > 0){
					$this->obj->session->set_userdata('app_session', $sn_info);
					//var_dump($sn_info);
				}			
			}
			
	}
}