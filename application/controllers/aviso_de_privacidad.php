<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Aviso_de_privacidad extends CI_Controller{
    
	    function __construct(){
	        parent::__construct();	
			$this->load->model('general');	        		
			$this->load->helper(array('html', 'url', 'form'));	
	   	}

	   	function index(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
	   		$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();	   		
		   	$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);
			if($this->session->userdata('user_login')){
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['user_login'];
		   		$navbar['user'] = $data['user'];
		   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);
			}

 			if($this->session->userdata('logged_in')){
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];

		   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
			}		
	   		$this->load->view("aviso", $data);
	   	}
	   	
	} //fin de la clase
?>