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
			redirect('panel');
		}else{
			redirect('login');
		}
	}
	public function cerrar_sesion()
	{
		$usuario_data = array(
         'logueado' => FALSE
		);
		$this->session->set_userdata($usuario_data);
		redirect(base_url());
	}
}
