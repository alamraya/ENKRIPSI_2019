<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Predis\Client;
class Redis_Model extends CI_Model {

	public $redis;

	function __construct()
	{
		require_once 'vendor/autoload.php';
		try {
			$param = [
						[
							'host' => '192.168.10.3',
							'port' => 6379,
							// 'database' => 15,
							'alias' => 'master'
						],
						[
							'host' => '192.168.10.4',
							'port' => 6379,
							// 'database' => 15,
							'alias' => 'slave'
						],
						[
							'host' => '192.168.10.5',
							'port' => 6379,
							// 'database' => 15,
							'alias' => 'master'
						]
					];
			$op = ['replication' => true];
			$this->redis = new Client($param, $op);
		} catch (Exception $e) {
			die ($e->getMessage());
		}
	}

	public function get($data)
	{
		return $this->redis->get($data);
	}

	public function getAll()
	{
		return $this->redis->keys("*");
	}

}
