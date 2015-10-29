<?php if(! defined('BASEPATH')) exit ('No direct script acces allowed');

	class General extends CI_Model{
	
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		function allTradeAgreements(){
			$query = $this->db->get('trade_agreements');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}
		function allImmovablesTypes(){
			$query = $this->db->get('immovables_type');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}	

		function bringme_allsliders(){
			$query = $this->db->get('sliders');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}			
		}
		
		function bringme_slider($id){
			$this->db->where('id',$id);
			$query = $this->db->get('sliders');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}			
		}		

		function allContracts()	{
			$query = $this->db->get('contracts');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}			
		}

		function allStates()	{
			$query = $this->db->get('catalogue_states');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}			
		}			
		function allCities()	{
			$query = $this->db->get('catalogue_cities');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}			
		}		
		function allSuburbs()	{
			$query = $this->db->get('catalogue_suburbs');
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}			
		}	

		function bringme_cities($state_id){
			$this->db->where('state_id', $state_id);
			$query = $this->db->get('catalogue_cities');
			return $query->result_array();
		}

		function bringme_suburbs($city_id){
			$this->db->where('city_id', $city_id);
			$query = $this->db->get('catalogue_suburbs');
			return $query->result_array();
		}

		function bringme_all_immovables(){
			$this->db->select('immovables.*, catalogue_states.name as state, catalogue_cities.name as city, catalogue_suburbs.name as suburb, contracts.name as contract, immovables_type.name as immovables_type,trade_agreements.name as trade_agreements');
	   		$this->db->join('catalogue_states','catalogue_states.id = immovables.states_id');
			$this->db->join('catalogue_cities','catalogue_cities.id = immovables.city_id');
			$this->db->join('catalogue_suburbs','catalogue_suburbs.id = immovables.suburbs_id');
			$this->db->join('contracts','contracts.id = immovables.contract_id');
			$this->db->join('immovables_type','immovables_type.id = immovables.immovables_type_id');
			$this->db->join('trade_agreements','trade_agreements.id = immovables.trade_agreements_id');
			$this->db->order_by('id','desc');
			
	   		$query = $this->db->get('immovables');

	   		if($query->num_rows()>0){
	   			$query = $query->result_array();
	   			foreach ($query as $key => $value) {
					$this->db->where('immovables_id',$value['id']);
					$this->db->limit(1);

					$query[$key]['images'] = $this->db->get('photos')->result_array();
	   			}
	   			return $query;
	   		}else{
	   			return -1;
	   		}
		}

		function photos_immovable($id){
			$this->db->where('immovables_id', $id);
			$query = $this->db->get('photos');
			$photos = array();
			foreach ($query->result_array() as $key => $value) {
				$photos[$key]['href'] = base_url()."public/uploads/".$value['url'];
				$photos[$key]['thumbnail'] = base_url()."public/uploads/".$value['url'];
				$photos[$key]['title'] = "";
			}
			return $photos;
		}

		function bringme_immovable($code){
			$this->db->select('immovables.*, catalogue_states.name as state, catalogue_cities.name as city, catalogue_suburbs.name as suburb, contracts.name as contract, immovables_type.name as immovables_type,trade_agreements.name as trade_agreements');
			$this->db->join('catalogue_states','catalogue_states.id = immovables.states_id');
			$this->db->join('catalogue_cities','catalogue_cities.id = immovables.city_id');
			$this->db->join('catalogue_suburbs','catalogue_suburbs.id = immovables.suburbs_id');
			$this->db->join('contracts','contracts.id = immovables.contract_id');
			$this->db->join('immovables_type','immovables_type.id = immovables.immovables_type_id');
			$this->db->join('trade_agreements','trade_agreements.id = immovables.trade_agreements_id');

			$this->db->where('code', $code);
			$query = $this->db->get('immovables')->result_array();


			$this->db->where('immovables_id',$query[0]['id']);
			$query[0]['images'] = $this->db->get('photos')->result_array();
			return $query;	
		}

		function search_inmovable($key){
			$this->db->select('immovables.*, catalogue_states.name as state, catalogue_cities.name as city, catalogue_suburbs.name as suburb, contracts.name as contract, immovables_type.name as immovables_type,trade_agreements.name as trade_agreements');
	   		$this->db->join('catalogue_states','catalogue_states.id = immovables.states_id');
			$this->db->join('catalogue_cities','catalogue_cities.id = immovables.city_id');
			$this->db->join('catalogue_suburbs','catalogue_suburbs.id = immovables.suburbs_id');
			$this->db->join('contracts','contracts.id = immovables.contract_id');
			$this->db->join('immovables_type','immovables_type.id = immovables.immovables_type_id');
			$this->db->join('trade_agreements','trade_agreements.id = immovables.trade_agreements_id');
			
			$this->db->like('title', $key);
			$this->db->or_like('code', $key);
			$this->db->distinct();

	   		$query = $this->db->get('immovables');

	   		if($query->num_rows()>0){
	   			$query = $query->result_array();
	   			foreach ($query as $key => $value) {
					$this->db->where('immovables_id',$value['id']);
					$this->db->limit(1);

					$query[$key]['images'] = $this->db->get('photos')->result_array();
	   			}
	   			return $query;
	   		}else{
	   			return -1;
	   		}
		}		

		function search_inmovable2($filters){
			$this->db->select('immovables.*, catalogue_states.name as state, catalogue_cities.name as city, catalogue_suburbs.name as suburb, contracts.name as contract, immovables_type.name as immovables_type,trade_agreements.name as trade_agreements');
	   		$this->db->join('catalogue_states','catalogue_states.id = immovables.states_id');
			$this->db->join('catalogue_cities','catalogue_cities.id = immovables.city_id');
			$this->db->join('catalogue_suburbs','catalogue_suburbs.id = immovables.suburbs_id');
			$this->db->join('contracts','contracts.id = immovables.contract_id');
			$this->db->join('immovables_type','immovables_type.id = immovables.immovables_type_id');
			$this->db->join('trade_agreements','trade_agreements.id = immovables.trade_agreements_id');
			
			$this->db->where($filters);

	   		$query = $this->db->get('immovables');
	   		if($query->num_rows()>0){
	   			$query = $query->result_array();
	   			foreach ($query as $key => $value) {
					$this->db->where('immovables_id',$value['id']);
					$this->db->limit(1);

					$query[$key]['images'] = $this->db->get('photos')->result_array();
	   			}
	   			return $query;
	   		}else{
	   			return -1;
	   		}
		}		

	   	function bringme_immovables($agreement, $type){
			$this->db->select('immovables.*, catalogue_states.name as state, catalogue_cities.name as city, catalogue_suburbs.name as suburb, contracts.name as contract, immovables_type.name as immovables_type,trade_agreements.name as trade_agreements');
	   		$this->db->join('catalogue_states','catalogue_states.id = immovables.states_id');
			$this->db->join('catalogue_cities','catalogue_cities.id = immovables.city_id');
			$this->db->join('catalogue_suburbs','catalogue_suburbs.id = immovables.suburbs_id');
			$this->db->join('contracts','contracts.id = immovables.contract_id');
			$this->db->join('immovables_type','immovables_type.id = immovables.immovables_type_id');
			$this->db->join('trade_agreements','trade_agreements.id = immovables.trade_agreements_id');
			
			$this->db->where('trade_agreements_id', $agreement);
	   		$this->db->where('immovables_type_id', $type);

	   		$query = $this->db->get('immovables');

	   		if($query->num_rows()>0){
	   			$query = $query->result_array();
	   			foreach ($query as $key => $value) {
					$this->db->where('immovables_id',$value['id']);
					$this->db->limit(1);

					$query[$key]['images'] = $this->db->get('photos')->result_array();
	   			}
	   			return $query;
	   		}else{
	   			return -1;
	   		}
	   	}	

	   	function is_favorite($user_id, $immovable_id){
	   		$this->db->where('users_id',$user_id);
	   		$this->db->where('immovables_id',$immovable_id);

	   		$query = $this->db->get('users_favorites');

	   		if($query->num_rows() > 0){
	   			return 1;
	   		}else{
	   			return -1;
	   		}
	   	}

	   	function user_favorites($user_id){
	   		$this->db->join('immovables', 'immovables.id = users_favorites.immovables_id');
			$this->db->select('immovables.*, catalogue_states.name as state, catalogue_cities.name as city, catalogue_suburbs.name as suburb, contracts.name as contract, immovables_type.name as immovables_type,trade_agreements.name as trade_agreements');
	   		$this->db->join('catalogue_states','catalogue_states.id = immovables.states_id');
			$this->db->join('catalogue_cities','catalogue_cities.id = immovables.city_id');
			$this->db->join('catalogue_suburbs','catalogue_suburbs.id = immovables.suburbs_id');
			$this->db->join('contracts','contracts.id = immovables.contract_id');
			$this->db->join('immovables_type','immovables_type.id = immovables.immovables_type_id');
			$this->db->join('trade_agreements','trade_agreements.id = immovables.trade_agreements_id');	   		
	   		$this->db->where('users_favorites.users_id',$user_id);

	   		$query = $this->db->get('users_favorites');
			if($query->num_rows()>0){
	   			$query = $query->result_array();
	   			foreach ($query as $key => $value) {
					$this->db->where('immovables_id',$value['id']);
					$this->db->limit(1);

					$query[$key]['images'] = $this->db->get('photos')->result_array();
					$query[$key]['images'] = $query[$key]['images'][0];
	   			}
	   			return $query;
	   		}else{
	   			return -1;
	   		}   		
	   	}

	   	function set_favorite($user_id, $immovable_id){
	   		$data = array(
	   			'users_id' => $user_id,
	   			'immovables_id' => $immovable_id,
	   		);
	   		$this->db->insert('users_favorites',$data);
	   	}

	   	function unset_favorite($user_id, $immovable_id){

	   		$this->db->where('users_id', $user_id);
	   		$this->db->where('immovables_id', $immovable_id);
	   		$this->db->delete('users_favorites');
	   	}	   	


	   	function suburbs_immovable($agreement, $type){
	   		$this->db->select('catalogue_suburbs.*');
			$this->db->join('catalogue_suburbs','catalogue_suburbs.id = immovables.suburbs_id');
			$this->db->where('trade_agreements_id', $agreement);
	   		$this->db->where('immovables_type_id', $type);
	   		$this->db->distinct();
	   		$query = $this->db->get('immovables');

	   		if($query->num_rows() > 0){
	   			return $query->result_array();
	   		}else{
	   			return -1;
	   		}
	   	}
	} //Fin de la clase
?>