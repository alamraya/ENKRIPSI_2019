<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cipher extends CI_Controller
{

    public function stream()
    {
        $this->load->library('encryption');
        $this->encryption->initialize([
            'cipher' => 'rc4',
            'mode' => 'stream'
        ]);
        $data = 'Ihsan Fawzan';
        echo base64_decode($this->encryption->encrypt($data));
    }

    public function block()
    {
        $this->load->library('encryption');
        $this->encryption->initialize([
            'cipher' => 'aes-128',
            'mode' => 'cbc'
        ]);
        $data = 'Ihsan Fawzan';
        echo base64_decode($this->encryption->encrypt($data));
    }
}
