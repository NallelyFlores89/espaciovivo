<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Inmueble extends CI_Controller{
    
	    function __construct(){
	        parent::__construct();			
			$this->load->helper(array('html', 'url', 'form'));	
			$this->load->model('general');
	   	}

	   	function detalle($code){
			$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();
			$data['immovable'] = $this->general->bringme_immovable($code);
			$data['immovable'] = $data['immovable'][0];

			
			$data['gallery'] = json_encode($this->general->photos_immovable($data['immovable']['id']));
   			
   			if($this->session->userdata('user_login')){
   				$data['user_id'] = $this->session->all_userdata();
   				$data['user_id'] = $data['user_id']['user_login']['id'];
   				$data['is_favorite'] = $this->general->is_favorite($data['user_id'], $data['immovable']['id']);
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['user_login'];

		   		$data['favorites'] = $this->general->user_favorites($data['user']['id']);
		   		$navbar['user'] = $data['user'];
		   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);
			}else{
		   		$data['navbar'] = $this->load->view('layaouts/navbar',$navbar, TRUE);

	   			if($this->session->userdata('logged_in')){
	   				$data['user_id'] = $this->session->all_userdata();
	   				$data['user_id'] = $data['user_id']['logged_in']['id'];
			   		$data['user'] = $this->session->all_userdata();
			   		$data['user'] = $data['user']['logged_in'];
			   		$navbar['user'] = $data['user'];
			   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
				}else{
			   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
				}						
			}   

			$this->load->view("immovable_detail",$data);
	   	}

	   	public function generar($code) {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        // $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Espacio Vivo');
        // $pdf->SetTitle('Ejemplo de provincías con TCPDF');
        // $pdf->SetSubject('Tutorial TCPDF');
        $pdf->SetKeywords('espacio vivo, inmuebles, pdf, PDF, renta');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        // $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('helvetica', '' , 14, '', false);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $immovable = $this->general->bringme_immovable($code);
        $immovable = $immovable[0];

        $html = $this->load->view("pdf", $immovable, true);
// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
 
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Inmueble".$immovable['code'].".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

	   	function check_favorite(){
	   		if($this->session->userdata('user_login')){
	   			$data['user_id'] = $this->session->all_userdata();
	   			$data['user_id'] = $data['user_id']['user_login']['id'];

   				if($this->general->is_favorite($data['user_id'], $_POST['id']) == -1) {
		   			$this->general->set_favorite($data['user_id'], $_POST['id']);
		   			echo json_encode(1);
   				}else{
		   			$this->general->unset_favorite($data['user_id'], $_POST['id']);
   					echo json_encode(0);
   				}
	   		}else{
	   			echo json_encode(-1);
	   		}
	   	}

	   	function delete_favorite(){
	   		if($this->session->userdata('user_login')){
	   			$data['user_id'] = $this->session->all_userdata();
	   			$data['user_id'] = $data['user_id']['user_login']['id'];
	   			$this->general->unset_favorite($data['user_id'], $_POST['id']);
	   			echo json_encode(1);
	   		}else{
	   			echo json_encode(-1);
	   		}
	   	}

	   	function search(){
	   		if(isset($_POST)){

		   		$response = array();
	   			if($_POST['keys'] == 'all'){
   					$search_result = $this->general->bringme_all_immovables();
	   				if($search_result != -1){
	   					foreach ($search_result as $j => $result) {
	   						array_push($response,$result);
	   					}
	   				}
	   			}else{
		   			$key = explode(" ",$_POST['keys']);
		   			$key = array_diff($key, array(""));
		   			foreach ($key as $i => $value) {
		   				$search_result = $this->general->search_inmovable($value);
		   				if($search_result != -1){
		   					foreach ($search_result as $j => $result) {
		   						array_push($response,$result);
		   					}
		   				}
		   			}
		   		}
	   		}
	   		if(isset($response) && $response != null){
	   			echo json_encode($response);
	   		}else{
	   			echo json_encode(-1);
	   		}
	   	}

	   	function search2(){
	   		$response = array();
	   		if(isset($_POST)){
	   			foreach ($_POST as $key => $value) {
	   				if($value == -1){
	   					unset($_POST[$key]);
	   				}
	   			}
	   			if(isset($_POST)){
	   				$search_result = $this->general->search_inmovable2($_POST);
	   				if($search_result != -1){
	   					foreach ($search_result as $j => $result) {
	   						array_push($response,$result);
	   					}
	   				}
	   			}else{
	   				$search_result = $this->general->bringme_all_immovables();
	   				if($search_result != -1){
	   					foreach ($search_result as $j => $result) {
	   						array_push($response,$result);
	   					}
	   				}
	   			}
	   		}

	   		if(isset($response) && $response != null){
	   			echo json_encode($response);
	   		}else{
	   			echo json_encode(-1);
	   		}
	   	}

	   	function searchBySuburb(){
	   		if(isset($_POST)){
	   			$search_result = $this->general->search_inmovable2($_POST);
	   		}

	   		if(isset($search_result) && $search_result != null){
	   			echo json_encode($search_result);
	   		}else{
	   			echo json_encode(-1);
	   		}
	   	}
	   	function editar($code){
	   		$navbar['alltradeagreements'] = $this->general->allTradeAgreements();
		   	$navbar['allimmovablestype'] = $this->general->allImmovablesTypes();
		   	$navbar['allcontracts'] = $this->general->allContracts();
		   	$navbar['allstates'] = $this->general->allStates();		   	
		   	$navbar['allcities'] = $this->general->allCities();
		   	$navbar['allsuburbs'] = $this->general->allSuburbs();
	   		$data['construction_types'] = array('1' => 'M<sup>2</sup> de construcción', '2'=>'M<sup>2</sup> de terreno','3' => 'Hectáreas');

	   		if($this->session->userdata('logged_in')){
		   		$data['user'] = $this->session->all_userdata();
		   		$data['user'] = $data['user']['logged_in'];
		   		$data['favorites'] = $this->general->user_favorites($data['user']['id']);
		   		$navbar['user'] = $data['user'];
		   		$data['navbar'] = $this->load->view('administrator/layaouts/navbar',$navbar, TRUE);
				$data['immovable'] = $this->general->bringme_immovable($code);
				$data['immovable'] = $data['immovable'][0];
				$data['code'] = $code;
				$data['images'] = array();
				$data['edit'] = true;
				foreach ($data['immovable']['images'] as $key => $value) {
					array_push($data['images'],$value['url']);
				}

				$this->load->view("administrator/edit_immovable",$data);
			}else{
				echo "nop";
			}
	   	}
	   	
	} //fin de la clase
?>