<?php include("../template/header.php") ?>  <!-- esto conecta e incluye la cabecera --> 
<?php 
       //condicion accion        si            no (vacio)                           
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";                             //validacion, condicion o if ternario lo que va a suceder si se cumple o no 
$txtName=(isset($_POST['txtName']))?$_POST['txtName']:"";

$txtImage=(isset($_FILES['txtImage']['name']))?$_FILES['txtImage']['name']:"";

$action=(isset($_POST['action']))?$_POST['action']:"";

include("../config/db.php");  // esto conecta e incluye el contenido de db.php


                                          /*    echo $txtID."<br/>";
         imprime en pantalla                    echo $txtName."<br/>";
         para comprobar                         echo $txtImage."<br/>";
                                                echo $action."<br/>";    */



switch($action){

        
        case"Add":

            //INSERT INTO `books` (`id`, `name`, `image`) VALUES (NULL, 'Book about PHP', 'image.jpg'); son las instrucciones SQL copiadas de phpmyadmin
            // se obtienen de la seccion insertar o einfügen, se insertan los datos en los campos y luego de ok te da la linea de comandos 
        $sentenciaSQL=$connection->prepare("INSERT INTO books (name,image ) VALUES (:name,:image);"); // modificado comparar con el original, name e image son los parametros 
        $sentenciaSQL->bindParam(':name', $txtName);                               //parametros para insertar la informacion     
        $sentenciaSQL->bindParam(':image', $txtImage);
        $sentenciaSQL->execute();


            echo "Pressed Add button";
            break; 

        case"Modify":
            echo "Pressed Modify button";
            break;

        case"Cancel":
            echo "Pressed Cancel button";
            break;     


}






?>

<div class="col-md-5">                       <!-- b4-grid-col  , el md son los espacios de un total de 12 -->
    
    <div class="card">                       <!-- b4-card-head-foot -->
            <div class="card-header">
                Book data
            </div>

            <div class="card-body">
   
                <form method="POST" enctype="multipart/form-data">  <!-- aqui se especifica el metodo y la forma de envio del formulario,importante -->
                                           <!-- !crt-form-login , formulario de agregar libros -->
                        <div class = "form-group">
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" name="txtID" id="txtID"  placeholder="ID">
                        </div>

                            <div class = "form-group">
                            <label for="txtID">Name:</label>
                            <input type="text" class="form-control" name="txtName" id="txtName"  placeholder="Name of the Book">
                            </div>

                        <div class = "form-group">
                        <label for="txtID">Image:</label>
                        <input type="file" class="form-control" name="txtImage" id="txtImage"  placeholder="Choose the Book">
                        </div>

                    <div class="btn-group" role="group" aria-label="">                              <!-- b4-bgroup-default , primary -->
                        <button type="submit" name="action" value="Add" class="btn btn-success">Add</button>
                        <button type="submit" name="action" value="Modify" class="btn btn-warning">Modify</button>       <!-- type cambio de button a submit-->
                        <button type="submit" name="action" value="Cancel" class="btn btn-info">Cancel</button>
                    </div>

                </form>

            </div>

        
    </div>




    
     

</div>
<div class="col-md-7">
    
    <table class="table table-bordered">        <!-- b4-table-default -->
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>               <!--columna--> 
                <th>Image</th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>2</td>
                <td>Aprende PHP</td>                   <!--Datos-->
                <td>imagen.jpg</td>
                <td>Select | Delete</td>

            </tr>

        </tbody>
    </table>

</div>


<?php include("../template/footer.php") ?>