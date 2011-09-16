<?php

class Mylists extends CI_Controller {

	function __construct()
	{
		parent::__construct();	
	}
	
	function index()
	{
		$data['title']='ListMagnet: My Lists';
		$data['homelink']='';
		$data['mylistslink']='current';
		$data['gallery']='';
		$this->load->view('include/header_main',$data);
		$this->load->view('include/main_nav',$data);
		$this->load->view('mylists');
		$this->load->view('include/footer_main');
		var_dump($data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */