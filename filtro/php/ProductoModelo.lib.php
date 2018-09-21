<?
require_once("Modelo.lib.php");

class ProductoModelo extends Modelo{

	function __construct(){
		$this->db="floreria";
	}

	// function __destruct(){
	// 	unset($this);
	// }

	public function create($arr=array()){
		$this->qry="INSERT INTO producto VALUES(null,'".$arr["nombre"]."',".$arr["edad"].")";
		$this->set_query();
	}
	public function delete($id){
		$this->qry="DELETE FROM persona WHERE id=$id";
		$this->set_query();
	}
	public function update($id,$arr=array()){
		$this->qry="UPDATE  persona SET nombre='".$arr["nombre"]."',edad='".$arr["edad"]."' WHERE id=$id";
		$this->set_query();
	}
	public function sacarDatos($id){
    if ($id!="") {
        $this->query = "select * from producto where id_pro='".$id."'";
        $this->get_query();
        //var_dump($this->rows);
        return $this->rows;
      } else {
        $this->query = "select * from producto";
        $this->get_query();
        //var_dump($this->rows);
        return $this->rows;
      }
	}
	public function sacarCatalogo($nombre) {
    $this->query = "select * from producto pro join presentacion pre on pro.id_pre=pre.id_pre where nombre_pre='".$nombre."'";
    $this->get_query();
    //var_dump($this->rows);
    return $this->rows;
  }
  public function sacarFlores() {
    $this->query = "select * from flor order by nombre_flo asc";
    $this->get_query();
    //var_dump($this->rows);
    return $this->rows;
  }
	public function sacarFloresFiltro($presen) {
    $this->query = "select nombre_flo from flor f join producto pro on f.id_flo=pro.id_flo join presentacion pre on pre.id_pre=pro.id_pre where nombre_pre='".$presen."' group by nombre_flo";
    $this->get_query();
    //var_dump($this->rows);
    return $this->rows;
  }
  public function sacarPresentacion() {
    $this->query = "select nombre_pre from presentacion order by nombre_pre asc";
    $this->get_query();
    return $this->rows;
  }

	public function sacarPresentaciones() {
    $this->query = "select * from presentacion pre join producto pro on pre.id_pre=pro.id_pre group by nombre_pre";
    $this->get_query();
    return $this->rows;
  }

  ///////////////////////////MI CODIGO .//////////////////////////////////

  public function filtrarProductos($flor,$presentacion,$precio){
    $sentencia = "select *from producto join presentacion on producto.id_pre = presentacion.id_pre join flor on producto.id_flo = flor.id_flo where nombre_pre like '%".$presentacion."%' and nombre_flo like '%".$flor."%' ";
    if($precio!= 0){
        $sentencia .= "and precio_pro <= ".$precio;
    }
    $this->query = $sentencia;
    $this->get_query();
    return $this->rows;
  }


}

?>
