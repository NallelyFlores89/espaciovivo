<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Cuenta extends CI_Controller{
    
	    function __construct(){
	        parent::__construct();			
			$this->load->helper(array('html', 'url', 'form'));	
			$this->load->model(array('general','user'));
			$this->load->library(array('form_validation'));
			// $this->load->library(array('navbar'));
	   		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');						
	   	}

	   	function index(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();
	   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);

   			if($this->session->userdata('user_login')){
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $this->user->bringme_user($data['user']['user_login']['id']);
		   		$data['user'] = $data['user'][0];
		   		$navbar['user'] = $data['user'];
		   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);

		   		$data['favorites'] = $this->general->user_favorites($data['user']['id']);
		   		if($data['user']['notifications']==1){
		   			$data['notifications'] = $this->user->bringme_notifications(); 
		   		}
				$this->load->view("cuenta",$data);
			}else{
				$this->load->view("login", $data);
			}
	   	}

	   	function logout(){
			if (!isset($_SESSION)){
			    session_start();
			}	   		
		   	$this->session->unset_userdata('user_login');
		   	session_destroy();
		   	redirect('welcome', 'refresh');
		}	

		function recuperar_contrasena(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
	   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);

	   		$this->load->view("password_remider",$data);
		}	

		function password_remider_submit(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
	   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);

			if(isset($_POST)){
				$this->form_validation->set_rules('email', 'Email', 'email|trim|required|xss_clean|callback_email_exists');   
				$this->form_validation->set_message('email', 'Correo no válido');
				if($this->form_validation->run() == FALSE ){
					$this->load->view("password_remider", $data);
				}else{
					$data['user'] = $this->user->bringme_user_data($_POST['email']);
					$to = 'anjudark89@gmail.com'. ', ';
					$to = $_POST['email']. ', ';
					// $to .= 'carlos@deklan.net';

					$subject = 'Esta es tu contraseña para ingresar a Espacio Vivo';
					$message = '¡Hola, <b>'.$data['user'][0]['name'].'</b>! Esta es tu contraseña para ingresar a Espacio Vivo<br><br><br>';
					$message .= '<b>Contraseña:</b> '.$data['user'][0]['password'].'<br><br>';

					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					// Additional headers
					$headers .= 'From: ' .$_POST['email']. "\r\n";

					if(mail($to, $subject, $message, $headers)){
						unset($data['user']);
						$this->load->view('password_sended',$data);
					}else{
						echo "<p>Lo sentimos. Hubo un problema al enviar tu mensaje. Estamos trabajando en ello. Da click 
						<a href='".base_url()."'>AQUÍ</a> para regresar a nuestra página</p>";
					}					

				}
			}
		}

		function editData(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);

	   		if($this->session->userdata('user_login')){
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $this->user->bringme_user($data['user']['user_login']['id']);
		   		$data['user'] = $data['user'][0];
		   		$navbar['user'] = $data['user'];
		   		$data['favorites'] = $this->general->user_favorites($data['user']['id']);
		   		if($data['user']['notifications']==1){
		   			$data['notifications'] = $this->user->bringme_notifications(); 
		   		}

		   		if(isset($_POST)){
	
			   		$this->form_validation->set_rules('name', 'Nombre', 'trim|required|xss_clean');   
			   		$this->form_validation->set_rules('last_name', 'Apellidos', 'trim|required|xss_clean');   
			   		$this->form_validation->set_rules('email', 'Email', 'email|trim|required|xss_clean');   
			   		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean');   
					$this->form_validation->set_message('required', 'Campo obligatorio');
					$this->form_validation->set_message('email', 'Correo no válido');
		
				   	$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);	   		

				   if($this->form_validation->run() == FALSE ){
			   			$this->load->view("cuenta", $data);
				   }else{
				   		if(!isset($_POST['notifications'])){
				   			$_POST['notifications'] = 0;
				   		}

				   		$id = $this->session->all_userdata();
				   		$id = $id['user_login']['id'];
				   		$this->user->user_edit_data($id,$_POST);
				   		$data['user'] = $this->user->bringme_user($id);

				   		$data['user'] = $data['user'][0];
				   		if($data['user']['notifications']==1){
				   			$data['notifications'] = $this->user->bringme_notifications(); 
				   		}else{
				   			$data['notifications'] = null;
				   		}

				   		$navbar['user'] = $data['user'];
				   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);	   		
				   		$this->load->view("cuenta", $data);

				   }
		   		}
	   		}else{
	   			$this->load->view("cuenta/login", $data);
	   		}
		}	

		function login(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();
	   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);			
			if(isset($_POST)){
				$this->form_validation->set_rules('email', 'E-mail', 'trim|required|xss_clean|email');   
		   		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean|callback_check_database');	   			   			
		   		$this->form_validation->set_message('required','Campo obligatorio');
		   		if($this->form_validation->run() == FALSE ){
		   			$this->load->view("login",$data);
			    }else{
			   		redirect('cuenta');
			   }
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

		function email_exists($password){
			$result = $this->user->email_exists($password);
			if($result){
				return TRUE;
			}else{
			    $this->form_validation->set_message('email_exists', 'El correo que ingresaste no está registrado');
				return FALSE;
			}
		}
	   	
	} //fin de la clase
?>