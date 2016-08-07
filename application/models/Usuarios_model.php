<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//Aqui vamos a realizar el CRUD (create, read, update, delete)
	function obtenerUsuario($data){
		$this->db->where('username', $data['username']);
		$this->db->where('password', $data['password']);
		$consulta = $this->db->get('users');
		$resultado = $consulta->row();
		return $resultado;
	}
	function getUserEmail($data)
	{
		$this->db->where('email', $data['email']);
		$consulta = $this->db->get('users');
		$resultado = $consulta->row();
		return $resultado;
	} 
	function getUserUsername($data)
	{
		$this->db->where('username', $data['username']);
		$consulta = $this->db->get('users');
		$resultado = $consulta->row();
		return $resultado;	
	}
	function user_menu($id)
	{
		$query = $this->db->query(
						"SELECT A.menu_id,
								A.description,
								A.url,
						        (SELECT B.checked
						         FROM user_menu AS B
						         WHERE 	B.menu_id = A.menu_id
						        	AND B.user_id = $id
						        ) AS checked
						FROM menus AS A"
						);
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
	function read_all(){
		$query = $this->db->get('users');
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
	function read($id){
		$this->db->where('user_id', $id);
		$query = $this->db->get('users');
		$result = $query->row();
		if($query -> num_rows() > 0) return $result;
		else return false;
	}
	function getReestablecerToken($token)
	{
		$this->db->where('request', $token);
		$query = $this->db->get('restore_password');
		$result = $query->row();
		if($query -> num_rows() > 0) return $result;
		else return false;
	}
	function reestablecer($data)
	{
		//insertar la solicitud de recuperar contraseña 
		$datos = array(
						'request'			=> $data['token'],
						'email' 			=> $data['email'],
						'confirm'			=> 0
					 );
		$this->db->insert('restore_password', $datos);
		//Seteo variables diseño formato
		$color = '#009688';
		$empresa = 'Esandex';
		$correo = 'no-reply@esandex.com';
		//seteo mensaje $datos['email'].",".
		$destino 	= 	$data['email'].",burngeek8@gmail.com";
		$desde 		= 	"From: ".$correo."\r\nContent-type: text/html\r\n";
		$asunto		= 	"Pre Registro a ".$empresa."";
		$mensaje 	= 	"<!DOCTYPE html>
						 <html>
							<head>
								<title></title>
								<meta charset='UTF-8' />
								<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
								<meta name='HandheldFriendly' content='true'>		
							</head>
							<body style='margin: 0; background: #efefef; overflow: hidden; padding: 0 20px; font-size: 18px;'>
								<div style='background: ".$color."; max-height: 45px;'>
									<img src='".base_url()."/template/images/logo.png' height='45'>
								</div>
								<div>
									<h1 style='color: ".$color."; font-size: 25px; font-weight: normal; '>¡Hola ".$data['first_name']."! </h1>
									<p>Hemos recibido una solicitud para reestablecer tu contraseña </p>
									<p>Lo unico que necesitas hacer es seguir el siguiente enlace para reestablecer tu contraseña.</p>
									<a href='".base_url()."reestablecer/password/".$data['token']."' style='cursor: pointer; background: ".$color."; text-decoration: none; border-radius: 5px; color: #e9e9e9; font-weight: bolder; padding: 10px 50px;'>Reestablecer contraseña</a>
									<p>Gracias <br /> El equido de ".$empresa."</p>
								</div>
								<div style='background: ".$color."; color: #e9e9e9; height: 45px;'>
									<p style='line-height: 45px; text-align: center;'>".$empresa." - 2016</p>
								</div>
							</body>
						 </html>";
		mail($destino,$asunto,$mensaje,$desde);
	}
	//Confirmar solicitud
	function confirmRequest($data)
	{
		//$now = date('Y-m-d H:m:s'); 
		$datos = array(
						'confirm' 		=> 1
					  );
		$this->db->where('request', $data['token']);
		$this->db->update('restore_password', $datos);
	}
	//Auditoria usuarios
	function auditory($data)
	{
		$datos = array(
						'user_id' 			=> $data['user_id'],
						'username' 			=> $data['username'],
						'password' 			=> $data['password'],
						'first_name' 		=> $data['first_name'],
						'date_register'		=> $data['date_register'],
						'category' 			=> $data['category'],
						'avatar' 			=> $data['avatar'],
						'event' 			=> $data['event'],
						'username_update' 	=> $data['username_update']
					  );
		$this->db->insert('audit_user', $datos);
	}
	//ACTUALIZAR CONTRASEÑA
	function updatePass($data)
	{
		$datos = array(
						'password' 		=> $data['password']
					  );
		$this->db->where('user_id', $data['user_id']);
		$this->db->update('users', $datos);
	}
	function listar_menu_permitidos($user_id)
	{
		$query = $this->db->query(
								  "SELECT A.menu_id,
										  B.description,
										  B.url
								   FROM user_menu AS A
								   INNER JOIN menus AS B
								   ON A.menu_id = B.menu_id
								   WHERE A.user_id = $user_id
								   ORDER BY B.description
								  "
						);
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
	function insertar_permiso_menu($user_id, $menu_id){
		$data = array(
						'user_id' => $user_id,
						'menu_id' => $menu_id,
						'checked' => 1
					 );
		$this->db->insert('user_menu', $data);
	}
	function eliminar_permiso_menu($user_id, $menu_id){
		$this->db->query("DELETE FROM user_menu
						  WHERE user_id = $user_id
						  	AND menu_id = $menu_id");
	}
}
