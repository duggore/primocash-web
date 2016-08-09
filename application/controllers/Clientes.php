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
	public function cuentas($id, $accion = '')
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		$data['cliente'] = $this->Clientes_model->read($id);
		if($accion == '')
		{
			//Listado de cuentas
			$data['cuentas'] = $this->Clientes_model->read_accounts($id);
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('clientes/cuentas/listar');
			$this->load->view('template/fin_panel');
		}elseif ($accion == 'nuevo') {
			//Formulario de crear nueva cuenta
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('clientes/cuentas/nuevo');
			$this->load->view('template/fin_panel');	
		}elseif($accion == 'insertar'){
			//Insertar la cuenta nueva
			$data = array(	
						'currency' 		=> $this->input->post('currency'), 
						'customer_id' 	=> $id,
						'username' 		=> $this->session->userdata('username')
					 	);
			$this->Clientes_model->create_account($data);
			redirect('clientes/cuentas/'. $id);
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
						'name' 		=> $this->input->post('name'), 
						'email' 	=> $this->input->post('email'),
						'username' 	=> $this->session->userdata('username'),
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
		if($id){
			$data = array(
					'id' 		=> $id,
					'document' 	=> $this->input->post('document'),
					'name' 		=> $this->input->post('name'),
					'email' 	=> $this->input->post('email'),
					'address' 	=> $this->input->post('address'),
					'phone' 	=> $this->input->post('phone'),
					'guarantee' => $this->input->post('guarantee')
	            );
			$this->Clientes_model->update($data);
		}else{
			redirect('clientes');
		}
	}
}