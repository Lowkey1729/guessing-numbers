<?php
class Bet
{
	public function get_bet_id($id)
	{
		global $db;
		$query = " SELECT * FROM bets WHERE id = :id";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->execute();
		$row = $result->fetch();

		$query = " SELECT id, name FROM possiblities WHERE bets_id = :id";
		$result = $db->prepare($query);
		$result->bindValue(':id', $id);
		$result->execute();
		$possibilities_ids_array = array();
		$possibilities_names_array = array();	
		$i = 0;

	}
}

class Crypt
{
	private $key;
	private $cipher;
	private $iv;
	private $mode;
	private $ivs;

	public function __construct()
	{
		$this->$key = hash(algo, data)
		$this->$cipher = 'MCRYPT_RIJNDAEL_256';
		$this->$ivs = mcrypt_get_iv_size($this->$cipher, $this->$mode);
		$this->mode =  'MCRYPT_MODE_CBC';
		$this->iv = mcrypt_create_iv($this->$ivs);  
	}

	public function encrypt($data)
	{
		$data = mcrypt_encrypt($this->$cipher, $this->$key, $data, $this->$mode, $this->$iv);
		$data = base64_encode($data);
		return $data;
	}

	public function decrypt($data)
	{
		$data = base64_decode($data);
		$data = mcrypt_decrypt($this->$cipher, $this->$key, $this->$data, $this->$mode, $this->iv);
		return $data;
	} 
}










?>