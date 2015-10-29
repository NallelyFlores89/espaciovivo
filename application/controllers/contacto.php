<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Contacto extends CI_Controller{
    
	    function __construct(){
	        parent::__construct();			
			$this->load->helper(array('html', 'url', 'form'));	
			$this->load->model('general');
			$this->load->library('form_validation');
	   		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');			

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
			
	   		$this->load->view("contacto", $data);
	   	}

	   	function send(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
	   		$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();	   		
			$this->form_validation->set_message('required', 'Campo obligatorio');

			if($this->session->userdata('user_login')){
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['user_login'];
		   		$data['favorites'] = $this->general->user_favorites($data['user']['id']);
		   		$navbar['user'] = $data['user'];
		   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);
			}else{
		   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);
			}   		   		
	   		if (isset($_POST)) {
	   			$this->form_validation->set_rules('name', 'Nombre', 'required');
 				$this->form_validation->set_rules('email', 'Email', 'required|email');
 				$this->form_validation->set_rules('phone', 'Teléfono', 'required');
 				$this->form_validation->set_rules('msg', 'Mensaje', 'required');
				if ($this->form_validation->run() == FALSE){
					$this->load->view('contacto', $data);
				}else{
					$to = 'anjudark89@gmail.com'. ', ';
					$to .= 'info@espaciovivomexico.com'. ', ';
					$to .= 'carlos@deklan.net';

					$subject = 'Nuevo mensaje de Espacio Vivo';
					$message = '<b>'.$_POST['name'].'</b> ¡Nos ha enviado un mensaje!<br><br>';
					$message .= '<b>Correo: '.$_POST['email'].'</b><br><br>';
					$message .= '<b>Teléfono: '.$_POST['phone'].'</b><br><br>';
					$message .= '<b>Mensaje:</b>'.$_POST['msg'].'<br><br>';

					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					// Additional headers
					$headers .= 'From: ' .$_POST['email']. "\r\n";

					if(mail($to, $subject, $message, $headers)){
						$data['name'] = $_POST['name'];
						$this->load->view('gracias_msg',$data);
					}else{
						echo "<p>Lo sentimos. Hubo un problema al enviar tu mensaje. Estamos trabajando en ello. Da click 
						<a href='".base_url()."'>AQUÍ</a> para regresar a nuestra página</p>";
					}
				}

	   		}
	   	}
	   	
	} //fin de la clase
?>