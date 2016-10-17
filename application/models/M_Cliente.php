<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cliente extends CI_Model
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
                'username_register'     => $data['username']
            );
        $this->db->insert('customers', $datos);
    }
    function delete($id){
        $this->db->delete('customers', array('customer_id' => $id));
    }
    function create_account($data){
        $datos = array( 'currency'          => $data['currency'],
                        'customer_id'       => $data['customer_id'],
                        'username_register' => $data['username']
                      );
        $this->db->insert('customer_accounts', $datos);
    }
	function read_all(){
        $this->db->order_by('customer_name', 'ASC');
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
    function saldo($customer_id){
        $query = $this->db->query(' SELECT saldo
                                    FROM customers
                                    WHERE customer_id = '.$customer_id);
        //$this->output->enable_profiler(TRUE);
        $result = $query->row();
        if($query -> num_rows() > 0) return $result;
        else return false;
    }
    function update_saldo($data){
        $datos = array(
                'saldo' => $data['nuevo_saldo']
        );
        $this->db->where('customer_id', $data['customer_id']);
        $this->db->update('customers', $datos); 
    }
    function comprobante($data){
        $datos = array( 
                'comprobante_monto'     => $data['monto'],
                'customer_id'           => $data['customer_id']
            );
        $this->db->insert('comprobante', $datos);
    }
    function read_email($email)
    {
        $this->db->where('customer_email', $email);
        $query = $this->db->get('customers');
        $result = $query->row();
        if($query -> num_rows() > 0) return $result;
        else return false;
    }
    function read_phone($phone)
    {
        $this->db->where('customer_phone', $phone);
        $query = $this->db->get('customers');
        $result = $query->row();
        if($query -> num_rows() > 0) return $result;
        else return false;
    }
    function update($data){
        $datos = array(
                'customer_document'     => $data['document'], 
                'customer_name'         => $data['name'], 
                'customer_email'        => $data['email'], 
                'customer_address'      => $data['address'], 
                'customer_phone'        => $data['phone']
            );
        
        $this->db->where('customer_id', $data['id']);
        $this->db->update('customers', $datos); 
    }
    //Auditoria clientes
    function auditory($data)
    {
        $datos = array(
                        'customer_id'       => $data['id'],
                        'customer_document' => $data['document'],
                        'customer_name'     => $data['name'],
                        'customer_email'    => $data['email'],
                        'customer_address'  => $data['address'],
                        'customer_phone'    => $data['phone'],
                        'date_register'     => $data['date_register'],
                        'event'             => $data['event'],
                        'username_update'   => $data['username']
                      );
        $this->db->insert('audit_customer', $datos);
    }
}