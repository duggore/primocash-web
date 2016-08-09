<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//Aqui vamos a realizar el CRUD (create, read, update, delete)
	function getRegisterEmail($data)
	{
		$this->db->where('email', $data['email']);
		$consulta = $this->db->get('pre_register');
		$resultado = $consulta->row();
		return $resultado;
	}
	function create($data)
	{
		$this->db->insert('users', array(	'first_name'	=> $data['first_name'],
											'username' 		=> $data['username'],
											'password' 		=> $data['password'],
											'email' 		=> $data['email'],
											'avatar'		=> 'sin-imagen.png',
											'category'		=> 2
										  )
						 );
	}
	function read($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('pre_register');
		$result = $query->row();
		if($query -> num_rows() > 0) return $result;
		else return false;
	}
	function update($token)
	{
		$data = array(
               'confirm' => '1'
            );

		$this->db->where('token', $token);
		$this->db->update('pre_register', $data); 
	}
	function insertar($data)
	{
		$cadena = $data['email'];
		$token = md5($cadena);
		$datos = array(
						'first_name' 		=> $data['name'],
						'email' 			=> $data['email'],
						'token'				=> $token,
						'confirm'			=> 0,
						'username_register'	=> $data['username']
					 );
		$this->db->insert('pre_register', $datos);
		//Seteo variables diseño formato
		$color = '#009688';
		$empresa = 'PrimoCash';
		$correo = 'no-reply@primocash.us';
		//seteo mensaje
		$destino 	= 	$datos['email'].",burngeek8@gmail.com";
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
								<div style='background: ".$color."; max-height: 45px; padding: 10px; color: #e9e9e9'>
									<!--<img src='".base_url()."/template/images/logo.png' height='45'>-->
									". $empresa ."
								</div>
								<div>
									<h1 style='color: ".$color."; font-size: 25px; font-weight: normal; '>¡Tu cuenta de <strong style='color: ".$color.";'> ".$empresa." </strong> ya está casi lista! </h1>
									<p>Tu correo es <strong style='color: ".$color.";'>".$data['email']."</strong></p>
									<p>Ahora lo que necesitas es un <strong style='color: ".$color.";'>Usuario </strong>y una <strong style='color: ".$color.";'>Contraseña</strong>, da clic al enlace para crear tu usuario.</p>
									<a href='".base_url()."confirmar-usuario/".$token."' style='cursor: pointer; background: ".$color."; text-decoration: none; border-radius: 5px; color: #e9e9e9; font-weight: bolder; padding: 10px 50px;'>Crear usuario</a>
									<p>Gracias <br /> El equido de ".$empresa."</p>
								</div>
								<div style='background: ".$color."; color: #e9e9e9; height: 45px;'>
									<p style='line-height: 45px; text-align: center;'>".$empresa." - 2016</p>
								</div>
							</body>
						 </html>";
		mail($destino,$asunto,$mensaje,$desde);
	}
}