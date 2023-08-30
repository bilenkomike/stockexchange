<?php 



// use PDO;

class Db {
	private static $_instance = null;
	private $_pdo,
			$_query,
			$_error = false,
			$_results,
			$_count = 0;

	private function __construct() {
		try {
			$this->_pdo = new PDO('mysql:host='. Config::get('mysql/host') .';dbname='. Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
			}
		catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance() {
		if (!isset(self::$_instance)) {
			self::$_instance = new Db();
		}
		return self::$_instance;
	}

	public function query($sql, $params = array()) {
		$this->_error = false;

		if($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if(count($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}

			if($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}
			else {
				$this->_error = true;
			}
		}

		return $this;

	}

	public function action($action, $table, $where = array(), $limits = array()){
		if (!empty($limits)) {
			if(!empty($where)) {
				$operators = array('=', '>', '<', '<=', '>=');
				$field 		= $where[0];
				$operator 	= $where[1];
				$value		= $where[2];

				if(in_array($operator, $operators)) {
					$sql = "{$action} FROM {$table}  WHERE {$field} {$operator} ? ORDER BY id asc LIMIT {$limits[0]}, {$limits[1]}";
					
					if(!$this->query($sql, array($value))->error()) {
						return $this;
					}

				}
			}
			else {
				$sql = "{$action} FROM {$table} ORDER BY id desc LIMIT {$limits[0]}, {$limits[1]}";



				if(!$this->query($sql)->error()) {
					return $this;
				}	
			}
			

			

			}

		else if(count($where) === 3) {
			$operators = array('=', '>', '<', '<=', '>=');

			$field 		= $where[0];
			$operator 	= $where[1];
			$value		= $where[2];


			if(in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}

			}
		}
		else if(empty($where)) {
			$sql = "{$action} FROM {$table}";
			if(!$this->query($sql)->error()) {
					return $this;
			}
		}

		return false;
	}
	
	public function get($table, $where = array()) {
		return $this->action('SELECT *', $table, $where);
	}

	public function getlike($table, $where = array(), $like = '') {
		if(!empty($where) && !empty($like)) {
			$field = $where[0];
			$sql = "SELECT * FROM {$table} WHERE {$field} LIKE '%{$like}%'";
			if(!$this->query($sql)->error()) {
				return $this;	
			}
			else {
				return 'error';
			}
			
		}
	}

	public function getsort($table, $where = array(), $sort = "DESC", $orderBy='id' , $limit=array()) {
		if(!empty($where)) {
			$operators = array('=', '>', '<', '<=', '>=');
			$field 		= $where[0];
			$operator 	= $where[1];
			$value		= $where[2];
			if(in_array($operator, $operators)) {
				$sql = "SELECT * FROM {$table} WHERE {$field} {$operator} {$value} ORDER BY id {$sort}";
				if(!$this->query($sql)->error()) {
					return $this;	
				}
				else {
					return 'error';
				}
			}
		}
		else if ( !empty($limit) ) {
			$sql = "SELECT * FROM {$table} ORDER BY {$orderBy} {$sort} LIMIT {$limit[0]}, {$limit[1]}";
			if(!$this->query($sql)->error()) {
				return $this;	
			}
			else {
				return 'error';
			}
		}
		else {
			$sql = "SELECT * FROM {$table} ORDER BY id {$sort}";
			// return $sql;
			if(!$this->query($sql)->error()) {
				return $this;	
			}
			else {
				return 'error';
			}
		}
	}

	public function getOrderedLimited($table, $where = array(), $limits = array()) {

		return $this->action('SELECT *', $table, $where, $limits);

	}

	public function delete($table, $where) {
		return $this->action('DELETE', $table, $where);
	}

	public function insert($table, $fields = array()){
		$keys = array_keys($fields);
		$values = '';
		$x = 1;

		foreach($fields as $field){
			$values .= "?";
			if($x < count($fields)) {
				$values .= ', ';
			}
			$x++;
		}

		$sql = "INSERT INTO `{$table}` (`". implode('`, `' ,$keys) ."`) VALUES ({$values})";
		
		if(!$this->query($sql, $fields)->error()) {
			return true;
		}
		
		return false;
	}

	public function update($table, $id, $fields) {
		$set = '';
		$x = 1;

		foreach($fields as $name => $values) {
			$set .= "{$name} = ?";
			if($x < count($fields)) {
				$set .= ', ';
			}
			$x++;
		}
		
		$sql = "UPDATE `{$table}` SET {$set} WHERE id = {$id}";

		if($this->query($sql, $fields)->error()) {
			return true;
		}

		return false;
	}

	public function results() {
		return $this->_results;
	}

	public function first(){
		return $this->results()[0];
	}

	public function error() {
		return $this->_error;
	}

	public function count(){
		return $this->_count;
	}

	public function countRows($table, $where = array()) {
		if(!empty($where)) {
			$operators = array('=', '>', '<', '<=', '>=');
			$field 		= $where[0];
			$operator 	= $where[1];
			$value		= $where[2];

			if(in_array($operator, $operators)) {
				$sql = "SELECT COUNT(id) as count FROM {$table}  WHERE {$field} {$operator} ?";
				
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}

			}
		}
		else {
			$sql = "SELECT COUNT(id) as count FROM {$table}";
				
			if(!$this->query($sql, array($value))->error()) {
				return $this;
			}
		}
	}

	public function getLastRecord($table, $where = array(), $data='id') {
		if(!empty($where)) {
			$operators = array('=', '>', '<', '<=', '>=');
			$field 		= $where[0];
			$operator 	= $where[1];
			$value		= $where[2];

			if(in_array($operator, $operators)) {
				$sql = "SELECT {$data} FROM {$table}  WHERE {$field} {$operator} ? ORDER BY id DESC LIMIT 1 ";
				
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}

			}
		}
		else {
			$sql = "SELECT id FROM {$table} ORDER BY id DESC LIMIT 1";
				
			if(!$this->query($sql)->error()) {
				return $this;
			}
		}
	}



	public function mail_find_users($input, $col) {
		if(!empty($input)) {
			$sql = "SELECT * FROM users  WHERE {$col} LIKE '%{$input}%'";
			if(!$this->query($sql)->error()) {
				return $this->results($this->query($sql, array($input)));
			}
			else {
				return 'error';
			}

		}
	}
	public function getmail_to_users($users) {
		$users_out = [];
		// if(!empty($input)) {
		$i = 1;
		foreach($users as $user) {
			if($user != '') {
				$users_out[$i] = $this->first($this->get('users',array('email','=',$user)))->id;
				$i++;
			}
			else {
				continue;
			}
		}

		return $users_out;
	}

	public function getdesc($table) {
		$sql = "SELECT * FROM {$table} ORDER BY id DESC";
		
		if(!$this->query($sql)->error()) {
			return $this;
		}
	}

	public function getlikedesc($table, $like = array()) {
		
			$operators = array('=', '>', '<', '<=', '>=');
			$field 		= $where[0];
			$operator 	= $where[1];
			$value		= $where[2];

			$sql = "SELECT * FROM {$table} WHERE {$like[0]} LIKE '%{$like[1]}%' ORDER BY id DESC";
			
			if(!$this->query($sql)->error()) {
				return $this->results($this->query($sql, array($input)));
			}
			else {
				return 'error';
			}

		
	}

}