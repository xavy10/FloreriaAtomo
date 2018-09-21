<?php
//Esta funcion es usada para recorrer todos los registros de 1 tabla
function Select_All_Records($table_name) {
    global $con;
    $sql = "select * from $table_name";
    try {
        $stmt = $con->query($sql);
        return $stmt;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

//Esta funcion es usada para recorrer los registro de 1 tabla aplicando 1 filtro.
function Select_Record_By_One_Filter($data, $table_name) {
    global $con;
    $key = array_keys($data);
    $value = array_values($data);
    $sql = "select * from $table_name where $key[0] = '$value[0]'";
    try {
        $stmt = $con->query($sql);
        return $stmt;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

//Esta funcion es usada para recorrer los registro de 1 tabla aplicando 2 filtros.
function Select_Record_By_Two_Filter($data, $table_name) {
    global $con;
    $key = array_keys($data);
    $value = array_values($data);
    $sql = "select * from $table_name where $key[0] = '$value[0]' AND $key[1] = '$value[1]'";
    try {
        $stmt = $con->query($sql);
        return $stmt;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

//Esta funcion es usada para obtener 1 registro de forma aleatoria.
function Select_One_Random_Record($table_name) {
    global $con;
    $sql = "SELECT * FROM $table_name ORDER BY RAND()  LIMIT 1";
    try {
        $stmt = $con->query($sql);
        return $stmt;
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
?>
