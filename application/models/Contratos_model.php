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
                'division'              => $data['division'],
                'guarantee'             => $data['guarantee'],
                'username_register'     => $data['username_register']
            );
        $this->db->insert('contracts', $datos);
        $contract_id = $this->db->insert_id();
        return $contract_id;
        
    }
    function cuotas($contract_id, $capital, $division, $percentage, $date_initial, $username_register)
    {
        $updates = array(
                        'percentage'            => $percentage        
                        );
        $this->db->where('contract_id', $contract_id);
        $this->db->update('contracts', $updates); 

       
        /*
        **Insercion de las cuotas
        */
        $fecha = $date_initial;
        $interes_mensual = (($capital * $percentage) /100);
        $ultima_cuota    = $interes_mensual + $capital;
        //ciclo de insercion de cuotas
        for($i = 0; $i < $division; $i++){
            $fecha = strtotime ( '+1 month', strtotime ( $fecha ) ) ;
            $fecha = date ( 'Y-m-j' , $fecha );
            //arreglo de variables de la cuota
            $item = array(  'contract_id'   => $contract_id,
                            'contract_fee'  => ($i + 1),
                            'payment_date'  => $fecha,
                            'username_register'     => $username_register
                         );

            if($i != ($division - 1)){
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
                'date_register'         => $data['date_register'],
                'event'                 => $data['event'],
                'username_register'     => $data['username_register'],
                'username_update'       => $data['username_update']
            );
        $this->db->insert('audit_contracts', $datos);
    }
    function delete($id){
        $this->db->delete('customers', array('customer_id' => $id));
    }
    function delete_details($id)
    {
        $this->db->delete('contract_details', array('contract_id' => $id));   
    }
	function read_all(){
        $query = $this->db->query('SELECT   A.contract_id,
                                            B.customer_name
                                   FROM contracts AS A
                                    LEFT JOIN customers AS B
                                        ON B.customer_id = A.customer_id
                                   ORDER BY contract_id ASC');
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
    
    function getCuotas($id){
        $this->db->order_by('contract_fee', 'ASC');
        $this->db->where('contract_id', $id);
        $query = $this->db->get('contract_details');
        if($query -> num_rows() > 0) return $query;
        else return false;
    }
    function proximos(){
        $query = $this->db->query('
                                    SELECT  A.contract_id,
                                            A.payment_date,
                                            A.amount,
                                            C.customer_name
                                    FROM contract_details AS A
                                        LEFT JOIN contracts AS B
                                            ON B.contract_id = A.contract_id
                                        LEFT JOIN customers AS C
                                            ON C.customer_id = B.customer_id
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