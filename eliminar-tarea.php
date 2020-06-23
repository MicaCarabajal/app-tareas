<?php
    include('database.php');//incluye la conexion de la bbdd

    if(isset($_POST['id'])){//comprobamos si existe a traves del metodo post la propiedad id, almacenalo y haz la consulta
        $id = $_POST['id'];
        $query = "DELETE FROM tareas WHERE id = $id";//hacemos la consulta para que el elimine el id
        $result = mysqli_query($connection, $query);//lo ejecutamos y lo guardamos en la variable result
        if(!$result){
            die('Query ha fallado');//si no recibe un resultado 
        }
    echo "La tarea se elimino satisfactoriamente";//en caso de que reciba el resultado
    }
    
?>