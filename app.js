$(document).ready(function () {
    let editar = false;

    console.log('jquery esta funcionando');//Esto lo hago para verificar si la CDN de jquery esta funcionando
    $('#tareas-resultado').hide();//con el metodo hide le decimos que oculte el elemento
    fetchTareas();//para que se ejecute nuestra funcion

    $('#search').keyup(function (e) {
        if ($('#search').val()) {//con este if le estamos diciendo si el input esta vacio no va enviar nada al servidor
            let search = $('#search').val();
            $.ajax({//este metedo nos permite hacer una peticion a un servidor
                url: 'busca-tareas.php',
                type: 'POST',
                data: { search },//para enviarle el input a mi servidor
                success: function (response) {
                    let tareas = JSON.parse(response);//toma un objeto json convertido a un string y lo vuelve a convertir a un JSON
                    console.log(response);
                    let template = '';//para hacer la plantilla
                    tareas.forEach(tareas => {//cada vez que recorra el array va a llenar la plantilla
                        //console.log(tareas);
                        template += `<li>
                        ${tareas.nombre}
                     </li>`
                    });
                    $('#container').html(template);//para que al buscar se muestre los datos en la interfaz
                    $('#tareas-resultado').show(); //con el metodo show mostramos el contenido
                }
            })
        }
    });
    $('#tareas-form').submit(function (e) {
        const datosPost = { //ponemos los inputs del form en un objeto
            nombre: $('#nombre').val(),
            descripcion: $('#descripcion').val(),
            id: $('#tareaId').val()
        };
        let url = editar === false ? 'guardar-datos.php' : 'editar-tareas.php';// si editar es falso(o sea si el formulariol no se esta editando) lo va a mandar a la direccion guadar-datos para almacenarlo. Caso contrario (si edit es verdadero) lo va a mandar a otra direccion de mi backend llamado editar-tareas
        console.log(url);
        $.post(url, datosPost, function (response) {
            console.log(response);
            fetchTareas();//para mostrar la tarea en la tabla de nuestra pagina
            $('#tareas-form').trigger('reset');//seleccionamos el formulario y utilizamos el metodo trigger para resetear el formulario osea que al enviarlo quede en blanco los inputs
        });
        e.preventDefault(); //para evitar que la pagina no se refresque al apretar el boton
    });

    function fetchTareas() {
        $.ajax({//esto se va a ejecutar apenas mi aplicacion inicia
            url: 'tareas-lista.php',
            type: 'GET', //metodo
            success: function (response) { //cuando reciba la respuesta va a realizar una funcion
                const tareas = response; //convertimos a un JSON los datos
                let template = '';
                tareas.forEach(tarea => { //las tareas vamos a recorrelas una a una y esa tarea va a retornar algo
                    template += `
                        <tr tareaId="${tarea.id}">
                            <td>${tarea.id}</td>
                            <td>
                                <a href="#" class="tarea-item">${tarea.nombre}</a>
                            </td>
                            <td>${tarea.descripcion}</td>
                            <td>
                                <button class="eliminar-tarea btn btn-danger">
                                    Eliminar
                                </button>
                            </td> 
                        </tr>           
                    `
                });
                $('#tarea').html(template);
            }
        });
    }

    $(document).on('click', '.eliminar-tarea', function () {
        if (confirm('¿Esta seguro que quieres eliminar la tarea?')) {
            let elemento = $(this)[0].parentElement.parentElement;//para obtener la fila del boton que ha sido clikeado
            let id = $(elemento).attr('tareaId');//attr: para buscar el atributo. Con esto obtenemos su propiedad a la que llamamos tareaId
            $.post('eliminar-tarea.php', { id }, function (response) {//al id lo enviamos al backend, luego escuchamos su respuesta y la mostramos por consola
                //console.log(response);
                fetchTareas();//llamamos a la funcion para que la tarea desaparezca de la pagina
            })
        }
    });

    $(document).on('click', '.tarea-item', function (){
        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('tareaId');
        $.post('single-tareas.php', {id}, function(response) { //enviamos nuestro id y vemos que nos esta respondiendo
            const tarea = JSON.parse(response);//para convertir en un JSON la respuesta
            $('#nombre').val(tarea.nombre);//para mostrar en el formulario el contenido al hacer click en él
            $('#descripcion').val(tarea.descripcion);
            $('#tareaId').val(tarea.id);//va a aparecer de forma oculta en nuestro form el id
            editar = true;
        })
    });

});