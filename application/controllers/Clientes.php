<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logueado')){			
			redirect('login');
		}else{
			$this->load->model('Usuarios_model');
			$this->load->model('Clientes_model');
		}
	}
	public function index()
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		$data['clientes'] = $this->Clientes_model->read_all();
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('clientes/index');
		$this->load->view('template/fin_panel');
	}
	public function delete($id){
		if ($id) {
			//Obtener el ultimo estado del cliente
			$customer = $this->Clientes_model->read($id);
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
			$this->Clientes_model->auditory($data);
			//Borrar cliente
			$this->Clientes_model->delete($id);
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
		$data = array(	
						'document' 	=> $this->input->post('document'),
						'name' 		=> $this->input->post('name'),
						'email' 	=> $this->input->post('email'),
						'address' 	=> $this->input->post('address'),
						'phone' 	=> $this->input->post('phone'),
						'username' 	=> $this->session->userdata('username')
					 );
		$this->Clientes_model->create($data);
		redirect('clientes');
	}
	public function editar($id){
		if ($id) {
			$data = array();
			$data['username'] = $this->session->userdata('username');
			$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
			$data['cliente'] = $this->Clientes_model->read($id);
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
			$customer = $this->Clientes_model->read($id);
			if($customer){
				$validate = $this->Clientes_model->read_phone($phone);
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
					$this->Clientes_model->auditory($data);
					//Actualizar dartos del cliente
					$this->Clientes_model->update($data);
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