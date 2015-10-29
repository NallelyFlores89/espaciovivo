<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Registro extends CI_Controller{
    
	    function __construct(){
	        parent::__construct();			
			$this->load->helper(array('html', 'url', 'form'));	
			$this->load->model(array('general','user'));
			$this->load->library('form_validation');
	   		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');						
	   	}

	   	function index(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();
		   	$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);
			$this->load->view("register.php",$data);
	   	}

	   	function doRegister(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();
		   	$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);	   		
	   		if(isset($_POST)){

				$this->form_validation->set_rules('name', 'Nombre', 'trim|required|xss_clean');   
				$this->form_validation->set_rules('last_name', 'Apellidos', 'trim|required|xss_clean');   
				$this->form_validation->set_rules('phone', 'Teléfono', 'trim|required|xss_clean');   
				$this->form_validation->set_rules('cellphone', 'Celular', 'trim|required|xss_clean');   
		   		$this->form_validation->set_rules('states_id', 'Estado', 'callback_select_option');   
				$this->form_validation->set_rules('email', 'E-mail', 'trim|required|xss_clean|email|is_unique[users.email]');   
				$this->form_validation->set_rules('email-confirm', 'Confirmar E-mail', 'trim|required|xss_clean|email|matches[email]');   
		   		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean');	   			   			
		   		$this->form_validation->set_rules('password-confirm', 'Confirma contraseña', 'trim|required|xss_clean|matches[password]');
		   		$this->form_validation->set_rules('terms', 'Terminos y condiciones', 'trim|callback_select_terms');
		   		$this->form_validation->set_rules('personal_data', 'Acepto el tratamiento', 'trim|callback_select_personal');
		   		$this->form_validation->set_rules('notifications', 'Acepto el tratamiento', 'trim');


		   		$this->form_validation->set_message('required','Campo obligatorio');
		   		$this->form_validation->set_message('matches','%s no coincide con %s');
		   		$this->form_validation->set_message('is_unique','Este correo ya está registrado en la base de datos');

			   if($this->form_validation->run() == FALSE ){
		   			$this->load->view("register", $data);
			   }else{
			   		unset($_POST['terms']);
			   		unset($_POST['personal_data']);
			   		unset($_POST['email-confirm']);
			   		unset($_POST['password-confirm']);

			   		$this->user->register_user($_POST);
			   		if($this->check_database($_POST['password'], $_POST['email'])){
			   			redirect('cuenta');
			   		}else{
			   			echo "hubo un problema";
			   		}
			   }		   			  

	   		}else{
				$this->load->view("register",$data);
	   		}
	   	}


	   	function select_personal($val){
	   		if($val == -1){
	   			$this->form_validation->set_message('select_personal', 'Por favor, acepta El Tratamiento de Datos Personales');
	   			return FALSE;
	   		}else{
	   			return TRUE;
	   		}
	   	}	   	

	   	function select_terms($val){
	   		if($val == -1){
	   			$this->form_validation->set_message('select_terms', 'Por favor, acepta nuestros Términos y Condiciones');
	   			return FALSE;
	   		}else{
	   			return TRUE;
	   		}
	   	}
	   	function select_option($val){
	   		if($val == -1){
	   			$this->form_validation->set_message('select_option', 'Selecciona una opción');
	   			return FALSE;
	   		}else{
	   			return TRUE;
	   		}
	   	}

		function check_database($password,$email){
		   $email = $this->input->post('email');
		   $result = $this->user->user_login_validate($email, $password);

		   	if($result){
		       $this->session->set_userdata('user_login', $result[0]);
		     	return TRUE;
		    }else{
			    $this->form_validation->set_message('check_database', 'Email o contraseñas incorrectos');
			    return false;
		   }

		   return false;	   
		}


	   	
	} //fin de la clase
?>