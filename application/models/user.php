<?php if(! defined('BASEPATH')) exit ('No direct script acces allowed');

	class User extends CI_Model{
	
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function register_user($data){
			$this->db->insert('users',$data);
		}

		function email_exists($email){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('email',$email);
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1){
				return $query->result_array();
			}else{
				return false;
			}
		}

		function user_login_validate($email, $password){
			$this->db->select('*');
			$this->db->from('users');
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

		function user_edit_data($id, $data){
			$this->db->where('id', $id);
			$this->db->update('users',$data);
					}

		function bringme_user($id){
			$this->db->where('id',$id);
			$query = $this->db->get('users');
			return $query->result_array();
		}

		function bringme_user_data($email){
			$this->db->where('email',$email);
			$query = $this->db->get('users');
			return $query->result_array();
		}

		function bringme_notifications(){
			$this->db->select('immovables.*, catalogue_states.name as state, catalogue_cities.name as city, catalogue_suburbs.name as suburb, contracts.name as contract, immovables_type.name as immovables_type,trade_agreements.name as trade_agreements');
	   		$this->db->join('catalogue_states','catalogue_states.id = immovables.states_id');
			$this->db->join('catalogue_cities','catalogue_cities.id = immovables.city_id');
			$this->db->join('catalogue_suburbs','catalogue_suburbs.id = immovables.suburbs_id');
			$this->db->join('contracts','contracts.id = immovables.contract_id');
			$this->db->join('immovables_type','immovables_type.id = immovables.immovables_type_id');
			$this->db->join('trade_agreements','trade_agreements.id = immovables.trade_agreements_id');
			$this->db->order_by('id','desc');
			$this->db->limit(10);

	   		$query = $this->db->get('immovables');

	   		if($query->num_rows()>0){
	   			$query = $query->result_array();
	   			foreach ($query as $key => $value) {
					$this->db->where('immovables_id',$value['id']);
					$this->db->limit(1);

					$query[$key]['images'] = $this->db->get('photos')->result_array();
					if(isset($query[$key]['images'])){
						if(isset( $query[$key]['images'][0])){
							$query[$key]['images'] = $query[$key]['images'][0];
						}else{
							$query[$key]['images']['url']= '';
						}	
					}
	   			}
	   			return $query;
	   		}else{
	   			return -1;
	   		}
		}


	} //Fin de la clase
?>