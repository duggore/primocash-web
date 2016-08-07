<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Usuarios_model');
	}
	public function index()
	{
		if($this->session->userdata('logueado')){	
			$data = array();
			$data['username'] = $this->session->userdata('username');
			$user_id = $this->session->userdata('id');
			$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($user_id);
			$user = $this->Usuarios_model->read($user_id);		
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('home');
			$this->load->view('template/fin_panel');
		}else{
			$this->load->view('template/inicio');
			$this->load->view('home');
			$this->load->view('template/fin');
		}
	}
}
