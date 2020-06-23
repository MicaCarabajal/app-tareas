<?php
    include('database.php');

    $id = $_POST['id'];
    $query = "SELECT * FROM tareas WHERE id = $id"; //hacemos una consulta para guarde una id ue estamos recibiendo que estamos recibiendo a traves del metodo POST
    $result = mysqli_query($connection, $query);// lo ejecutamos y lo guardamos en la variable result
    if(!$result){ // si no hay un resultado
        die('Query ha fallado.');
    }
    $json = array();
    while($row = mysqli_fetch_array($result)){ //para covertir los datos en una fila
        $json[] = array( //convertimos los datos de la tabla en un JSON,  osea en un objeto
            'nombre' => $row['nombre'],
            'descripcion' => $row['descripcion'],
            'id' => $row['id']
        );
    }
    $jsonstring = json_encode($json[0]);//para convertir los datos en un string
    echo $jsonstring;//para enviar los datos al frontend
?>