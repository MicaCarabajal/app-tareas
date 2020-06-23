<?php
    include('database.php');

    if(isset($_POST['nombre'])){ //si existe una variable que viene a traves del metodo post que se llama nombre
        //echo $_POST['nombre']; devuelve el valor de nombre
        $nombre = $_POST['nombre'];//para que almacene los datos a traves del metodo post
        $descripcion = $_POST['descripcion'];
        $query = "INSERT into tareas(nombre, descripcion) VALUES ('$nombre', '$descripcion')";//hacemos la consulta
        $result = mysqli_query($connection, $query);//para ejecutar la consulta
        if(!$result){//si no existe un resultado o sea si no devuelve un resultado a la bbdd
            die('La consulta a fallado');//en el caso de que haya fallado
        }
        echo "Tarea agregada satisfactoriamente";//en el caso de que se haya mandado el resultado a la bbdd
    }

?>