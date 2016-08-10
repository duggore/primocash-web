<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
    function create($data){
        $datos = array( 
                'customer_document'     => $data['document'], 
                'customer_name'         => $data['name'], 
                'customer_email'        => $data['email'], 
                'customer_address'      => $data['address'], 
                'customer_phone'        => $data['phone'],
                'customer_guarantee'    => $data['guarantee'],
                'username_register'     => $data['username']
            );
        $this->db->insert('customers', $datos);
    }
    function create_account($data){
        $datos = array( 'currency'          => $data['currency'],
                        'customer_id'       => $data['customer_id'],
                        'username_register' => $data['username']
                      );
        $this->db->insert('customer_accounts', $datos);
    }
	function read_all(){
		$query = $this->db->get('customers');
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
    function read($id){
        $this->db->where('customer_id', $id);
        $query = $this->db->get('customers');
        $result = $query->row();
        if($query -> num_rows() > 0) return $result;
        else return false;
    }
    function read_email($email)
    {
        $this->db->where('customer_email', $email);
        $query = $this->db->get('customers');
        $result = $query->row();
        if($query -> num_rows() > 0) return $result;
        else return false;
    }
    function read_accounts($id)
    {
        $this->db->where('customer_id', $id);
        $query = $this->db->get('customer_accounts');
        if($query -> num_rows() > 0) return $query;
        else return false;
    }
    function update($data){
        $datos = array(
                'customer_document'     => $data['document'], 
                'customer_name'         => $data['name'], 
                'customer_email'        => $data['email'], 
                'customer_address'      => $data['address'], 
                'customer_phone'        => $data['phone'],
                'customer_guarantee'    => $data['guarantee']
            );
        
        $this->db->where('customer_id', $data['id']);
        $this->db->update('customers', $datos); 
    }
}