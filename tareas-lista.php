<?php
    include ('database.php');

    $query = "SELECT * from tareas";//consulta: esto me trae todos los datos de mi tabla tareas
    $result = mysqli_query($connection, $query);//para ejecutar la consulta

    if(!$result){
        die('Query ha fallado'. mysqli_error($connection));//mysqlii_error lo utilizamos para ver que error obtenemos
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){//una fila por cada dato que ontengo de la bbdd
        $json[] = array(//arreglo con objetos
            'nombre' => $row['nombre'],
            'descripcion' => $row['descripcion'],
            'id' => $row['id']
        );
    }
    $jsonstring = json_encode($json);//retorna los datos codificados
    echo $jsonstring;

?>