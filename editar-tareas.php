<?php
    include('database.php');

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    
    $query = "UPDATE tareas SET nombre = '$nombre', descripcion = '$descripcion' WHERE 
    id = '$id'";// con esta consulta le estammos diciendo actualiza la tarea en donde el id coincida con lo que el frontend me está enviando y luego actualiza el nombre y la descripcion

    $result = mysqli_query($connection, $query);//para que ejecute la consulta y lo almacenamos en la variable result

    if(!$result){
        die('Query ha fallado');
    }
    echo "Tarea actualizada satisfactoriamente";

?>