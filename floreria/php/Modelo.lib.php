<?

abstract class Modelo{

	//private  $host="localhost";
	private  $host="192.168.0.30";
	private  $user="floreria";
	private  $pass="1234";

	protected $db;
	protected $rows=array();
	private $conn;
	protected $query;

	private function abrir(){
		$this->conn=new mysqli($this->host,$this->user,$this->pass,$this->db);
		//$this->conn=new mysqli("localhost","root","root","web3");

	}

	private function cerrar(){
		$this->conn->close();
	}

	protected function set_query(){
		$this->db_open();
		$this->conn->query($this->query);
		$this->db_close();
	}
	protected function get_query(){
	  $this->abrir();
      $resul = $this->conn->query($this->query);
      while ($this->rows[]=$resul->fetch_array(MYSQLI_ASSOC));
      $resul->close();
      $this->cerrar();
      return array_pop($this->rows);
	}
	abstract protected function create();
	abstract protected function delete($id);
	abstract protected function update($id);
	abstract protected function sacarDatos($id);
}


?>
