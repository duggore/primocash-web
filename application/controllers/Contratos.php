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
		}
	}
	public function index()
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		//Datos especificos
		$data['contratos'] = $this->Contratos_model->read_all();
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
		$data = array(	
					'customer_id' 		=> $this->input->post('customer_id'),
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
	}
	public function ver($id)
	{
		if($id){
			$data = array();
			$data['username'] = $this->session->userdata('username');
			$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
			//Datos especificos
			$data['contrato'] = $this->Contratos_model->read($id);
			//Plantilla
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('contratos/ver');
			$this->load->view('template/fin_panel');
		}else{
			redirect('clientes');
		}
	}
}
