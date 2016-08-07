<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Controller {

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logueado')){			
			redirect('login');
		}else{
			$this->load->model('Menus_model');
			$this->load->model('Usuarios_model');
		}
	}
	public function index()
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		$data['menus'] = $this->Menus_model->read_all();
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('menus/index');
		$this->load->view('template/fin_panel');
	}
	public function nuevo(){
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		$data['menus'] = $this->Menus_model->read_all();
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('menus/nuevo');
		$this->load->view('template/fin_panel');
	}
	public function insertar(){
		$data = array(	
						'username' 		=> $this->session->userdata('username'),
						'description' 	=> $this->input->post('description'), 
						'page' 			=> $this->input->post('page')
					 );
		$this->Menus_model->create($data);
		redirect('menus');
	}
	public function editar($id){
		if ($id) {
			$data = array();
			$data['username'] = $this->session->userdata('username');
			$data['menu'] = $this->Menus_model->read($id);
			$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('menus/editar');
			$this->load->view('template/fin_panel');
		}else{
			redirect('menus');
		}
	}
	public function update($id){

		$data = array(	
						'username' 		=> $this->session->userdata('username'),
						'description' 	=> $this->input->post('description'), 
						'page' 			=> $this->input->post('page')
					 );
		$this->Menus_model->update($id, $data);
		redirect('menus');
	}
	public function delete($id){
		$this->Menus_model->delete($id);
		$this->session->set_flashdata('mensaje', 'Menú eliminado correctamente');
		redirect('menus');
	}
}