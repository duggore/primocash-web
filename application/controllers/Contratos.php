<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logueado')){			
			redirect('login');
		}else{
			$this->load->model('Usuarios_model');
			$this->load->model('M_Contrato');
			$this->load->model('M_Cliente');
		}
	}
	public function index()
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		//Datos especificos
		$data['contratos'] = $this->M_Contrato->read_all();
		//Proximos contratos
		$data['proximos'] = $this->M_Contrato->proximos();
		//Plantilla
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('contratos/V_index');
		$this->load->view('template/fin_panel');
	}
	public function nuevo()	
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		//Obtener todos los clientes
		$data['clientes'] = $this->M_Cliente->read_all();
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('contratos/nuevo');
		$this->load->view('template/fin_panel');
	}
	/*
	public function reparar()
	{
		$data = array();
		$data['contratos'] = $this->M_Contrato->read_all();
		//var_dump($data['contratos']->result());
		foreach ($data['contratos']->result() as $contrato){
			$fecha = $contrato->date_initial;
			$fecha = strtotime ( '+'.$contrato->division.' month', strtotime ( $fecha ) ) ;
            $fecha = date ( 'Y-m-j' , $fecha );
			$contract_fee = $contrato->division + 1;

			$cuota = $this->M_Contrato->getCuota($contrato->contract_id, $contrato->division);
			$cuota = $cuota->amount;
			$capital = $contrato->capital;
			$nueva_cuota = $cuota - $capital;

			$datos  = array('contract_id' 	=> $contrato->contract_id,
							'contract_fee' 	=> $contract_fee,
							'amount'		=> $contrato->capital,
							'payment_date'  => $fecha,
							'username_register'	=> $this->session->userdata('username')
							);
			
			$update = array('contract_id' 	=> $contrato->contract_id,
							'contract_fee'  => $contrato->division,
							'amount' 		=> $nueva_cuota
							);
			$this->M_Contrato->create_ultima($datos);
			$this->M_Contrato->actualiza_cuota($update);
			echo "Contrato nro " . $contrato->contract_id . " actualizado <br />";
		}
		echo "Todos los contratos fueron actualizados correctamente";
	}*/
	public function pagar()
	{

		$data = array(
						'contract_id' 	=> $this->input->post('contract_id'),
						'cuota'			=> $this->input->post('cuota')
			);
		$contrato = $this->M_Contrato->read($data['contract_id']);
		$cuota = $this->M_Contrato->getCuota($data['contract_id'], $data['cuota']);
		$saldo = $this->M_Cliente->saldo($cuota->customer_id);
		$data['customer_id'] = $cuota->customer_id;
		if($saldo->saldo > $cuota->amount){
			if($contrato->aprobado){

			}
			$data['nuevo_saldo'] = $saldo->saldo - $cuota->amount;
			//Actualizar estado de cuota
			$this->M_Contrato->pagar($data);
			//Restar saldo del cliente
			$this->M_Cliente->update_saldo($data);
			//var_dump($saldo);
			$this->session->set_flashdata('message', 'Cuota pagada correctamente, saldo del cliente actualizado');
		}else{
			$this->session->set_flashdata('message', 'El cliente no cuenta con saldo suficiente para hacer esta transacción');
		}
		
		redirect('contratos/ver/' . $data['contract_id']);
	}
	public function insertar(){
		$date_initial = new DateTime($this->input->post('date_initial'));
		$date_initial = $date_initial->format('Y-m-d');
		$customer_id = $this->input->post('customer_id');
		if($customer_id){
			$data = array(	
						'customer_id' 		=> $customer_id,
						'date_initial' 		=> $date_initial,
						'capital' 			=> $this->input->post('capital'),
						'percentage' 		=> $this->input->post('percentage'),
						'division'		 	=> $this->input->post('fraccionamiento'),
						'guarantee'			=> $this->input->post('guarantee'),
						'username_register'	=> $this->session->userdata('username')
					 );
			$contract_id = $this->M_Contrato->create($data);
			$this->M_Contrato->cuotas(	$contract_id, 
											$data['capital'], 
											$data['division'], 
											$data['percentage'], 
											$data['date_initial'], 
											$data['username_register']);
			$this->session->set_flashdata('message', 'Contrato ' . $contract_id . ' creado correctamente');
			redirect(base_url() . 'contratos/ver/' . $contract_id);
		}else{
			$this->session->set_flashdata('message', 'No hemos encontrado el ID del cliente, favor revisar los datos o comunicarse con el encargado del sistema');
			redirect('contratos/nuevo');
		}
	}
	public function ver($id)
	{
		if($id){
			$data = array();
			$data['username'] = $this->session->userdata('username');
			$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
			//Datos especificos
			$data['contrato'] = $this->M_Contrato->read($id);
			//Cuotas 
			$data['cuotas'] = $this->M_Contrato->getCuotas($id);
			//Clientes 
			$data['clientes'] = $this->M_Cliente->read_all();
			//Plantilla
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('contratos/V_ver');
			$this->load->view('template/fin_panel');
		}else{
			redirect('contratos');
		}
	}
	public function update_client(){
		$contract_id = $this->input->post('contract_id');
		$customer_id = $this->input->post('customer_id');
		//Leer el contrato a actualizar
		$contrato = $this->M_Contrato->read($contract_id);
		//Leer el nombre del cliente
		$cliente = $this->M_Cliente->read($customer_id);

		$data = array(
					  'contract_id' 		=> $contract_id, 
					  'customer_id' 		=> $customer_id, 
					  'customer_name' 		=> $cliente->customer_name,
					  'date_initial' 		=> $contrato->date_initial,
					  'capital'				=> $contrato->capital,
					  'percentage'			=> $contrato->percentage,
					  'division'			=> $contrato->division,
					  'guarantee'			=> $contrato->guarantee,
					  'date_register'		=> $contrato->date_register,
					  'event'				=> 'Actualizacion del cliente',
					  'username_register'	=> $contrato->username_register,
					  'username_update'		=> $this->session->userdata('username')
					 );
		//Insertar auditoria
		$this->M_Contrato->auditory($data);
		//Actualizar 
		$this->M_Contrato->actualizar_cliente($data);
		$this->session->set_flashdata('message', 'El cliente para este contrato fue actualizado correctamente');
		redirect('contratos/ver/'. $contract_id);
	}
	public function recalcular_cuotas(){
		$contract_id = $this->input->post('contract_id');
		$new_percentage = $this->input->post('new_percentage');
		//Leer el contrato a actualizar
		$contrato = $this->M_Contrato->read($contract_id);
		//Eliminiar todas las cuotas anteriores
		$this->M_Contrato->delete_details($contract_id);
		$data = array(
					  'contract_id' 		=> $contract_id, 
					  'customer_id' 		=> $contrato->customer_id, 
					  'customer_name' 		=> $contrato->customer_name,
					  'date_initial' 		=> $contrato->date_initial,
					  'capital'				=> $contrato->capital,
					  'percentage'			=> $new_percentage,
					  'division'			=> $contrato->division,
					  'guarantee'			=> $contrato->guarantee,
					  'date_register'		=> $contrato->date_register,
					  'event'				=> 'Las cuotas fueron recalculadas',
					  'username_register'	=> $contrato->username_register,
					  'username_update'		=> $this->session->userdata('username')
					 );
		//Insertar auditoria
		$this->M_Contrato->auditory($data);
		//Recalcular nuevas cuotas
		$this->M_Contrato->cuotas(	$contract_id, 
										$data['capital'], 
										$data['division'], 
										$data['percentage'], 
										$data['date_initial'], 
										$data['username_register']);
		//Mensaje para el usuario
		$this->session->set_flashdata('message', 'Las cuotas fueron recalculadas correctamente, por favor revise');
		redirect('contratos/ver/'. $contract_id);
	}
	public function amortizar(){
		$contract_id = $this->input->post('contract_id');
		$monto = $this->input->post('monto');
		//Leer el contrato a actualizar
		$contrato = $this->M_Contrato->read($contract_id);
		$data = array(
					  'contract_id' 		=> $contract_id, 
					  'customer_id' 		=> $contrato->customer_id, 
					  'customer_name' 		=> $contrato->customer_name,
					  'date_initial' 		=> $contrato->date_initial,
					  'capital'				=> $contrato->capital,
					  'amortizado'			=> $monto,
					  'percentage'			=> $new_percentage,
					  'division'			=> $contrato->division,
					  'guarantee'			=> $contrato->guarantee,
					  'date_register'		=> $contrato->date_register,
					  'event'				=> 'Las cuotas fueron recalculadas',
					  'username_register'	=> $contrato->username_register,
					  'username_update'		=> $this->session->userdata('username')
					 );
		//Insertar auditoria
		$this->M_Contrato->auditory($data);
		//Seleccionar saldo
		$saldo = $this->M_Cliente->saldo($contrato->customer_id);
		
		if($saldo->saldo > $contrato->capital){
			$data['nuevo_saldo'] = $saldo->saldo - $monto;
			//Actualizar estado de cuota
			$this->M_Contrato->amortizar($data);
			//Restar saldo del cliente
			$this->M_Cliente->update_saldo($data);
		}
		//Mensaje para el usuario
		$this->session->set_flashdata('message', 'Las cuotas fueron recalculadas correctamente, por favor revise');
		
	}
}
