<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Inmuebles extends CI_Controller{
    
	    function __construct(){
	        parent::__construct();			
			$this->load->helper(array('html', 'url', 'form'));	
			$this->load->model(array('general'));			
	   	}

	 	function _remap($method){
	      $param_offset = 2;

	      // Default to index
	      if ( ! method_exists($this, $method))
	      {
	        // We need one more param
	        $param_offset = 1;
	        $method = 'index';
	      }

	      // Since all we get is $method, load up everything else in the URI
	      $params = array_slice($this->uri->rsegment_array(), $param_offset);

	      // Call the determined method with all params
	      call_user_func_array(array($this, $method), $params);
	    }

	   	function index($trade_agreement, $immovable_type){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();	
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

			$data['immovable_type'] = $immovable_type;
	   		$data['trade_agreement'] = $trade_agreement;
			switch ($trade_agreement) {
	   			case 'venta':
					$trade_agreement=1;	   				
	   				break;
	   			case 'renta':
					$trade_agreement=2;
	   				break;
	   			case 'preventa':
					$trade_agreement=3;
	   				break;  
				default:
					$trade_agreement = -1;				 				
	   		}

	   		switch ($immovable_type) {
	   			case 'bodegas':
					$immovable_type=1;	   				
	   				break;
	   			case 'casas':
					$immovable_type=2;
	   				break;
	   			case 'departamentos':
					$immovable_type=3;
	   				break;
				case 'desarrollos':
					$immovable_type=4;	   				
	   				break;
				case 'locales_comerciales':
					$immovable_type=5;
					break;
				case 'oficinas':
					$immovable_type=6;
	   				break;	  
				case 'terrenos':
					$immovable_type=7;
	   				break;	  	  
				default:
					$immovable_type = -1;				 					   				 				 				
	   		}

	   		// echo "immovable type = ". $immovable_type;
	   		// echo "trade_agreement = ". $trade_agreement;
	   		$data['trade_agreement_id'] = $trade_agreement;
	   		$data['immovable_type_id'] = $immovable_type;
	   		$data['immovables'] = $this->general->bringme_immovables($trade_agreement, $immovable_type);
	   		$data['suburbs'] = $this->general->suburbs_immovable($trade_agreement, $immovable_type);

			if($data['immovables'] == -1){
				$this->load->view("no_immovable", $data);
			}else{
	   			$this->load->view("inmuebles", $data);
			}   		
	   	}
	} //fin de la clase
?>