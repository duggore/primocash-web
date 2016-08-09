<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//Aqui vamos a realizar el CRUD (create, read, update, delete)
	function create($data){
		$this->db->insert('menus', array(	'description'	=> $data['description'],
											'url' 			=> $data['page'],
											'username' 		=> $data['username']
										  )
						 );
	}
	function read_all(){
		$query = $this->db->get('menus');
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
	function read($id){
		$this->db->where('menu_id', $id);
		$query = $this->db->get('menus');
		$result = $query->row();
		if($query -> num_rows() > 0) return $result;
		else return false;
	}
	function update($id, $data)
	{
		$now = date('Y-m-d H:m:s'); 
		$datos = array(
						'description' 	=> $data['description'], 
						'url' 			=> $data['page'],
						'date_update'	=> $now,
						'username' 		=> $data['username']
					  );
		$this->db->where('menu_id', $id);
		$this->db->update('menus', $datos); 
	}
	function delete($id){
		$this->db->delete('menus', array('menu_id' => $id));
	}
}