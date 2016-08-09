<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();	
		$this->load->model('Usuarios_model');
	}
	public function index()
	{
		$data = array('title' => 'Login');
		if($this->session->userdata('logueado')){			
			redirect(base_url());		
		}else{
			$this->load->view('template/inicio', $data);
			$this->load->view('login');
			$this->load->view('template/fin');
		}
	}
	public function validar()
	{
		$password = md5($this->input->post('password'));
		$data = array(	
						'username' 	=> $this->input->post('username'), 
						'password' 	=> $password
					 );
		$ResultSet = $this->Usuarios_model->obtenerUsuario($data);
		if($ResultSet){
			$usuario_data = array(
               'id' => $ResultSet->user_id,
               'username' => $ResultSet->username,
               'logueado' => TRUE
            );
            $this->session->set_userdata($usuario_data);
            redirect('panel');
		}else{
			$this->session->set_flashdata('mensaje', 'Combinación erronea');
			redirect('login');
		}
	}
}