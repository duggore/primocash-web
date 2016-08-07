<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Usuarios_model');
	}
	public function index()
	{
		$this->load->view('template/inicio');
		$this->load->view('home');
		$this->load->view('template/fin');
	}
}
