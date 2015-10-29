<?php if(! defined('BASEPATH')) exit ('No direct script acces allowed');

	class Admin_model extends CI_Model{
	
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function admin_login_validate($email, $password){
			$this->db->select('id, email, name, last_name, password');
			$this->db->from('admin');
			$this->db->where('email',$email);
			$this->db->where('password', $password);
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1){
				return $query->result_array();
			}else{
				return false;
			}
		}	

		function bringme_admin_data($email){
			$this->db->where('email',$email);
			$query = $this->db->get('admin');
			return $query->result_array();
		}

		function email_exists($email){
			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where('email',$email);
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1){
				return $query->result_array();
			}else{
				return false;
			}
		}		

		function admin_edit_data($id,$data){
			$this->db->where('id', $id);
			$this->db->update('admin',$data);
			$this->db->select('id, email, name, last_name, password');
			$this->db->from('admin');
			$this->db->where('id',$id);
			$query = $this->db->get();
			
			return $query->result_array();
		}

		function insert_immovable($data){
			$this->db->insert('immovables',$data);
			$id = $this->db->insert_id();
			return $id;
		}

		function insert_photos($data){
			// print_r($data);
			$this->db->insert('photos',$data);
		}

		function delete_photo($data){
			$this->db->where('url',$data);
			$this->db->delete('photos');
		}

		function delete_photo_immovableid($idimmovable){
			$this->db->where('immovables_id',$idimmovable);
			$this->db->delete('photos');

		}
		function add_suburb($city_id, $name){
			// echo "jaja";
			$data = array(
				'city_id' => $city_id,
				'name' => $name,
			);
			// print_r($data);
			$this->db->insert('catalogue_suburbs',$data);
			$id = $this->db->insert_id();
			return $id;

		}
		function delete_immovable($code){
			$this->db->where('code',$code);
			$this->db->delete('immovables');
		}

		function insert_new_slider($data){
			$this->db->insert('sliders',$data);
		}

		function delete_slide($data){
			$this->db->where($data);
			$this->db->delete('sliders');
		}

		function edit_slide($id, $data){
			unset($data['id']);
			$this->db->where('id', $id);
			$this->db->update('sliders',$data);
			
			$this->db->from('sliders');
			$this->db->where('id',$id);
			$query = $this->db->get();
			
			return $query->result_array();			
		}
		function set_code($id,$code){
			$this->db->where('id',$id);
			$this->db->update('immovables',$code);
		}

		function approve_inmovable($code, $data){
			$data['draft'] = 0;
			$this->db->where('code',$code);
			$this->db->update('immovables',$data);

			$this->db->where('code',$code);
			return $this->db->get('immovables')->row()->id;
		}

	} //Fin de la clase
?>