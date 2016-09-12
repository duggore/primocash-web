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
                'customer_name'         => $data['customer_name'],
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
    function auditory($data)
    {
        $datos = array( 
                'contract_id'           => $data['contract_id'],
                'customer_id'           => $data['customer_id'], 
                'customer_name'         => $data['customer_name'],
                'date_initial'          => $data['date_initial'], 
                'capital'               => $data['capital'], 
                'percentage'            => $data['percentage'], 
                'division'              => $data['division'],
                'guarantee'             => $data['guarantee'],
                'username_register'     => $data['username_register'],
                'username_update'       => $data['username_update']
            );
        $this->db->insert('audit_contracts', $datos);
    }
    function delete($id){
        $this->db->delete('customers', array('customer_id' => $id));
    }
	function read_all(){
        $this->db->order_by('contract_id', 'ASC');
        $query = $this->db->get('contracts');
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
    function read($id){ 
        $query = $this->db->query('
                                    SELECT  A.contract_id,
                                            A.customer_id,
                                            A.date_initial,
                                            A.capital,
                                            A.division,
                                            A.guarantee,
                                            A.percentage,
                                            A.date_register,
                                            A.username_register,
                                            B.customer_name,
                                            B.customer_phone
                                    FROM contracts as A
                                        LEFT JOIN customers as B
                                            ON B.customer_id    = A.customer_id
                                    WHERE A.contract_id     = '.$id.'
                                ');
        $result = $query->row();
        if($query -> num_rows() > 0) return $result;
        else return false;
    }
    function cuotas($id){
        $this->db->order_by('contract_fee', 'ASC');
        $this->db->where('contract_id', $id);
        $query = $this->db->get('contract_details');
        if($query -> num_rows() > 0) return $query;
        else return false;
    }
    function proximos(){
        $query = $this->db->query('
                                    SELECT * 
                                    FROM `contract_details`  
                                    WHERE payment_date > NOW() 
                                    ORDER BY payment_date
                                    LIMIT 5
                                 ');
        if($query -> num_rows() > 0) return $query;
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
                'customer_id'     => $data['customer_id'], 
                'customer_name'   => $data['customer_name'], 
            );        
        $this->db->where('contract_id', $data['contract_id']);
        $this->db->update('contracts', $datos); 
    }
}