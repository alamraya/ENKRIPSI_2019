<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		// $this->db->select('*');
		// $this->db->from('bio');
		// print_r($this->db->get()->result_array());
		return $this->load->view('db');

	}

	public function get_data()
	{
		header('Content-Type: application/json');
		$this->datatables->select('nama');
		$this->datatables->select('alamat');
        $this->datatables->from('bio');
        // $this->datatables->add_column('Edit', '<button class="btn btn-primary btn-sm btn-block edit_data" id="$1">Edit</button>', 'nomor');
		echo $this->datatables->generate();
	}

	public function add()
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat')
		];
		return $this->db->insert('bio', $data) ? true : false;
	}
}
