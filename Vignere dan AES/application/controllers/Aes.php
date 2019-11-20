<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		$this->load->library('form_validation');
		$this->encryption->initialize(['cipher' => 'aes-256']);
	}

	public function index()
	{
		$code = $this->input->post('text', true);
		$op = $this->input->post('op', true);
		$this->form_validation->set_rules('text', 'text', 'required');
		$this->form_validation->set_rules('op', 'op', 'required');

		if ($this->form_validation->run() === FALSE) {
			return $this->load->view('aes');
		} else {
			if ($op == 'en') {
				echo $this->encryption->encrypt($code);
			} elseif ($op == 'de') {
				echo $this->encryption->decrypt($code);
			}
		}
	}
}
