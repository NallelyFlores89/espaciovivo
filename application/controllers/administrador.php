<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start(); //we need to call PHP's session object to access it through CI
	class Administrador extends CI_Controller{
    
	    function __construct(){
	        parent::__construct();			
			$this->load->helper(array('html', 'url', 'form'));	
			$this->load->model(array('general','admin_model'));
			$this->load->library(array('form_validation','image_lib'));
	   		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>', '</div>');			
	   	}
	   	
	   	public $images = array();


	   	function index(){
	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	
   			
   			if($this->session->userdata('logged_in')){	
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];
		   		$this->panel();
			}else{
		   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
	   			$this->load->view("administrator/login", $data);
			}
	   	}

		function recuperar_contrasena(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
	   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);
	   		$data['admin'] = "something";
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
					$data['admin'] = "something";
					$this->load->view("password_remider", $data);
				}else{
					$data['user'] = $this->admin_model->bringme_admin_data($_POST['email']);
					$to = 'anjudark89@gmail.com'. ', ';
					$to = $_POST['email']. ', ';
					// $to .= 'carlos@deklan.net';

					$subject = 'Esta es tu contraseña para ingresar a Espacio Vivo';
					$message = '¡Hola, <b>'.$data['user'][0]['name'].'!</b> Esta es tu contraseña para ingresar a Espacio Vivo<br><br><br><br>';
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
	   	function editar_slider($idslider){
	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
	   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);		   	
   			
   			if($this->session->userdata('logged_in')){	
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];
		   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
		   		$data['sliders'] = $this->general->bringme_slider($idslider);
		   		$data['sliders'] = $data['sliders'][0];
		   		$this->load->view("administrator/edit_slider",$data);
			}else{
	   			$this->load->view("administrator/login", $data);
			}	   		
	   	}	   	

	   	function edit_slider_submit(){
	   		if(isset($_POST)){
	   			$this->admin_model->edit_slide($_POST['id'], $_POST);
	   			redirect ("administrador/slider");
	   		}
	   	}

	   	function nuevo_slider(){
	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
	   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);		   	
   			
   			if($this->session->userdata('logged_in')){	
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];
		   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);

		   		$this->load->view("administrator/new_slider",$data);
			}else{
	   			$this->load->view("administrator/login", $data);
			}	
	   	}


	   	function new_slider_submit(){
	   		if($_POST != null){
				$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
			   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);		   	
	   			
	   			if($this->session->userdata('logged_in')){	
			   		$data['user'] = $this->session->all_userdata();
			   		$data['user'] = $data['user']['logged_in'];
			   		$navbar['user'] = $data['user'];
			   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
				}

				$this->form_validation->set_rules('url', 'Imagen', 'trim|required|xss_clean');   
				$this->form_validation->set_message('required', 'Aún no has seleccionado/cortado una imagen');
				echo "<pre>";
				print_r($_POST);
				echo "</pre>";
			   if($this->form_validation->run() == FALSE ){
		   			$this->load->view("administrator/new_slider", $data);
			   }else{
			   		$this->admin_model->insert_new_slider($_POST);
			   		redirect('administrador/slider');
			   }
			}
	   	}
	   	function new_slider_submit2(){
	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
	   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);		   	
   			
   			if($this->session->userdata('logged_in')){	
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];
		   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
			}

	   		$valid_file = true;


			if (isset($_FILES)  && $_FILES['photo']['name'] != null) {

				// print_r($_FILES);
				
				$date = new DateTime();
				$tempFile = $_FILES['photo']['tmp_name'];

				$fileName = $date->getTimestamp().$_FILES['photo']['name'];
				$fileName = str_replace(" ", "_", $fileName);

				$targetPath = getcwd() . '/public/uploads/source_image/';
				$targetPathSlider = getcwd() . '/public/images/home-sliders/';
				$targetFile = $targetPathSlider . $fileName ;				
				// $targetFile = $targetPath . $fileName ;				

				move_uploaded_file($tempFile, $targetFile);

				list($width, $height) = getimagesize($targetFile);
							
					$_POST['url'] = $fileName;
					unset($_POST['size']);
					$this->admin_model->insert_new_slider($_POST);
					redirect ("administrador/slider");
			   // }				


			}else{
				echo "error";
			}
	   	}
	   	function slider(){
	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
	   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
		   	
   			
   			if($this->session->userdata('logged_in')){	
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];
		   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
		   		$data['sliders'] = $this->general->bringme_allsliders();
		   		$this->load->view("administrator/slider",$data);
			}else{
	   			$this->load->view("administrator/login", $data);
			}
	   	}	   	

	   	function delete_slide(){
	   		$this->admin_model->delete_slide($_POST);

	   	}
	   	function doLogin(){
	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);

		   	if(isset($_POST)){	   		
		   		$email = $_POST['email'];
		   		$this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');   
		   		$this->form_validation->set_rules('password', 'contraseña', 'trim|required|xss_clean|callback_check_database');	   		
				$this->form_validation->set_message('required', 'Campo obligatorio');

			   if($this->form_validation->run() == FALSE ){
		   			$this->load->view("administrator/login", $data);
			   }else{
			   		redirect('administrador/panel');
			   }
			}else{
				echo "no permitido";
			}
	   	}

	   	function panel(){
	   		if($this->session->userdata('logged_in')){	
				$data['alltradeagreements'] = $navbar['alltradeagreements'] = $this->general->allTradeAgreements();
			   	$data['allimmovablestype'] = $navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
			   	$data['allstates'] = $this->general->allStates();
			   	$data['immovables'] = $this->general->bringme_all_immovables();
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];
			   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
		   		$this->load->view("administrator/panel", $data);
	   		}else{
				redirect("administrador");
	   		}
	   	}

	   	function editData(){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);

	   		if($this->session->userdata('logged_in')){
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];

		   		if(isset($_POST)){
			   		$this->form_validation->set_rules('name', 'Nombre', 'trim|required|xss_clean');   
			   		$this->form_validation->set_rules('last_name', 'Apellidos', 'trim|required|xss_clean');   
			   		$this->form_validation->set_rules('email', 'Email', 'email|trim|required|xss_clean');   
			   		$this->form_validation->set_rules('password', 'Contraseña', 'email|trim|required|xss_clean');   
					$this->form_validation->set_message('required', 'Campo obligatorio');
					$this->form_validation->set_message('email', 'Correo no válido');
		
				   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);	   		

				   if($this->form_validation->run() == FALSE ){
			   			$this->load->view("administrator/panel", $data);
				   }else{
				   		$id = $this->session->userdata('logged_in');
				   		$data['immovables'] = $this->general->bringme_all_immovables();
				   		$id = $id['id'];
				   		$data['user'] = $this->admin_model->admin_edit_data($id,$_POST);
				   		$data['user'] = $data['user'][0];
				   		$this->load->view("administrator/panel", $data);

				   }
		   		}
	   		}else{
	   			$this->load->view("administrator/login", $data);
	   		}
	   	}

	   	function nuevo_inmueble(){
	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();		   	
		   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);	   
	   		$data['construction_types'] = array('1' => 'M<sup>2</sup> de construcción', '2'=>'M<sup>2</sup> de terreno','3' => 'Hectáreas');

	   		if($this->session->userdata('logged_in')){
				$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];
			   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);			   	
			   	$this->load->view("administrator/add_inmovable",$data);
			}else{
	   			$this->load->view("administrator/login", $data);				
			}
	   	}

	   	function add_inmovable(){
	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();
		   	$navbar['allcities'] = $this->general->allCities();
		   	$navbar['allsuburbs'] = $this->general->allSuburbs();
	   		$data['construction_types'] = array('1' => 'M<sup>2</sup> de construcción', '2'=>'M<sup>2</sup> de terreno','3' => 'Hectáreas');

		   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);

	   		if($this->session->userdata('logged_in')){
				$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];
			   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);			   	
		   		if(isset($_POST)){

			   		$this->form_validation->set_rules('title', 'Título', 'trim|xss_clean');   			   		
			   		$this->form_validation->set_rules('city_id', 'Estado/Delegación', 'trim|required|xss_clean');   

			   		$this->form_validation->set_rules('street', 'Calle', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('number_ext', 'Número exterior', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('price', 'Precio', 'trim|xss_clean');  
			   		$this->form_validation->set_rules('concept', 'Concepto', 'trim');   
			   		$this->form_validation->set_rules('extra_costs', 'Costos extras', 'trim');   
			   		$this->form_validation->set_rules('bedroom', 'Recamaras', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('toilet', 'Baños', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('parking_op', 'Estacionamiento', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('parking', 'Estacionamiento', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('kitchen', 'Cocina', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('description', 'Descripción', 'trim|xss_clean');    
			   		$this->form_validation->set_rules('town', 'Ciudad', 'trim|xss_clean');   
					$this->form_validation->set_rules('comments', 'Observaciones', 'trim');   
			   		$this->form_validation->set_rules('number_int', 'Número interior', 'trim');
			   		$this->form_validation->set_rules('construction_type', 'tipo de construcción', 'trim');
			   		$this->form_validation->set_rules('construction', 'Construcción', 'trim');
			   		$this->form_validation->set_rules('currency', 'Construcción', 'trim');

			   		$this->form_validation->set_rules('trade_agreements_id', 'Acuerdo comercial', 'trim|required|xss_clean');   
			   		$this->form_validation->set_rules('contract_id', 'Tipo de contrato', 'trim|required');   
			   		$this->form_validation->set_rules('states_id', 'Estado', 'callback_select_option');   
			   		$this->form_validation->set_rules('immovables_type_id', 'Tipo de inmueble', 'callback_select_option');   
					
					$this->form_validation->set_message('required', 'Campo obligatorio');
					if(isset($_POST['new_suburb'])){
					 	if($_POST['new_suburb'] != "" || $_POST['new_suburb'] != null){
							$id_suburb = $this->admin_model->add_suburb($_POST['city_id'], $_POST['new_suburb']);
						   	$navbar['allsuburbs'] = $this->general->allSuburbs();
							$_POST['suburbs_id'] = $id_suburb;
				   			$this->form_validation->set_rules('suburbs_id', 'Colonia', 'trim|required|xss_clean');   
						}
					}else{
			   			$this->form_validation->set_rules('suburbs_id', 'Colonia', 'trim|required|xss_clean');   
					}

				
				   if($this->form_validation->run() == FALSE ){
				   		if(isset($_POST['images'])){$data['images'] = $_POST['images'];}
			   			$this->load->view("administrator/add_inmovable", $data);
				   }else{
				   		$data_edit = $_POST;
	   					$data_edit['construction_types'] = array('1' => 'M<sup>2</sup> de construcción', '2'=>'M<sup>2</sup> de terreno','3' => 'Hectáreas');


				   		unset($_POST['parking_op']);
				   		unset($_POST['new_suburb']);

				   		if(isset($_POST['images'])){
				   			$images = $_POST['images'];
				   			unset($_POST['images']);
				   		}

						$id_inserted = $this->admin_model->insert_immovable($_POST);
				   		$code['code'] = $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5)."-".$id_inserted;
				   		$this->admin_model->set_code($id_inserted,$code);

						$data_edit['code'] = $code['code'];
						$data_edit['cities'] = $this->general->bringme_cities($data_edit['states_id']);
						$data_edit['suburbs'] = $this->general->bringme_suburbs($data_edit['city_id']);
					
						if(isset($images)){
							foreach ($images as $key => $value) {
								$photos['url'] = $value;
								$photos['immovables_id'] = $id_inserted;
								$this->admin_model->insert_photos($photos);

							}
						}

						$data_edit['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);	   
						$this->load->view("administrator/edit_immovable",$data_edit);

				   }
		   		}
		   	}else{
	   			$this->load->view("administrator/login", $data);
		   	}
	   	}

	   	function approve_inmovable(){

	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();		   	
		   	$navbar['allcities'] = $this->general->allCities();
		   	$navbar['allsuburbs'] = $this->general->allSuburbs();
	   		$data['construction_types'] = array('1' => 'M<sup>2</sup> de construcción', '2'=>'M<sup>2</sup> de terreno','3' => 'Hectáreas');


		   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);	   
			if($this->session->userdata('logged_in')){
				$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$navbar['user'] = $data['user'];
			   	$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);	
		   		
		   		if(isset($_POST)){

			   		$this->form_validation->set_rules('title', 'Título', 'trim|xss_clean');   
			   		// $this->form_validation->set_rules('title', 'Título', 'trim|required|xss_clean');   
			   		$this->form_validation->set_rules('city_id', 'Estado/Delegación', 'trim|required|xss_clean');   


			   		$this->form_validation->set_rules('street', 'Calle', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('number_ext', 'Número exterior', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('price', 'Precio', 'trim|xss_clean');  
			   		$this->form_validation->set_rules('concept', 'Concepto', 'trim');   
			   		$this->form_validation->set_rules('extra_costs', 'Costos extras', 'trim');   
			   		$this->form_validation->set_rules('bedroom', 'Recamaras', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('toilet', 'Baños', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('parking_op', 'Estacionamiento', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('parking', 'Estacionamiento', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('kitchen', 'Cocina', 'trim|xss_clean');   
			   		$this->form_validation->set_rules('description', 'Descripción', 'trim|xss_clean');    
			   		$this->form_validation->set_rules('town', 'Ciudad', 'trim|xss_clean');   
					$this->form_validation->set_rules('comments', 'Observaciones', 'trim');   
			   		$this->form_validation->set_rules('number_int', 'Número interior', 'trim');
			   		$this->form_validation->set_rules('construction_type', 'tipo de construcción', 'trim');
			   		$this->form_validation->set_rules('construction', 'Construcción', 'trim');

			   		$this->form_validation->set_rules('trade_agreements_id', 'Acuerdo comercial', 'trim|required|xss_clean');   
			   		$this->form_validation->set_rules('contract_id', 'Tipo de contrato', 'trim|required');   
			   		$this->form_validation->set_rules('states_id', 'Estado', 'callback_select_option');   
			   		$this->form_validation->set_rules('immovables_type_id', 'Tipo de inmueble', 'callback_select_option');  
					
					$this->form_validation->set_message('required', 'Campo obligatorio');
					$this->form_validation->set_message('numeric', 'Sólo números');

					if($_POST['new_suburb'] != "" || $_POST['new_suburb'] != null){
						$id_suburb = $this->admin_model->add_suburb($_POST['city_id'], $_POST['new_suburb']);
					   	$navbar['allsuburbs'] = $this->general->allSuburbs();
						$_POST['suburbs_id'] = $id_suburb;
					}else{
			   			$this->form_validation->set_rules('suburbs_id', 'Colonia', 'trim|required|xss_clean');   
					}
				
				   if($this->form_validation->run() == FALSE ){
				   		$data['images'] = array();
						$data['immovable'] = $this->general->bringme_immovable($_POST['code']);
						$data['immovable'] = $data['immovable'][0];
						foreach ($data['immovable']['images'] as $key => $value) {
							array_push($data['images'],$value['url']);
						}				   	
				   		$data['code'] = $_POST['code'];
				   		echo "error en formulario";
			   			$this->load->view("administrator/edit_immovable", $data);
				   }else{
				   		unset($_POST['parking_op']);
				   		unset($_POST['new_suburb']);
				   		if(isset($_POST['images'])){
				   			$images = $_POST['images'];
				   			unset($_POST['images']);
				   		}
				   		$id_inserted = $this->admin_model->approve_inmovable($_POST['code'], $_POST);

						if(isset($images)){
							foreach ($images as $key => $value) {
								$photos['url'] = $value;
								$photos['immovables_id'] = $id_inserted;
								$this->admin_model->insert_photos($photos);
							}
						}

						$redir =  "<script>";
						$redir .= "window.location = '".base_url()."inmueble/detalle/".$_POST['code']."';";
						$redir .= "</script>";
						echo $redir;
				   }
	   			}
	   		}else{
	   			$this->load->view("administrator/login", $data);
	   		}
	   	}

	   	function upload_images(){
			if (!empty($_FILES)) {
				$date = new DateTime();
				$tempFile = $_FILES['file']['tmp_name'];
				$fileName = str_replace(" ", "_", $date->getTimestamp().$_FILES['file']['name']);
				$targetPath = getcwd() . '/public/uploads/source_image/';

				$targetFile = $targetPath . $fileName ;
				$targetPathThumbs = getcwd() . '/public/uploads/thumbs';
				$targetPathUploads = getcwd() . '/public/uploads/';
				move_uploaded_file($tempFile, $targetFile);

				$config['image_library'] = 'gd2';
				$config['source_image']	= $targetFile;
				// $config['maintain_ratio'] = FALSE;
				$config['new_image'] = $targetPathUploads;
				$config['width']	= 720;
				$config['height']	= 450;
				$config['master_dim'] = 'height';
				
				$this->image_lib->initialize($config); 
				$this->image_lib->resize();							

				$this->image_lib->clear();

				$config['image_library'] = 'gd2';
				$config['source_image']	= $targetFile;
				// $config['maintain_ratio'] = FALSE;
				$config['new_image'] = $targetPathThumbs;
				$config['width']	= 120;
				$config['height']	= 120;
				$config['master_dim'] = 'height';

				$this->image_lib->initialize($config); 
				$this->image_lib->resize();	
				$this->image_lib->clear();

				echo $fileName;
			}
	   	}	   	

	   	function bringme_cities(){
	   		echo json_encode($this->general->bringme_cities($_POST['state_id']));
	   	}	   	
	   	function bringme_suburbs(){
	   		echo json_encode($this->general->bringme_suburbs($_POST['city_id']));
	   	}

	   	function delete_upload_images(){
			$targetPath = getcwd() . '/public/uploads/thumbs/';
	   		unlink($targetPath. $_POST['name']);
	   		$this->admin_model->delete_photo($_POST['name']);
	   	}

	   	function delete_immovable(){

	   		$photos = $this->general->bringme_immovable($_POST['code']);
	   		$this->admin_model->delete_photo_immovableid($photos[0]['id']);

	   		$this->admin_model->delete_immovable($_POST['code']);
	   	}

		function check_database($password,$email){
		   $email = $this->input->post('email');
		   $result = $this->admin_model->admin_login_validate($email, $password);

		   	if($result){
		       $this->session->set_userdata('logged_in', $result[0]);
		     	return TRUE;
		    }else{
			    $this->form_validation->set_message('check_database', 'Email o contraseñas incorrectos');
			    return false;
		   }

		   return false;	   
		}

		function decodeimagebase64() {
			define('UPLOAD_DIR', 'public/images/home-sliders/');

			$img = $_POST['img'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);

			$data = base64_decode($img);

			$file = UPLOAD_DIR . uniqid() . '.png';
			// $filereturn =  uniqid() . '.png';
			// $filereturn = str_replace('"','',$filereturn);
			// $filereturn = str_replace(' ','',$filereturn);
			$success = file_put_contents($file, $data);
			print_r ($success ? $file : -1);
		}

		function check_imagesize($size){
			if($size == true || $size == 'true' || $size === true){
				return true;
			}else{
			    $this->form_validation->set_message('check_imagesize', 'El tamaño de la imagen no cumple con las medidas específicadas');				
				return false;
			}
		}

		 function logout(){
		   $this->session->unset_userdata('logged_in');
		   session_destroy();
		   redirect('welcome', 'refresh');
		}			
	   	
	   	function select_option($val){
	   		if($val == -1){
	   			$this->form_validation->set_message('select_option', 'Selecciona una opción');
	   			return FALSE;
	   		}else{
	   			return TRUE;
	   		}
	   	}

	   	function email_exists($password){
			$result = $this->admin_model->email_exists($password);
			if($result){
				return TRUE;
			}else{
			    $this->form_validation->set_message('email_exists', 'El correo que ingresaste no está registrado');
				return FALSE;
			}
		}



	} //fin de la clase
?>