<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Navbar {
   //funciones que queremos implementar en Miclase.
    public function load_navbar(){

   	    $CI =& get_instance();
    	$CI->load->model('general');  //<-------Load the Model first
    	$CI->load->library('session');  //<-------Load the Model first

		$navbar['alltradeagreements'] = $CI->general->allTradeAgreements();
	   	$navbar['allimmovablestype'] = $CI->general->allImmovablesTypes();
	   	$navbar['allcontracts'] = $CI->general->allContracts();
	   	$navbar['allstates'] = $CI->general->allStates();

		if($CI->session->userdata('user_login')){
	   		$data['user'] = $CI->session->all_userdata();
	   		$data['user'] = $data['user']['user_login'];
	   		$data['favorites'] = $CI->general->user_favorites($data['user']['id']);
	   		$navbar['user'] = $data['user'];
	   		$data['navbar'] = $CI->load->view('layaouts/navbar',$navbar, TRUE);
			$CI->load->view("cuenta",$data);
		}else{
	   		$data['navbar'] = $CI->load->view('layaouts/navbar',$navbar, TRUE);
			$CI->load->view("login", $data);
		}

   }
}

?> 