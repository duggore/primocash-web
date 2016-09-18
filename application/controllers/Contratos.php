<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logueado')){			
			redirect('login');
		}else{
			$this->load->model('Usuarios_model');
			$this->load->model('Contratos_model');
			$this->load->model('Clientes_model');
		}
	}
	public function index()
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		//Datos especificos
		$data['contratos'] = $this->Contratos_model->read_all();
		//Proximos contratos
		$data['proximos'] = $this->Contratos_model->proximos();
		//Plantilla
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('contratos/index');
		$this->load->view('template/fin_panel');
	}
	public function nuevo()	
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('contratos/nuevo');
		$this->load->view('template/fin_panel');
	}
	public function insertar(){
		$date_initial = new DateTime($this->input->post('date_initial'));
		$date_initial = $date_initial->format('Y-m-d');
		$customer_id = $this->input->post('customer_id');
		if($customer_id){
			$data = array(	
						'customer_id' 		=> $customer_id,
						'customer_name'		=> $this->input->post('customer_name'),
						'date_initial' 		=> $date_initial,
						'capital' 			=> $this->input->post('capital'),
						'percentage' 		=> $this->input->post('percentage'),
						'fraccionamiento' 	=> $this->input->post('fraccionamiento'),
						'guarantee'			=> $this->input->post('guarantee'),
						'username' 			=> $this->session->userdata('username')
					 );
			$this->session->set_flashdata('message', 'Contrato creado correctamente');
			$this->Contratos_model->create($data);
			redirect('contratos');
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
			$data['contrato'] = $this->Contratos_model->read($id);
			//Cuotas 
			$data['cuotas'] = $this->Contratos_model->cuotas($id);
			//Clientes 
			$data['clientes'] = $this->Clientes_model->read_all();
			//Plantilla
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('contratos/ver');
			$this->load->view('template/fin_panel');
		}else{
			redirect('contratos');
		}
	}
	public function update_client(){
		$contract_id = $this->input->post('contract_id');
		$customer_id = $this->input->post('customer_id');
		//Leer el contrato a actualizar
		$contrato = $this->Contratos_model->read($contract_id);
		//Leer el nombre del cliente
		$cliente = $this->Clientes_model->read($customer_id);

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
					  'username_register'	=> $contrato->username_register,
					  'username_update'		=> $this->session->userdata('username')
					 );
		//Insertar auditoria
		$this->Contratos_model->auditory($data);
		//Actualizar 
		$this->Contratos_model->update($data);
		$this->session->set_flashdata('message', 'El cliente para este contrato fue actualizado correctamente');
		redirect('contratos/ver/'. $contract_id);
	}
	public function recalcular_cuotas(){
		$contract_id = $this->input->post('contract_id');
		$new_percentage = $this->input->post('new_percentage');
		//Leer el contrato a actualizar
		$contrato = $this->Contratos_model->read($contract_id);
		//Eliminiar todas las cuotas anteriores
		$this->Contratos_model->delete_details($contract_id);
		$data = array(
					  'contract_id' 		=> $contract_id, 
					  'customer_id' 		=> $contrato->customer_id, 
					  'customer_name' 		=> $contrato->customer_name,
					  'date_initial' 		=> $contrato->date_initial,
					  'capital'				=> $contrato->capital,
					  'percentage'			=> $contrato->percentage,
					  'division'			=> $contrato->division,
					  'guarantee'			=> $contrato->guarantee,
					  'date_register'		=> $contrato->date_register,
					  'username_register'	=> $contrato->username_register,
					  'username_update'		=> $this->session->userdata('username')
					 );
		//Insertar auditoria
		$this->Contratos_model->auditory($data);
		//Mensaje para el usuario
		$this->session->set_flashdata('message', 'Las cuotas fueron recalculadas correctamente, por favor revise');
		redirect('contratos/ver/'. $contract_id);
	}
}
