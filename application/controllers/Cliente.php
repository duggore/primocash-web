<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logueado')){			
			redirect('login');
		}else{
			$this->load->model('Usuarios_model');
			$this->load->model('M_Cliente');
			$this->load->model('M_Contrato');
		}
	}
	public function index()
	{
		//Data necesaria
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		//Lista de clientes
		$data['clientes'] = $this->M_Cliente->read_all();
		//Cargando vistas
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('cliente/V_index');
		$this->load->view('template/fin_panel');
	}
	public function ver($customer_id){
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		//Datos del cliente
		$data['cliente'] = $this->M_Cliente->read($customer_id);
		//Contratos del cliente
		$data['contratos'] = $this->M_Contrato->getContractClient($customer_id);
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('cliente/V_ver');
		$this->load->view('template/fin_panel');
	}
	public function comprobante($customer_id){
		//Data necesaria
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		//Algunas variables
		$data['customer_id'] = $customer_id;
		//Cargando vistas
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('comprobante/V_nuevo');
		$this->load->view('template/fin_panel');
	}
	public function recargar(){
		$data = array(
						'customer_id' 	=> $this->input->post('customer_id'),
						'monto'			=> $this->input->post('monto') 
				);
		//$this->M_Cliente->recargar($data);
		$this->session->set_flashdata('message', 'Saldo asignado correctamente');
		redirect('cliente/ver/' . $data['customer_id']);
	}
	public function delete($id){
		if ($id) {
			//Obtener el ultimo estado del cliente
			$customer = $this->M_Cliente->read($id);
			$data = array(
							'id' 			=> $id,
							'document' 		=> $customer->customer_document,
							'name' 			=> $customer->customer_name,
							'email' 		=> $customer->customer_email,
							'address' 		=> $customer->customer_address,
							'phone' 		=> $customer->customer_phone,
							'date_register'	=> $customer->date_register,
							'event'			=> 'Eliminación del cliente',
							'username' 	=> $this->session->userdata('username')
			            );
			//Insertar el cambio en la auditoria
			$this->M_Cliente->auditory($data);
			//Borrar cliente
			$this->M_Cliente->delete($id);
			$this->session->set_flashdata('message', 'El cliente fue eliminado correctamente');
			redirect('clientes');
		}else{
			redirect('clientes');
		}
	}
	public function nuevo(){
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('clientes/nuevo');
		$this->load->view('template/fin_panel');
	}
	public function insertar(){
		$phone = $this->input->post('phone');
		$validate = $this->M_Cliente->read_phone($phone);
		if($validate->customer_phone == $phone)
		{
			//Seteo de mensaje para el usuario
			$this->session->set_flashdata('message', 'Este numero de Celular ya se encuentra registrado en otro cliente');
			redirect('clientes/nuevo');
		}else{
			$data = array(	
						'document' 	=> $this->input->post('document'),
						'name' 		=> $this->input->post('name'),
						'email' 	=> $this->input->post('email'),
						'address' 	=> $this->input->post('address'),
						'phone' 	=> $phone,
						'username' 	=> $this->session->userdata('username')
					 );
			$this->session->set_flashdata('message', 'Cliente creado correctamente');
			$this->M_Cliente->create($data);
		}
		redirect('clientes');
	}
	public function editar($id){
		if ($id) {
			$data = array();
			$data['username'] = $this->session->userdata('username');
			$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
			$data['cliente'] = $this->M_Cliente->read($id);
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('clientes/editar');
			$this->load->view('template/fin_panel');
		}else{
			redirect('clientes');
		}
	}
	public function update($id){
		$phone = $this->input->post('phone');
		if($id){
			$customer = $this->M_Cliente->read($id);
			if($customer){
				$validate = $this->M_Cliente->read_phone($phone);
				if($validate->customer_phone == $phone)
				{
					//Seteo de mensaje para el usuario
					$this->session->set_flashdata('message', 'Este numero de Celular ya se encuentra registrado en otro cliente');
					redirect('clientes/editar/'.$id);
				}else{
					$data = array(
							'id' 			=> $id,
							'document' 		=> $this->input->post('document'),
							'name' 			=> $this->input->post('name'),
							'email' 		=> $this->input->post('email'),
							'address' 		=> $this->input->post('address'),
							'phone' 		=> $phone,
							'date_register'	=> $customer->date_register,
							'event'			=> 'Actualizacion de datos del cliente',
							'username' 	=> $this->session->userdata('username')
			            );
					//Insertar el cambio en la auditoria
					$this->M_Cliente->auditory($data);
					//Actualizar dartos del cliente
					$this->M_Cliente->update($data);
					//Seteo de mensaje para el usuario
					$this->session->set_flashdata('message', 'El cliente fué actualizado correctamente');
					redirect('clientes/editar/'.$id);
				}
			}else{
				//Seteo de mensaje para el usuario
				$this->session->set_flashdata('message', 'Algo raro pasó, no he podido encontrar este cliente');
				redirect('clientes/editar/'.$id);
			}
		}else{
			//Seteo de mensaje para el usuario
			$this->session->set_flashdata('message', 'Algo raro pasó, no he podido encontrar este cliente');
			redirect('clientes/editar/'.$id);
		}
	}
}