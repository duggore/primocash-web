<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

	function __construct(){
		parent::__construct();	
		$this->load->model('Registro_model');
		$this->load->model('Usuarios_model');
	}
	public function index()
	{
		redirect(base_url());
	}
	public function token($token)
	{
		if(empty($token)){ 
			redirect('login');
		}else{
			$data = array();
			$data['registro'] = $this->Registro_model->read($token);
			$confirm =  $data['registro']->confirm;
			if($confirm == 0){
				$this->load->view('confirmar-usuario', $data);
			}else{
				redirect('login');
			}
		}
	}
	public function crear($token)
	{
		$registro = $this->Registro_model->read($token);
		$password = md5($this->input->post('password'));
		$data = array(	
						'first_name' 	=> $registro->first_name,
						'username' 		=> $this->input->post('username'), 
						'password' 		=> $password,
						'email'			=> $registro->email,
					 );
		$usuario =	$this->Usuarios_model->getUserUsername($data);
		if(empty($usuario)){
			$this->Registro_model->create($data);
			$this->Registro_model->update($token);
			$ResultSet = $this->Usuarios_model->obtenerUsuario($data);
			if($ResultSet){
				$usuario_data = array(
	               'id' => $ResultSet->user_id,
	               'username' => $ResultSet->username,
	               'logueado' => TRUE
	            );
	            $this->session->set_userdata($usuario_data);
	            redirect(base_url().'panel');
			}else{
				redirect(base_url());	
			}
		}else{
			$this->session->set_flashdata('error', 'El nombre de usuario ya existe, favor de elegir otro');
			redirect('confirmar-usuario/'.$token);
		}
	}
}
