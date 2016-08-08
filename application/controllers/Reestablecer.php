<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reestablecer extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Usuarios_model');
	}
	public function index()
	{
		$data = array('title' => 'Reestablecer contraseña');
		$this->load->view('template/inicio', $data);
        $this->load->view('reestablecer/index');
		$this->load->view('template/fin');
	}
	public function validar()
	{
		$data = array(	
						'email' 	=> $this->input->post('email')
					 );
		$user = $this->Usuarios_model->getUserEmail($data);
		$data['first_name'] = $user->first_name;
		//creacion del token
		$now = date('YmdHms'); 
		$data['token'] = md5($now);
		if($user)
		{
			$this->Usuarios_model->reestablecer($data);
			$this->session->set_flashdata('mensaje', 'Gracias por comunicarte con nosotros, revisa tu bandeja de entrada y sigue el enlace para reestablecer tu contraseña');
			redirect('/');
		}else{
			$this->session->set_flashdata('mensaje', 'Lo sentimos, no tenemos este correo registrado como usuario');
			redirect('reestablecer');
		}
	}
	public function password($token){
		$data = array('title' => 'Reestablecer contraseña');
		$request = $this->Usuarios_model->getReestablecerToken($token);
		$data['email'] = $request->email;
		$data['token'] = $token;
		$user = $this->Usuarios_model->getUserEmail($data);
		$data['first_name'] = $user->first_name;
		$this->load->view('template/inicio', $data);
        $this->load->view('reestablecer/nuevopass');
		$this->load->view('template/fin');
	}	
	public function update()
	{
		$password = md5($this->input->post('password'));
		$token = $this->input->post('token');
		$request = $this->Usuarios_model->getReestablecerToken($token);
		$data = array(	
						'token' 	=> $token,
						'password' 	=> $password,
						'email'		=> $request->email
					 );
		$user = $this->Usuarios_model->getUserEmail($data);
		$data['user_id'] = $user->user_id;
		$data['username'] = $user->username;
		$data['first_name'] = $user->first_name;
		$data['date_register'] = $user->date_register;
		$data['category'] = $user->category;
		$data['avatar'] = $user->avatar;
		$data['event'] = 'Cambio de contraseña a travez de la opcion reestablecer contraseña';
		$data['username_update'] = $user->username;
		//Confirmar el cambio de contraseña 
		$this->Usuarios_model->confirmRequest($data);
		//Insertar el cambio en la auditoria
		$this->Usuarios_model->auditory($data);
		//Actualizar contraseña en la tabla de usuarios
		$this->Usuarios_model->updatePass($data);
		//Seteo del mensaje para el usuario
		$this->session->set_flashdata('mensaje', 'Tu contraseña ha sido cambiada correctamente');
		redirect(base_url().'login');
	}	
}
