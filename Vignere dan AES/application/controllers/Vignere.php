<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vignere extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$hasil = '';
		$pswd = $this->input->post('password', true);
		$code = $this->input->post('text', true);
		$op = $this->input->post('op', true);

		$this->form_validation->set_rules('password', 'password', 'required|alpha_numeric');
		$this->form_validation->set_rules('text', 'text', 'required');
		$this->form_validation->set_rules('op', 'op', 'required');
		$hasil =  [
				    'error'   => true,
				    'password_error' => form_error('password'),
				    'text_error' => form_error('text'),
				    'op_error' => form_error('op')
				   ];

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('vignere');
		} else {
			if ($op == 'en')
			{
				$hasil = $this->encrypt($pswd, $code);
			}
				
			if ($op == 'de')
			{
				$hasil = $this->decrypt($pswd, $code);
			}
			echo $hasil;
		}
	}

	private function encrypt($pswd, $text)
	{
		// change key to lowercase for simplicity
		$pswd = strtolower($pswd);
		
		// intialize variables
		$code = "";
		$ki = 0;
		$kl = strlen($pswd);
		$length = strlen($text);
		
		// iterate over each line in text
		for ($i = 0; $i < $length; $i++)
		{
			// if the letter is alpha, encrypt it
			if (ctype_alpha($text[$i]))
			{
				// uppercase
				if (ctype_upper($text[$i]))
				{
					$text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("A")) % 26) + ord("A"));
				}
				
				// lowercase
				else
				{
					$text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("a")) % 26) + ord("a"));
				}
				
				// update the index of key
				$ki++;
				if ($ki >= $kl)
				{
					$ki = 0;
				}
			}
		}
		
		// return the encrypted code
		return $text;
	}

// function to decrypt the text given
	private function decrypt($pswd, $text)
	{
		// change key to lowercase for simplicity
		$pswd = strtolower($pswd);
		
		// intialize variables
		$code = "";
		$ki = 0;
		$kl = strlen($pswd);
		$length = strlen($text);
		
		// iterate over each line in text
		for ($i = 0; $i < $length; $i++)
		{
			// if the letter is alpha, decrypt it
			if (ctype_alpha($text[$i]))
			{
				// uppercase
				if (ctype_upper($text[$i]))
				{
					$x = (ord($text[$i]) - ord("A")) - (ord($pswd[$ki]) - ord("a"));
					
					if ($x < 0)
					{
						$x += 26;
					}
					
					$x = $x + ord("A");
					
					$text[$i] = chr($x);
				}
				
				// lowercase
				else
				{
					$x = (ord($text[$i]) - ord("a")) - (ord($pswd[$ki]) - ord("a"));
					
					if ($x < 0)
					{
						$x += 26;
					}
					
					$x = $x + ord("a");
					
					$text[$i] = chr($x);
				}
				
				// update the index of key
				$ki++;
				if ($ki >= $kl)
				{
					$ki = 0;
				}
			}
		}
		
		// return the decrypted text
		return $text;
	}
}
