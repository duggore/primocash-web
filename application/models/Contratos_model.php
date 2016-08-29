<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
    function create($data){
        $datos = array( 
                'customer_id'           => $data['customer_id'], 
                'date_initial'          => $data['date_initial'], 
                'capital'               => $data['capital'], 
                'percentage'            => $data['percentage'], 
                'division'              => $data['fraccionamiento'],
                'guarantee'             => $data['guarantee'],
                'username_register'     => $data['username']
            );
        $this->db->insert('contracts', $datos);
        $contract_id = $this->db->insert_id();
        /*
        **Insercion de las cuotas
        */
        $fecha = $datos['date_initial'];
        $interes_mensual = (($datos['capital'] * $datos['percentage']) /100);
        $ultima_cuota    = $interes_mensual + $datos['capital'];
        //ciclo de insercion de cuotas
        for($i = 0; $i < $datos['division']; $i++){
            $fecha = strtotime ( '+1 month', strtotime ( $fecha ) ) ;
            $fecha = date ( 'Y-m-j' , $fecha );
            //arreglo de variables de la cuota
            $item = array(  'contract_id'   => $contract_id,
                            'contract_fee'  => ($i + 1),
                            'payment_date'  => $fecha,
                            'username_register'     => $data['username']
                         );

            if($i != ($datos['division'] - 1)){
                $item['amount'] = $interes_mensual;
                $this->db->insert('contract_details', $item);
            }else{
                $item['amount'] = $ultima_cuota;  
                $this->db->insert('contract_details', $item);
            }
        }
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
        $this->db->order_by('contract_id', 'ASC');
        $query = $this->db->get('contracts');
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
    function read($id){
        $this->db->where('contract_id', $id);
        $query = $this->db->get('contracts');
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