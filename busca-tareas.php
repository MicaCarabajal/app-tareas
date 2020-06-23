<?php
    include('database.php');

    $search = $_POST['search'];

    if(!empty($search)){
        $query = "SELECT * FROM tareas WHERE nombre LIKE '$search%'";//Hacemos una consulta, en la que selecccione todos los datos de la tabla tareas y en donde el nombre de la tarea coincida con lo que estamos recibiendo (le ponemos el % para que coincida con todos los elementos que se le parezacan )
        $result = mysqli_query($connection, $query);//le hacemos la consulta y nos va a devolver un resultado
        if(!$result){//si no obtengo un resultado o si no obtengo una respuesta de la base de datos
            die('Query Error' . mysqli_error($connection));//con die termina el proceso
        }
        //Vamos a recorrerlo, convertirlo en un JSON y lo guarpara devolverselo al front end 
        //lo que hacemos es recorrer la variable result, convertirlo a un JSON y almacenandolo en la variable JSON.
        $json = array();
        while($row = mysqli_fetch_array($result)){//vamos a recorrer el reultado y para eso lo transformamos en un array
            $json[] = array(//vamos a crear un arreglo en cada recorrido
                'nombre' => $row ['nombre'],
                'descripcion' => $row ['descripcion'],
                'id' => $row ['id']
            );
        }
        //lo convertimos en JSON para enviarlo
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
?>